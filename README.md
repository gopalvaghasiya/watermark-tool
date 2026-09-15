# ✨ Gemini Watermark Remover & Brand Logo Studio
### High-Fidelity Watermark Cleaner & Brand Watermark Overlay Engine for Images and Videos

A comprehensive, production-grade tool built for **Etsy Listings, Jewelry, and E-commerce** to remove Google Gemini / Imagen AI sparkles and corner watermarks, and seamlessly apply high-resolution branding logos for **Velmora Gems** and **Shreeja Gems**.

---

## 🌟 Key Features

- **Gemini / AI Watermark Inpainting**:
  - Automatically detects and cleanly erases Google Gemini AI sparkles and corner watermarks using OpenCV (Telea and Navier-Stokes algorithms).
- **Multi-Brand 1-Click Switcher**:
  - Built-in support for **Velmora Gems** (Rose Gold & Pure White) and **Shreeja Gems** (Luxury Gold & Pure White), plus custom logo uploads.
- **Smart Auto-Contrast**:
  - Automatically samples background luminance (dark navy sapphire, black velvet vs. white marble/desk) and selects crisp white or rich brand colors with subtle drop-shadows.
- **Etsy Listing Quality Guarantee**:
  - Zero chroma subsampling (4:4:4), 98% quality, 300 DPI metadata preservation.
- **Full Video Support**:
  - Erases AI watermarks across all frames and watermarks videos (.mp4, .mov, .webm, .avi, .m4v) encoded with high-speed H.264 MP4 (libx264).
- **Interactive UI**:
  - Split before/after comparison slider, HTML5 video player, 9-point placement grid, scale & opacity sliders.
- **Batch Processing**:
  - Multi-file drag & drop, batch progress tracker, and direct multi-download into Downloads folder or ZIP archive.

---

## 🚀 Getting Started

### 1. Requirements
- PHP 7.4+ or 8.x (XAMPP / Apache)
- Python 3.8+
- Python dependencies:
`ash
pip install opencv-python pillow numpy imageio-ffmpeg
`

### 2. Run via Browser
Place inside your web server directory (e.g. htdocs/watermark_tool) and navigate to:
`
http://localhost:8081/watermark_tool/
`
*(or http://localhost/watermark_tool/ depending on your Apache port)*

---

## 💻 CLI / Terminal Usage

You can also run the backend engine directly via Python:

### Single Image
`ash
python watermark_engine.py --input "path/to/image.jpg" --output "path/to/watermarked.jpg" --remove-gemini --corner bottom_right --logo "assets/logos/velmora_gems.png" --logo-pos center_left --logo-scale 0.28 --logo-opacity 0.85
`

### Video Processing
`ash
python watermark_engine.py --input "path/to/video.mp4" --output "path/to/watermarked.mp4" --remove-gemini --corner bottom_right --logo "assets/logos/shreeja_gems.png" --logo-pos center_left --logo-scale 0.28 --logo-opacity 0.85
`

### Batch Directory
`ash
python watermark_engine.py --input "raw_images_dir" --output "watermarked_dir" --remove-gemini --corner bottom_right --logo "assets/logos/velmora_gems.png" --logo-pos center_left
`

---

## 📁 Repository Structure
`
watermark-tool/
├── index.php             # Interactive web UI with split slider & batch tools
├── process.php           # REST API for processing, video handling & downloads
├── watermark_engine.py   # OpenCV inpainting + PIL + FFMPEG engine
├── assets/
│   └── logos/            # High-res Velmora Gems & Shreeja Gems logos
├── uploads/              # Upload cache (.gitignore protected)
├── outputs/              # Output cache (.gitignore protected)
└── .gitignore
`

---

## 📄 License
MIT License.
