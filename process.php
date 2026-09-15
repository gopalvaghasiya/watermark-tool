<?php
/**
 * Backend API for Gemini Watermark Remover & Branding Logo Overlay Tool
 */

require_once __DIR__ . '/auth.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

// Enforce Password Authentication
if (!is_authenticated()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Authentication required. Please enter password.']);
    exit;
}

$base_dir = __DIR__;
$upload_dir = $base_dir . DIRECTORY_SEPARATOR . 'uploads';
$output_dir = $base_dir . DIRECTORY_SEPARATOR . 'outputs';
$logos_dir  = $base_dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'logos';
$engine_py  = $base_dir . DIRECTORY_SEPARATOR . 'watermark_engine.py';

// Ensure directories exist
if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
if (!is_dir($output_dir)) mkdir($output_dir, 0777, true);
if (!is_dir($logos_dir))  mkdir($logos_dir, 0777, true);

// Housekeeping: remove temporary files older than 3 hours
cleanup_old_files($upload_dir, 3 * 3600);
cleanup_old_files($output_dir, 3 * 3600);

$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

switch ($action) {
    case 'get_logos':
        get_available_logos($logos_dir);
        break;

    case 'upload_custom_logo':
        upload_custom_logo($logos_dir);
        break;

    case 'process_single':
        process_single_image($upload_dir, $output_dir, $logos_dir, $engine_py);
        break;

    case 'process_batch':
        process_batch_images($upload_dir, $output_dir, $logos_dir, $engine_py);
        break;

    case 'download_zip':
        download_batch_zip($output_dir);
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action: ' . htmlspecialchars($action)]);
        break;
}

/**
 * List available logos in assets/logos
 */
function get_available_logos($logos_dir) {
    $logos = [
        [
            'filename' => 'velmora_gems.png',
            'name' => 'Velmora Gems (Rose Gold & Dark)',
            'brand' => 'velmora',
            'variant' => 'color',
            'url' => 'assets/logos/velmora_gems.png'
        ],
        [
            'filename' => 'velmora_gems_white.png',
            'name' => 'Velmora Gems (Pure White)',
            'brand' => 'velmora',
            'variant' => 'white',
            'url' => 'assets/logos/velmora_gems_white.png'
        ],
        [
            'filename' => 'shreeja_gems.png',
            'name' => 'Shreeja Gems (Luxury Gold)',
            'brand' => 'shreeja',
            'variant' => 'color',
            'url' => 'assets/logos/shreeja_gems.png'
        ],
        [
            'filename' => 'shreeja_gems_white.png',
            'name' => 'Shreeja Gems (Pure White)',
            'brand' => 'shreeja',
            'variant' => 'white',
            'url' => 'assets/logos/shreeja_gems_white.png'
        ]
    ];

    if (is_dir($logos_dir)) {
        $files = scandir($logos_dir);
        foreach ($files as $f) {
            if ($f === '.' || $f === '..' || substr($f, 0, 5) === 'test_' || in_array($f, ['velmora_gems.png', 'velmora_gems_white.png', 'shreeja_gems.png', 'shreeja_gems_white.png', 'logo_transparent.png', 'logo_white.png'])) continue;
            $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
            if (in_array($ext, ['png', 'webp', 'jpg', 'jpeg', 'svg'])) {
                $logos[] = [
                    'filename' => $f,
                    'name' => 'Custom: ' . ucwords(str_replace(['_', '-'], ' ', pathinfo($f, PATHINFO_FILENAME))),
                    'brand' => 'custom',
                    'variant' => 'custom',
                    'url' => 'assets/logos/' . rawurlencode($f)
                ];
            }
        }
    }
    echo json_encode(['success' => true, 'logos' => $logos]);
}

/**
 * Upload a custom branding logo
 */
