#!/usr/bin/env python3
"""
Gemini Watermark Cleaner & Brand Watermark Overlay Engine
Supports both Images & Videos for Velmora Gems & Shreeja Gems (Etsy Standards)

Features:
- Image & Video processing (MP4, MOV, WEBM, AVI, M4V)
- High-Performance H.264 Video Inpainting & Watermarking
- Auto-Smart Contrast: Automatically detects dark backgrounds (navy, black, velvet) 
  and renders crisp pure white watermarks, and rich color watermarks on light backgrounds.
- Preserves 100% image clarity (subsampling=0, 4:4:4, 300 DPI, 98% quality for Etsy)
- OpenCV inpainting (Telea & Navier-Stokes) for Gemini corner AI watermarks
- Clean alpha preservation for transparent brand logos (Velmora & Shreeja)
- Multi-positioning grid (Center-Left, Right, Bottom-Right, etc.)
- Subtle drop-shadow for high contrast against all backgrounds
"""

import os
import sys
import json
import argparse
import subprocess
import numpy as np
from PIL import Image, ImageFilter

try:
    import cv2
except ImportError:
    print("Error: OpenCV (cv2) is not installed. Please run: pip install opencv-python")
    sys.exit(1)

try:
    import imageio_ffmpeg
    FFMPEG_EXE = imageio_ffmpeg.get_ffmpeg_exe()
except Exception:
    FFMPEG_EXE = "ffmpeg"