function upload_custom_logo($logos_dir) {
    if (!isset($_FILES['logo_file']) || $_FILES['logo_file']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'error' => 'No logo file uploaded or upload error.']);
        return;
    }

    $file = $_FILES['logo_file'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['png', 'webp', 'jpg', 'jpeg', 'svg'])) {
        echo json_encode(['success' => false, 'error' => 'Invalid file format. Please upload a PNG, JPG, or WEBP logo.']);
        return;
    }

    $clean_name = 'custom_' . time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($file['name'], PATHINFO_FILENAME)) . '.' . $ext;
    $target_path = $logos_dir . DIRECTORY_SEPARATOR . $clean_name;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        echo json_encode([
            'success' => true,
            'logo' => [
                'filename' => $clean_name,
                'name' => 'Custom: ' . pathinfo($file['name'], PATHINFO_FILENAME),
                'url' => 'assets/logos/' . rawurlencode($clean_name)
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to save custom logo file.']);
    }
}

/**
 * Process a single image (interactive editor)
 */
function process_single_image($upload_dir, $output_dir, $logos_dir, $engine_py) {
    $input_path = '';
    $temp_mask_path = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $orig_name = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($orig_name, PATHINFO_EXTENSION));
        $valid_exts = ['jpg', 'jpeg', 'png', 'webp', 'mp4', 'mov', 'webm', 'avi', 'm4v'];
        if (!in_array($ext, $valid_exts)) {
            $ext = 'jpg';
        }
        $filename = 'media_' . uniqid() . '.' . $ext;
        $input_path = $upload_dir . DIRECTORY_SEPARATOR . $filename;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $input_path)) {
            echo json_encode(['success' => false, 'error' => 'Failed to move uploaded media.']);
            return;
        }
    } elseif (!empty($_POST['image_path']) && file_exists($_POST['image_path'])) {
        $input_path = $_POST['image_path'];
    } elseif (!empty($_POST['image_base64'])) {
        $data = $_POST['image_base64'];
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]);
            $decoded = base64_decode($data);
            if ($decoded !== false) {
                $filename = 'img_' . uniqid() . '.' . ($type === 'png' ? 'png' : 'jpg');
                $input_path = $upload_dir . DIRECTORY_SEPARATOR . $filename;
                file_put_contents($input_path, $decoded);
            }
        }
    }

    if (empty($input_path) || !file_exists($input_path)) {
        echo json_encode(['success' => false, 'error' => 'No valid image provided for processing.']);
        return;
    }

    // Handle brush mask if drawn in canvas
    if (!empty($_POST['mask_base64'])) {
        $mask_data = $_POST['mask_base64'];
        if (preg_match('/^data:image\/(\w+);base64,/', $mask_data)) {
            $mask_data = substr($mask_data, strpos($mask_data, ',') + 1);
            $mask_decoded = base64_decode($mask_data);
            if ($mask_decoded !== false) {
                $temp_mask_path = $upload_dir . DIRECTORY_SEPARATOR . 'mask_' . uniqid() . '.png';
                file_put_contents($temp_mask_path, $mask_decoded);
            }
        }
    }

    $remove_gemini = isset($_POST['remove_gemini']) ? filter_var($_POST['remove_gemini'], FILTER_VALIDATE_BOOLEAN) : true;
    $corner        = isset($_POST['corner']) ? trim($_POST['corner']) : 'bottom_right';
    $box_size      = isset($_POST['box_size']) ? floatval($_POST['box_size']) : 0.09;
    $margin        = isset($_POST['margin']) ? floatval($_POST['margin']) : 0.035;
    $inpaint_method= isset($_POST['method']) && in_array(strtolower($_POST['method']), ['telea', 'ns']) ? strtolower($_POST['method']) : 'telea';
    $inpaint_radius= isset($_POST['inpaint_radius']) ? intval($_POST['inpaint_radius']) : 5;
    $custom_boxes  = isset($_POST['custom_boxes']) ? trim($_POST['custom_boxes']) : '';

    $logo_name     = isset($_POST['logo_name']) ? trim($_POST['logo_name']) : '';
    $logo_pos      = isset($_POST['logo_pos']) ? trim($_POST['logo_pos']) : 'center_left';
    $logo_scale    = isset($_POST['logo_scale']) ? floatval($_POST['logo_scale']) : 0.28;
    $logo_opacity  = isset($_POST['logo_opacity']) ? floatval($_POST['logo_opacity']) : 0.85;
    $logo_margin   = isset($_POST['logo_margin']) ? floatval($_POST['logo_margin']) : 0.04;
    $logo_bg       = isset($_POST['logo_bg']) ? trim($_POST['logo_bg']) : 'auto';
    $logo_color    = isset($_POST['logo_color']) ? trim($_POST['logo_color']) : 'auto';
    $add_shadow    = isset($_POST['add_shadow']) ? filter_var($_POST['add_shadow'], FILTER_VALIDATE_BOOLEAN) : true;
    $quality       = isset($_POST['quality']) ? intval($_POST['quality']) : 98;

    $logo_path = '';
    if (!empty($logo_name)) {
        $candidate = $logos_dir . DIRECTORY_SEPARATOR . basename($logo_name);
        if (file_exists($candidate)) {
            $logo_path = $candidate;
        }
    }

    $in_ext = strtolower(pathinfo($input_path, PATHINFO_EXTENSION));
    $is_video = in_array($in_ext, ['mp4', 'mov', 'webm', 'avi', 'm4v']);
    $out_filename = 'proc_' . uniqid() . ($is_video ? '.mp4' : '.jpg');
    $output_path = $output_dir . DIRECTORY_SEPARATOR . $out_filename;

    // Build Python command
    $cmd = 'python ' . escapeshellarg($engine_py) . ' --input ' . escapeshellarg($input_path) . ' --output ' . escapeshellarg($output_path);

    if ($remove_gemini) {
        $cmd .= ' --remove-gemini --corner ' . escapeshellarg($corner) . ' --box-size ' . $box_size . ' --margin ' . $margin . ' --inpaint-radius ' . $inpaint_radius . ' --method ' . escapeshellarg($inpaint_method);
    } else {
        $cmd .= ' --no-remove-gemini';
    }

    if (!empty($custom_boxes)) {
        $cmd .= ' --boxes-json ' . escapeshellarg($custom_boxes);
    }

    if (!empty($temp_mask_path) && file_exists($temp_mask_path)) {
        $cmd .= ' --mask ' . escapeshellarg($temp_mask_path);
    }

    if (!empty($logo_path) && $logo_opacity > 0) {
        $cmd .= ' --logo ' . escapeshellarg($logo_path) . ' --logo-pos ' . escapeshellarg($logo_pos) . ' --logo-scale ' . $logo_scale . ' --logo-opacity ' . $logo_opacity . ' --logo-margin ' . $logo_margin . ' --logo-bg ' . escapeshellarg($logo_bg) . ' --logo-color ' . escapeshellarg($logo_color);
        if ($add_shadow) {
            $cmd .= ' --shadow';
        }
    }

    $cmd .= ' --quality ' . $quality;

    $exec_output = [];
    $return_var = 0;
    exec($cmd . ' 2>&1', $exec_output, $return_var);

    // Clean up temporary mask
    if ($temp_mask_path && file_exists($temp_mask_path)) {
        @unlink($temp_mask_path);
    }

    if ($return_var === 0 && file_exists($output_path)) {
        $img_info = $is_video ? null : @getimagesize($output_path);
        
        $rel_input = 'uploads/' . basename($input_path);
        $rel_output = 'outputs/' . $out_filename;

        echo json_encode([
            'success' => true,
            'is_video' => $is_video,
            'original_url' => $rel_input,
            'processed_url' => $rel_output,
            'filename' => $out_filename,
            'dimensions' => [
                'width' => $img_info ? $img_info[0] : 0,
                'height' => $img_info ? $img_info[1] : 0
            ],
            'filesize' => round(filesize($output_path) / 1024, 1) . ' KB',
            'command' => $cmd
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Processing failed. ' . implode(' ', $exec_output),
            'command' => $cmd
        ]);
    }
}

/**
 * Process a batch of images and videos
 */
function process_batch_images($upload_dir, $output_dir, $logos_dir, $engine_py) {
    if (!isset($_FILES['images']) || !is_array($_FILES['images']['name'])) {
        echo json_encode(['success' => false, 'error' => 'No files uploaded for batch processing.']);
        return;
    }

    $remove_gemini = isset($_POST['remove_gemini']) ? filter_var($_POST['remove_gemini'], FILTER_VALIDATE_BOOLEAN) : true;
    $corner        = isset($_POST['corner']) ? trim($_POST['corner']) : 'bottom_right';
    $box_size      = isset($_POST['box_size']) ? floatval($_POST['box_size']) : 0.09;
    $margin        = isset($_POST['margin']) ? floatval($_POST['margin']) : 0.035;
    $inpaint_method= isset($_POST['method']) ? trim($_POST['method']) : 'telea';
    $inpaint_radius= isset($_POST['inpaint_radius']) ? intval($_POST['inpaint_radius']) : 5;

    $logo_name     = isset($_POST['logo_name']) ? trim($_POST['logo_name']) : '';
    $logo_pos      = isset($_POST['logo_pos']) ? trim($_POST['logo_pos']) : 'center_left';
    $logo_scale    = isset($_POST['logo_scale']) ? floatval($_POST['logo_scale']) : 0.28;
    $logo_opacity  = isset($_POST['logo_opacity']) ? floatval($_POST['logo_opacity']) : 0.85;
    $logo_margin   = isset($_POST['logo_margin']) ? floatval($_POST['logo_margin']) : 0.04;
    $logo_bg       = isset($_POST['logo_bg']) ? trim($_POST['logo_bg']) : 'auto';
    $logo_color    = isset($_POST['logo_color']) ? trim($_POST['logo_color']) : 'auto';
    $add_shadow    = isset($_POST['add_shadow']) ? filter_var($_POST['add_shadow'], FILTER_VALIDATE_BOOLEAN) : true;
    $quality       = isset($_POST['quality']) ? intval($_POST['quality']) : 98;

    $logo_path = '';
    if (!empty($logo_name)) {
        $candidate = $logos_dir . DIRECTORY_SEPARATOR . basename($logo_name);
        if (file_exists($candidate)) {
            $logo_path = $candidate;
        }
    }

    $batch_id = 'batch_' . time() . '_' . substr(md5(uniqid()), 0, 6);
    $batch_in_dir  = $upload_dir . DIRECTORY_SEPARATOR . $batch_id;
    $batch_out_dir = $output_dir . DIRECTORY_SEPARATOR . $batch_id;
    mkdir($batch_in_dir, 0777, true);
    mkdir($batch_out_dir, 0777, true);

    $file_count = count($_FILES['images']['name']);
    $saved_files = [];

    for ($i = 0; $i < $file_count; $i++) {
        if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
            $orig_name = $_FILES['images']['name'][$i];
            $ext = strtolower(pathinfo($orig_name, PATHINFO_EXTENSION));
            $valid_exts = ['jpg', 'jpeg', 'png', 'webp', 'mp4', 'mov', 'webm', 'avi', 'm4v'];
            if (!in_array($ext, $valid_exts)) {
                continue;
            }
            $clean_basename = preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($orig_name, PATHINFO_FILENAME));
            $dest_name = sprintf('%03d_%s.%s', $i + 1, $clean_basename, $ext);
            $target = $batch_in_dir . DIRECTORY_SEPARATOR . $dest_name;
            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $target)) {
                $saved_files[] = $dest_name;
            }
        }
    }

    if (empty($saved_files)) {
        echo json_encode(['success' => false, 'error' => 'No valid images could be processed.']);
        return;
    }

    // Execute bulk processing with watermark_engine.py
    $cmd = 'python ' . escapeshellarg($engine_py) . ' --input ' . escapeshellarg($batch_in_dir) . ' --output ' . escapeshellarg($batch_out_dir);

    if ($remove_gemini) {
        $cmd .= ' --remove-gemini --corner ' . escapeshellarg($corner) . ' --box-size ' . $box_size . ' --margin ' . $margin . ' --inpaint-radius ' . $inpaint_radius . ' --method ' . escapeshellarg($inpaint_method);
    } else {
        $cmd .= ' --no-remove-gemini';
    }

    if (!empty($logo_path) && $logo_opacity > 0) {
        $cmd .= ' --logo ' . escapeshellarg($logo_path) . ' --logo-pos ' . escapeshellarg($logo_pos) . ' --logo-scale ' . $logo_scale . ' --logo-opacity ' . $logo_opacity . ' --logo-margin ' . $logo_margin . ' --logo-bg ' . escapeshellarg($logo_bg) . ' --logo-color ' . escapeshellarg($logo_color);
        if ($add_shadow) {
            $cmd .= ' --shadow';
        }
    }

    $cmd .= ' --quality ' . $quality;

    $exec_output = [];
    $return_var = 0;
    exec($cmd . ' 2>&1', $exec_output, $return_var);

    // Collect processed results
    $results = [];
    if (is_dir($batch_out_dir)) {
        $out_files = scandir($batch_out_dir);
        foreach ($out_files as $f) {
            if ($f === '.' || $f === '..') continue;
            $f_path = $batch_out_dir . DIRECTORY_SEPARATOR . $f;
            if (is_file($f_path)) {
                $results[] = [
                    'filename' => $f,
                    'url' => 'outputs/' . $batch_id . '/' . rawurlencode($f),
                    'filesize' => round(filesize($f_path) / 1024, 1) . ' KB'
                ];
            }
        }
    }

    echo json_encode([
        'success' => count($results) > 0,
        'batch_id' => $batch_id,
        'count' => count($results),
        'results' => $results,
        'zip_url' => 'process.php?action=download_zip&batch_id=' . urlencode($batch_id)
    ]);
}