def make_logo_transparent(img_pil, bg_mode="auto", color_override="original"):
    """
    Cleans logo image by removing solid white or black backgrounds if present,
    while perfectly preserving pre-existing transparent PNG alpha channels.
    """
    img = img_pil.convert("RGBA")
    arr = np.array(img, dtype=np.float32)
    rgb = arr[:, :, :3]
    alpha = arr[:, :, 3]

    has_alpha = (alpha < 240).sum() > (alpha.size * 0.03)

    if not has_alpha and bg_mode != "none":
        h, w = rgb.shape[:2]
        ch = min(15, h // 3)
        cw = min(15, w // 3)
        corners = np.vstack([
            rgb[:ch, :cw].reshape(-1, 3),
            rgb[:ch, -cw:].reshape(-1, 3),
            rgb[-ch:, :cw].reshape(-1, 3),
            rgb[-ch:, -cw:].reshape(-1, 3)
        ])
        brightness = corners.mean(axis=0).dot([0.299, 0.587, 0.114])

        if brightness > 170:
            gray = 0.299 * rgb[:, :, 0] + 0.587 * rgb[:, :, 1] + 0.114 * rgb[:, :, 2]
            new_alpha = np.clip((250.0 - gray) / 220.0 * 255.0, 0, 255)
            new_alpha[new_alpha < 15] = 0
            arr[:, :, 3] = new_alpha
        elif brightness < 80:
            gray = 0.299 * rgb[:, :, 0] + 0.587 * rgb[:, :, 1] + 0.114 * rgb[:, :, 2]
            new_alpha = np.clip((gray - 25.0) / 200.0 * 255.0, 0, 255)
            new_alpha[new_alpha < 15] = 0
            arr[:, :, 3] = new_alpha

    if color_override == "white":
        mask = arr[:, :, 3] > 10
        arr[mask, 0] = 255
        arr[mask, 1] = 255
        arr[mask, 2] = 255
    elif color_override == "dark" or color_override == "black":
        mask = arr[:, :, 3] > 10
        arr[mask, 0] = 20
        arr[mask, 1] = 20
        arr[mask, 2] = 20
    elif color_override == "gold":
        mask = arr[:, :, 3] > 10
        arr[mask, 0] = 225
        arr[mask, 1] = 190
        arr[mask, 2] = 80

    return Image.fromarray(arr.astype(np.uint8))


def generate_astroid_template(size=31):
    """
    Generates a 4-pointed astroid star kernel (Gemini logo geometry).
    """
    kernel = np.zeros((size, size), dtype=np.float32)
    center = (size - 1) / 2.0
    radius = center
    for y in range(size):
        for x in range(size):
            nx = abs(x - center) / max(1.0, radius)
            ny = abs(y - center) / max(1.0, radius)
            val = (nx ** (2/3) + ny ** (2/3))
            if val <= 1.0:
                kernel[y, x] = (1.0 - val) ** 0.5
    if kernel.max() > 0:
        kernel /= kernel.max()
    return kernel


def remove_gemini_watermark_cv2(
    img_cv2,
    corner="bottom_right",
    box_size_pct=0.09,
    margin_pct=0.035,
    inpaint_radius=3,
    method="telea",
    custom_boxes=None,
    custom_spots=None,
    mask_image_path=None,
    auto_detect_sparkles=True
):
    """
    Removes Gemini / AI watermarks using OpenCV inpainting while preserving image sharpness.
    Supports auto-detecting full-image sparkles, all 4 corners, custom boxes, and spot eraser points.
    """
    h, w = img_cv2.shape[:2]
    mask = np.zeros((h, w), dtype=np.uint8)

    if mask_image_path and os.path.exists(mask_image_path):
        custom_mask = cv2.imread(mask_image_path, cv2.IMREAD_GRAYSCALE)
        if custom_mask is not None:
            if custom_mask.shape[:2] != (h, w):
                custom_mask = cv2.resize(custom_mask, (w, h), interpolation=cv2.INTER_NEAREST)
            _, custom_mask_bin = cv2.threshold(custom_mask, 10, 255, cv2.THRESH_BINARY)
            mask = cv2.bitwise_or(mask, custom_mask_bin)

    if custom_boxes:
        for box in custom_boxes:
            if isinstance(box, dict):
                bx = box.get("x", 0)
                by = box.get("y", 0)
                bw = box.get("w", box.get("width", 0.08))
                bh = box.get("h", box.get("height", 0.08))
            elif isinstance(box, (list, tuple)) and len(box) >= 4:
                bx, by, bw, bh = box[:4]
            else:
                continue

            if bw <= 1.0 and bh <= 1.0 and bx <= 1.0 and by <= 1.0:
                px = max(0, int(bx * w))
                py = max(0, int(by * h))
                pw = min(w - px, int(bw * w))
                ph = min(h - py, int(bh * h))
            else:
                px = max(0, int(bx))
                py = max(0, int(by))
                pw = min(w - px, int(bw))
                ph = min(h - py, int(bh))
            mask[py:py+ph, px:px+pw] = 255

    if custom_spots:
        for spot in custom_spots:
            if isinstance(spot, dict):
                sx = spot.get("x", 0)
                sy = spot.get("y", 0)
                sr = spot.get("r", spot.get("radius", 18))
            elif isinstance(spot, (list, tuple)) and len(spot) >= 2:
                sx, sy = spot[0], spot[1]
                sr = spot[2] if len(spot) > 2 else 18
            else:
                continue

            px = int(sx * w) if sx <= 1.0 else int(sx)
            py = int(sy * h) if sy <= 1.0 else int(sy)
            pr = int(sr * min(w, h)) if sr <= 1.0 else int(sr)
            cv2.circle(mask, (px, py), max(8, pr), 255, -1)

    corner_norm = (corner or "").lower().replace("-", "_")
    box_w = max(20, int(w * box_size_pct))
    box_h = max(20, int(h * box_size_pct))
    margin_x = int(w * margin_pct)
    margin_y = int(h * margin_pct)

    if corner_norm in ["bottom_right", "br", "all_corners", "all", "auto"]:
        mask[max(0, h - margin_y - box_h):min(h, h - margin_y), max(0, w - margin_x - box_w):min(w, w - margin_x)] = 255
    if corner_norm in ["bottom_left", "bl", "all_corners", "all"]:
        mask[max(0, h - margin_y - box_h):min(h, h - margin_y), max(0, margin_x):min(w, margin_x + box_w)] = 255
    if corner_norm in ["top_right", "tr", "all_corners", "all"]:
        mask[max(0, margin_y):min(h, margin_y + box_h), max(0, w - margin_x - box_w):min(w, w - margin_x)] = 255
    if corner_norm in ["top_left", "tl", "all_corners", "all"]:
        mask[max(0, margin_y):min(h, margin_y + box_h), max(0, margin_x):min(w, margin_x + box_w)] = 255

    # Full-image Astroid Sparkle auto-detection
    if auto_detect_sparkles or corner_norm == "auto":
        try:
            gray = cv2.cvtColor(img_cv2, cv2.COLOR_BGR2GRAY)
            kernel_th = cv2.getStructuringElement(cv2.MORPH_RECT, (15, 15))
            tophat = cv2.morphologyEx(gray, cv2.MORPH_TOPHAT, kernel_th)
            tophat_f = tophat.astype(np.float32) / 255.0

            scales = [int(min(w, h) * s) for s in [0.035, 0.05, 0.07]]
            scales = [s for s in scales if s >= 16]

            detected_stars = []
            for s in scales:
                tpl = generate_astroid_template(s)
                res = cv2.matchTemplate(tophat_f, tpl, cv2.TM_CCOEFF_NORMED)
                locs = np.where(res >= 0.85)
                for pt in zip(*locs[::-1]):
                    cx = pt[0] + s // 2
                    cy = pt[1] + s // 2
                    detected_stars.append((cx, cy, s))

            for cx, cy, s in detected_stars:
                cv2.circle(mask, (cx, cy), max(10, int(s * 0.55)), 255, -1)
        except Exception as e:
            print(f"Warning in sparkle auto-detection: {e}", file=sys.stderr)

    if cv2.countNonZero(mask) == 0:
        return img_cv2

    kernel_global = cv2.getStructuringElement(cv2.MORPH_ELLIPSE, (3, 3))
    mask = cv2.dilate(mask, kernel_global, iterations=1)

    inpaint_flag = cv2.INPAINT_TELEA if method.lower() == "telea" else cv2.INPAINT_NS
    inpainted = cv2.inpaint(img_cv2, mask, inpaint_radius, inpaint_flag)
    return inpainted


def apply_brand_watermark(
    base_image_pil,
    logo_image_path,
    position="center_left",
    scale_pct=0.28,
    opacity=0.85,
    margin_pct=0.04,
    add_shadow=True,
    bg_mode="auto",
    color_override="auto",
    custom_x=None,
    custom_y=None
):
    """
    Overlays branding logo on base PIL image with Smart Adaptive Contrast.
    """
    if not logo_image_path or not os.path.exists(logo_image_path):
        return base_image_pil

    try:
        raw_logo = Image.open(logo_image_path)
    except Exception as e:
        print(f"Warning: Could not open logo '{logo_image_path}': {e}", file=sys.stderr)
        return base_image_pil

    base_w, base_h = base_image_pil.size

    target_w = max(40, int(base_w * scale_pct))
    aspect_ratio = raw_logo.height / max(1, raw_logo.width)
    target_h = max(15, int(target_w * aspect_ratio))

    margin_x = int(base_w * margin_pct)
    margin_y = int(base_h * margin_pct)

    if custom_x is not None and custom_y is not None:
        x = int(custom_x * base_w) if custom_x <= 1.0 else int(custom_x)
        y = int(custom_y * base_h) if custom_y <= 1.0 else int(custom_y)
    else:
        pos = position.lower().replace("-", "_")
        if pos == "top_left":
            x, y = margin_x, margin_y
        elif pos == "top_center" or pos == "top":
            x = (base_w - target_w) // 2
            y = margin_y
        elif pos == "top_right":
            x = base_w - target_w - margin_x
            y = margin_y
        elif pos in ["center_left", "left_center", "left"]:
            x = margin_x
            y = (base_h - target_h) // 2
        elif pos == "center" or pos == "middle":
            x = (base_w - target_w) // 2
            y = (base_h - target_h) // 2
        elif pos in ["center_right", "right_center", "right"]:
            x = base_w - target_w - margin_x
            y = (base_h - target_h) // 2
        elif pos == "bottom_left":
            x = margin_x
            y = base_h - target_h - margin_y
        elif pos == "bottom_center" or pos == "bottom":
            x = (base_w - target_w) // 2
            y = base_h - target_h - margin_y
        elif pos in ["bottom_right", "br"]:
            x = base_w - target_w - margin_x
            y = base_h - target_h - margin_y
        else:
            x = margin_x
            y = (base_h - target_h) // 2

    # Smart Adaptive Contrast
    base_rgb_arr = np.array(base_image_pil.convert("RGB"))
    x1, y1 = max(0, x), max(0, y)
    x2, y2 = min(base_w, x + target_w), min(base_h, y + target_h)
    bg_roi = base_rgb_arr[y1:y2, x1:x2]

    if bg_roi.size > 0:
        mean_r = float(bg_roi[:, :, 0].mean())
        mean_g = float(bg_roi[:, :, 1].mean())
        mean_b = float(bg_roi[:, :, 2].mean())
        bg_luminance = float(mean_r * 0.2126 + mean_g * 0.7152 + mean_b * 0.0722)
        # Detect human skin tone / warm surfaces
        is_skin_tone = (mean_r > 115 and mean_g > 75 and mean_r > mean_b + 10 and bg_luminance < 195)
    else:
        bg_luminance = 128.0
        is_skin_tone = False

    final_color_mode = color_override
    if color_override == "auto":
        # Crisp white on dark backgrounds or skin tones for maximum clarity; brand gold on bright white studio backgrounds
        if bg_luminance < 170 or is_skin_tone:
            final_color_mode = "white"
        else:
            final_color_mode = "original"

    watermark = make_logo_transparent(raw_logo, bg_mode=bg_mode, color_override=final_color_mode)
    watermark = watermark.resize((target_w, target_h), Image.Resampling.LANCZOS)

    alpha = watermark.split()[3]
    alpha = alpha.point(lambda p: int(p * max(0.0, min(1.0, opacity))))
    watermark.putalpha(alpha)

    canvas = base_image_pil.convert("RGBA")

    if add_shadow and opacity > 0.05:
        shadow_canvas = Image.new("RGBA", (base_w, base_h), (0, 0, 0, 0))
        shadow_wm = Image.new("RGBA", watermark.size, (0, 0, 0, 0))
        s_alpha = watermark.split()[3].point(lambda p: int(p * 0.50))
        shadow_wm.paste((0, 0, 0, 255), (0, 0), s_alpha)
        shadow_canvas.paste(shadow_wm, (x + 2, y + 2), shadow_wm)
        shadow_canvas = shadow_canvas.filter(ImageFilter.GaussianBlur(3))
        canvas = Image.alpha_composite(canvas, shadow_canvas)

    watermark_layer = Image.new("RGBA", (base_w, base_h), (0, 0, 0, 0))
    watermark_layer.paste(watermark, (x, y), watermark)
    final_rgba = Image.alpha_composite(canvas, watermark_layer)

    return final_rgba.convert("RGB")


def precompute_watermark_for_video(
    width,
    height,
    sample_frame_bgr,
    logo_path,
    position="center_left",
    scale_pct=0.28,
    opacity=0.85,
    margin_pct=0.04,
    add_shadow=True,
    color_override="auto"
):
    """
    Precomputes the RGBA watermark overlay and bounding box (x1, y1, x2, y2)
    for ultra-fast vectorized alpha-blending across all video frames.
    """
    if not logo_path or not os.path.exists(logo_path) or opacity <= 0:
        return None

    try:
        raw_logo = Image.open(logo_path)
    except Exception as e:
        print(f"Warning: Could not open logo '{logo_path}': {e}", file=sys.stderr)
        return None

    target_w = max(40, int(width * scale_pct))
    aspect_ratio = raw_logo.height / max(1, raw_logo.width)
    target_h = max(15, int(target_w * aspect_ratio))

    margin_x = int(width * margin_pct)
    margin_y = int(height * margin_pct)

    pos = position.lower().replace("-", "_")
    if pos == "top_left":
        x, y = margin_x, margin_y
    elif pos in ["top_center", "top"]:
        x = (width - target_w) // 2
        y = margin_y
    elif pos == "top_right":
        x = width - target_w - margin_x
        y = margin_y
    elif pos in ["center_left", "left_center", "left"]:
        x = margin_x
        y = (height - target_h) // 2
    elif pos in ["center", "middle"]:
        x = (width - target_w) // 2
        y = (height - target_h) // 2
    elif pos in ["center_right", "right_center", "right"]:
        x = width - target_w - margin_x
        y = (height - target_h) // 2
    elif pos == "bottom_left":
        x = margin_x
        y = height - target_h - margin_y
    elif pos in ["bottom_center", "bottom"]:
        x = (width - target_w) // 2
        y = height - target_h - margin_y
    elif pos in ["bottom_right", "br"]:
        x = width - target_w - margin_x
        y = height - target_h - margin_y
    else:
        x = margin_x
        y = (height - target_h) // 2

    # Sample luminance from ROI in sample_frame_bgr
    x1, y1 = max(0, x), max(0, y)
    x2, y2 = min(width, x + target_w), min(height, y + target_h)

    if sample_frame_bgr is not None and sample_frame_bgr.size > 0:
        roi = sample_frame_bgr[y1:y2, x1:x2]
        mean_b = float(roi[:, :, 0].mean())
        mean_g = float(roi[:, :, 1].mean())
        mean_r = float(roi[:, :, 2].mean())
        bg_luminance = float(mean_b * 0.114 + mean_g * 0.587 + mean_r * 0.299)
        is_skin_tone = (mean_r > 115 and mean_g > 75 and mean_r > mean_b + 10 and bg_luminance < 195)
    else:
        bg_luminance = 128.0
        is_skin_tone = False

    final_color_mode = color_override
    if color_override == "auto":
        if bg_luminance < 170 or is_skin_tone:
            final_color_mode = "white"
        else:
            final_color_mode = "original"

    watermark = make_logo_transparent(raw_logo, bg_mode="auto", color_override=final_color_mode)
    watermark = watermark.resize((target_w, target_h), Image.Resampling.LANCZOS)

    alpha = watermark.split()[3]
    alpha = alpha.point(lambda p: int(p * max(0.0, min(1.0, opacity))))
    watermark.putalpha(alpha)

    # Render on full transparent layer of size (width, height)
    full_overlay = Image.new("RGBA", (width, height), (0, 0, 0, 0))

    if add_shadow and opacity > 0.05:
        shadow_canvas = Image.new("RGBA", (width, height), (0, 0, 0, 0))
        shadow_wm = Image.new("RGBA", watermark.size, (0, 0, 0, 0))
        s_alpha = watermark.split()[3].point(lambda p: int(p * 0.50))
        shadow_wm.paste((0, 0, 0, 255), (0, 0), s_alpha)
        shadow_canvas.paste(shadow_wm, (x + 2, y + 2), shadow_wm)
        shadow_canvas = shadow_canvas.filter(ImageFilter.GaussianBlur(3))
        full_overlay = Image.alpha_composite(full_overlay, shadow_canvas)

    watermark_layer = Image.new("RGBA", (width, height), (0, 0, 0, 0))
    watermark_layer.paste(watermark, (x, y), watermark)
    full_overlay = Image.alpha_composite(full_overlay, watermark_layer)

    # Convert to BGR array and normalized alpha channel (H, W, 1)
    overlay_arr = np.array(full_overlay, dtype=np.float32)
    overlay_bgr = overlay_arr[:, :, [2, 1, 0]]  # RGBA -> BGR
    overlay_alpha = overlay_arr[:, :, 3:4] / 255.0  # (H, W, 1)

    # Find non-zero bounding box for overlay to optimize blending
    alpha_mask_2d = overlay_arr[:, :, 3] > 0
    if np.any(alpha_mask_2d):
        rows = np.any(alpha_mask_2d, axis=1)
        cols = np.any(alpha_mask_2d, axis=0)
        rmin, rmax = np.where(rows)[0][[0, -1]]
        cmin, cmax = np.where(cols)[0][[0, -1]]
        # Expand slightly
        rmin, rmax = max(0, int(rmin)), min(height, int(rmax + 1))
        cmin, cmax = max(0, int(cmin)), min(width, int(cmax + 1))
        return {
            "rmin": rmin, "rmax": rmax,
            "cmin": cmin, "cmax": cmax,
            "bgr_roi": overlay_bgr[rmin:rmax, cmin:cmax],
            "alpha_roi": overlay_alpha[rmin:rmax, cmin:cmax]
        }
    return None


def process_video(
    input_path,
    output_path,
    remove_gemini=True,
    corner="bottom_right",
    box_size_pct=0.09,
    margin_pct=0.035,
    inpaint_radius=3,
    inpaint_method="telea",
    logo_path=None,
    logo_pos="center_left",
    logo_scale=0.28,
    logo_opacity=0.85,
    logo_margin=0.04,
    add_shadow=True,
    color_override="auto"
):
    """
    High-Performance Video Pipeline:
    Removes Gemini corner watermark and overlays brand watermark on all frames
    with vectorized numpy blending and ultra-fast H.264 encoding.
    """
    if not os.path.exists(input_path):
        raise FileNotFoundError(f"Input file not found: {input_path}")

    cap = cv2.VideoCapture(input_path)
    if not cap.isOpened():
        raise ValueError(f"Cannot open video file: {input_path}")

    fps = cap.get(cv2.CAP_PROP_FPS) or 30.0
    if fps <= 0 or np.isnan(fps):
        fps = 30.0

    raw_w = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
    raw_h = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
    
    # libx264 strictly requires even dimensions
    width = (raw_w // 2) * 2
    height = (raw_h // 2) * 2

    if width <= 0 or height <= 0:
        raise ValueError(f"Invalid video dimensions: {raw_w}x{raw_h}")

    if not output_path.lower().endswith(".mp4"):
        output_path = os.path.splitext(output_path)[0] + ".mp4"

    os.makedirs(os.path.dirname(os.path.abspath(output_path)), exist_ok=True)

    # Read first frame to sample luminance and initialize
    ret, first_frame = cap.read()
    if not ret or first_frame is None:
        cap.release()
        raise ValueError("Cannot read any frames from video file.")

    if raw_w != width or raw_h != height:
        first_frame = cv2.resize(first_frame, (width, height))

    # Pre-create inpainting mask ONCE
    mask = None
    if remove_gemini:
        mask = np.zeros((height, width), dtype=np.uint8)
        box_w = max(10, int(width * box_size_pct))
        box_h = max(10, int(height * box_size_pct))
        margin_x = int(width * margin_pct)
        margin_y = int(height * margin_pct)

        if corner in ["bottom_right", "br"]:
            x1, y1, x2, y2 = width - margin_x - box_w, height - margin_y - box_h, width - margin_x, height - margin_y
        elif corner in ["bottom_left", "bl"]:
            x1, y1, x2, y2 = margin_x, height - margin_y - box_h, margin_x + box_w, height - margin_y
        elif corner in ["top_right", "tr"]:
            x1, y1, x2, y2 = width - margin_x - box_w, margin_y, width - margin_x, margin_y + box_h
        elif corner in ["top_left", "tl"]:
            x1, y1, x2, y2 = margin_x, margin_y, margin_x + box_w, margin_y + box_h
        else:
            x1, y1, x2, y2 = width - margin_x - box_w, height - margin_y - box_h, width - margin_x, height - margin_y

        mask[max(0, y1):min(height, y2), max(0, x1):min(width, x2)] = 255
        kernel = cv2.getStructuringElement(cv2.MORPH_ELLIPSE, (3, 3))
        mask = cv2.dilate(mask, kernel, iterations=1)

    inpaint_flag = cv2.INPAINT_TELEA if inpaint_method.lower() == "telea" else cv2.INPAINT_NS

    # Precompute watermark overlay ONCE
    wm_data = precompute_watermark_for_video(
        width=width,
        height=height,
        sample_frame_bgr=first_frame,
        logo_path=logo_path,
        position=logo_pos,
        scale_pct=logo_scale,
        opacity=logo_opacity,
        margin_pct=logo_margin,
        add_shadow=add_shadow,
        color_override=color_override
    )

    # Launch FFMPEG sub-process for high-speed, broadcast quality MP4 encoding
    cmd = [
        FFMPEG_EXE, "-y",
        "-f", "rawvideo",
        "-vcodec", "rawvideo",
        "-s", f"{width}x{height}",
        "-pix_fmt", "bgr24",
        "-r", str(fps),
        "-i", "-",
        "-c:v", "libx264",
        "-pix_fmt", "yuv420p",
        "-crf", "18",
        "-preset", "veryfast",
        output_path
    ]

    proc = subprocess.Popen(cmd, stdin=subprocess.PIPE, stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)

    # Reset video capture to start
    cap.set(cv2.CAP_PROP_POS_FRAMES, 0)

    try:
        while True:
            ret, frame_bgr = cap.read()
            if not ret or frame_bgr is None:
                break

            if raw_w != width or raw_h != height:
                frame_bgr = cv2.resize(frame_bgr, (width, height))

            # 1. Gemini Watermark Inpainting
            if mask is not None:
                frame_bgr = cv2.inpaint(frame_bgr, mask, inpaint_radius, inpaint_flag)

            # 2. Vectorized Watermark Overlay
            if wm_data is not None:
                rmin, rmax = wm_data["rmin"], wm_data["rmax"]
                cmin, cmax = wm_data["cmin"], wm_data["cmax"]
                roi = frame_bgr[rmin:rmax, cmin:cmax].astype(np.float32)
                blended = roi * (1.0 - wm_data["alpha_roi"]) + wm_data["bgr_roi"] * wm_data["alpha_roi"]
                frame_bgr[rmin:rmax, cmin:cmax] = blended.astype(np.uint8)

            proc.stdin.write(frame_bgr.tobytes())

    finally:
        cap.release()
        if proc.stdin:
            proc.stdin.close()
        proc.wait()

    return output_path


def process_image(
    input_path,
    output_path,
    remove_gemini=True,
    corner="bottom_right",
    box_size_pct=0.09,
    margin_pct=0.035,
    inpaint_radius=3,
    inpaint_method="telea",
    custom_boxes=None,
    custom_spots=None,
    mask_path=None,
    auto_detect_sparkles=True,
    logo_path=None,
    logo_pos="center_left",
    logo_scale=0.28,
    logo_opacity=0.85,
    logo_margin=0.04,
    add_shadow=True,
    bg_mode="auto",
    color_override="auto",
    output_quality=98
):
    """
    Main pipeline for a single image with Etsy listing clarity guarantees.
    """
    if not os.path.exists(input_path):
        raise FileNotFoundError(f"Input file not found: {input_path}")

    # Check if input is a video file
    video_exts = {".mp4", ".mov", ".webm", ".avi", ".m4v"}
    ext = os.path.splitext(input_path)[1].lower()
    if ext in video_exts:
        return process_video(
            input_path=input_path,
            output_path=output_path,
            remove_gemini=remove_gemini,
            corner=corner,
            box_size_pct=box_size_pct,
            margin_pct=margin_pct,
            inpaint_radius=inpaint_radius,
            inpaint_method=inpaint_method,
            logo_path=logo_path,
            logo_pos=logo_pos,
            logo_scale=logo_scale,
            logo_opacity=logo_opacity,
            logo_margin=logo_margin,
            add_shadow=add_shadow,
            color_override=color_override
        )

    img_cv2 = cv2.imread(input_path)
    if img_cv2 is None:
        raise ValueError(f"Unable to read image with OpenCV: {input_path}")

    # Remove Gemini watermark
    if remove_gemini or custom_boxes or custom_spots or mask_path:
        img_cleaned_cv2 = remove_gemini_watermark_cv2(
            img_cv2=img_cv2,
            corner=corner if remove_gemini else "none",
            box_size_pct=box_size_pct,
            margin_pct=margin_pct,
            inpaint_radius=inpaint_radius,
            method=inpaint_method,
            custom_boxes=custom_boxes,
            custom_spots=custom_spots,
            mask_image_path=mask_path,
            auto_detect_sparkles=auto_detect_sparkles
        )
    else:
        img_cleaned_cv2 = img_cv2

    img_rgb = cv2.cvtColor(img_cleaned_cv2, cv2.COLOR_BGR2RGB)
    pil_img = Image.fromarray(img_rgb)

    # Overlay Brand Watermark
    if logo_path and os.path.exists(logo_path) and logo_opacity > 0:
        pil_img = apply_brand_watermark(
            base_image_pil=pil_img,
            logo_image_path=logo_path,
            position=logo_pos,
            scale_pct=logo_scale,
            opacity=logo_opacity,
            margin_pct=logo_margin,
            add_shadow=add_shadow,
            bg_mode=bg_mode,
            color_override=color_override
        )

    os.makedirs(os.path.dirname(os.path.abspath(output_path)), exist_ok=True)

    # Save with maximum fidelity (no chroma subsampling, 98% quality)
    ext = os.path.splitext(output_path)[1].lower()
    if ext in [".jpg", ".jpeg"]:
        pil_img.save(
            output_path,
            "JPEG",
            quality=output_quality,
            subsampling=0,      # 4:4:4 zero chroma subsampling for Etsy clarity
            optimize=True,
            dpi=(300, 300)
        )
    elif ext == ".webp":
        pil_img.save(output_path, "WEBP", quality=output_quality, method=6)
    else:
        pil_img.save(output_path, "PNG", optimize=True)

    return output_path


def main():
    parser = argparse.ArgumentParser(description="Gemini Watermark Remover and Branding Logo Watermark Tool")
    parser.add_argument("--input", "-i", required=True, help="Path to input image/video file or directory")
    parser.add_argument("--output", "-o", required=True, help="Path to output image/video file or directory")
    
    parser.add_argument("--remove-gemini", action="store_true", default=True, help="Remove Gemini watermark")
    parser.add_argument("--no-remove-gemini", dest="remove_gemini", action="store_false", help="Do not remove Gemini watermark")
    parser.add_argument("--auto-detect-sparkles", action="store_true", default=True, help="Auto-detect Gemini 4-pointed stars anywhere across the image")
    parser.add_argument("--no-auto-detect-sparkles", dest="auto_detect_sparkles", action="store_false")
    parser.add_argument("--corner", default="bottom_right", choices=["bottom_right", "bottom_left", "top_right", "top_left", "all_corners", "auto", "none"])
    parser.add_argument("--box-size", type=float, default=0.09)
    parser.add_argument("--margin", type=float, default=0.035)
    parser.add_argument("--inpaint-radius", type=int, default=3)
    parser.add_argument("--method", default="telea", choices=["telea", "ns"])
    parser.add_argument("--boxes-json", default=None)
    parser.add_argument("--spots-json", default=None)
    parser.add_argument("--mask", default=None)

    parser.add_argument("--logo", default=None)
    parser.add_argument("--logo-pos", default="center_left")
    parser.add_argument("--logo-scale", type=float, default=0.28)
    parser.add_argument("--logo-opacity", type=float, default=0.85)
    parser.add_argument("--logo-margin", type=float, default=0.04)
    parser.add_argument("--logo-bg", default="auto", choices=["auto", "white", "black", "none"])
    parser.add_argument("--logo-color", default="auto", choices=["auto", "original", "white", "dark", "black", "gold"])
    parser.add_argument("--shadow", action="store_true", default=True)
    parser.add_argument("--quality", type=int, default=98)

    args = parser.parse_args()

    custom_boxes = None
    if args.boxes_json:
        try:
            custom_boxes = json.loads(args.boxes_json)
        except Exception as e:
            print(f"Warning: Failed to parse boxes JSON: {e}", file=sys.stderr)

    custom_spots = None
    if args.spots_json:
        try:
            custom_spots = json.loads(args.spots_json)
        except Exception as e:
            print(f"Warning: Failed to parse spots JSON: {e}", file=sys.stderr)

    if os.path.isdir(args.input):
        os.makedirs(args.output, exist_ok=True)
        valid_exts = {".jpg", ".jpeg", ".png", ".webp", ".mp4", ".mov", ".webm", ".avi", ".m4v"}
        files = [f for f in os.listdir(args.input) if os.path.splitext(f)[1].lower() in valid_exts]
        print(f"Found {len(files)} files to process in {args.input}")
        
        for idx, fname in enumerate(files, 1):
            in_file = os.path.join(args.input, fname)
            out_file = os.path.join(args.output, fname)
            try:
                process_image(
                    input_path=in_file,
                    output_path=out_file,
                    remove_gemini=args.remove_gemini,
                    corner=args.corner,
                    box_size_pct=args.box_size,
                    margin_pct=args.margin,
                    inpaint_radius=args.inpaint_radius,
                    inpaint_method=args.method,
                    custom_boxes=custom_boxes,
                    custom_spots=custom_spots,
                    mask_path=args.mask,
                    auto_detect_sparkles=args.auto_detect_sparkles,
                    logo_path=args.logo,
                    logo_pos=args.logo_pos,
                    logo_scale=args.logo_scale,
                    logo_opacity=args.logo_opacity,
                    logo_margin=args.logo_margin,
                    add_shadow=args.shadow,
                    bg_mode=args.logo_bg,
                    color_override=args.logo_color,
                    output_quality=args.quality
                )
                print(f"[{idx}/{len(files)}] Processed: {fname}")
            except Exception as e:
                print(f"[{idx}/{len(files)}] Error processing {fname}: {e}", file=sys.stderr)
    else:
        try:
            out_path = process_image(
                input_path=args.input,
                output_path=args.output,
                remove_gemini=args.remove_gemini,
                corner=args.corner,
                box_size_pct=args.box_size,
                margin_pct=args.margin,
                inpaint_radius=args.inpaint_radius,
                inpaint_method=args.method,
                custom_boxes=custom_boxes,
                custom_spots=custom_spots,
                mask_path=args.mask,
                auto_detect_sparkles=args.auto_detect_sparkles,
                logo_path=args.logo,
                logo_pos=args.logo_pos,
                logo_scale=args.logo_scale,
                logo_opacity=args.logo_opacity,
                logo_margin=args.logo_margin,
                add_shadow=args.shadow,
                bg_mode=args.logo_bg,
                color_override=args.logo_color,
                output_quality=args.quality
            )
            print(f"Successfully processed: {out_path}")
        except Exception as e:
            print(f"Error processing file: {e}", file=sys.stderr)
            sys.exit(1)


if __name__ == "__main__":
    main()