/**
 * Generate and download ZIP file of batch results
 */
function download_batch_zip($output_dir) {
    $batch_id = isset($_GET['batch_id']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['batch_id']) : '';
    if (empty($batch_id)) {
        die('Invalid batch ID');
    }

    $target_dir = $output_dir . DIRECTORY_SEPARATOR . $batch_id;
    if (!is_dir($target_dir)) {
        die('Batch directory not found or expired.');
    }

    $zip_filename = 'Velmora_Cleaned_Watermarked_' . date('Ymd_His') . '.zip';
    $zip_path = $output_dir . DIRECTORY_SEPARATOR . $batch_id . '.zip';

    $zip = new ZipArchive();
    if ($zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        $files = scandir($target_dir);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            $filepath = $target_dir . DIRECTORY_SEPARATOR . $file;
            if (is_file($filepath)) {
                $zip->addFile($filepath, $file);
            }
        }
        $zip->close();
    } else {
        die('Failed to create ZIP archive.');
    }

    if (file_exists($zip_path)) {
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zip_filename . '"');
        header('Content-Length: ' . filesize($zip_path));
        readfile($zip_path);
        exit;
    }
}

/**
 * Helper to cleanup old files
 */
function cleanup_old_files($dir, $max_age_seconds) {
    if (!is_dir($dir)) return;
    $now = time();
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (filemtime($path) < ($now - $max_age_seconds)) {
            if (is_dir($path)) {
                delete_directory_recursive($path);
            } else {
                @unlink($path);
            }
        }
    }
}

function delete_directory_recursive($dir) {
    if (!is_dir($dir)) return;
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            delete_directory_recursive($path);
        } else {
            @unlink($path);
        }
    }
    @rmdir($dir);
}
