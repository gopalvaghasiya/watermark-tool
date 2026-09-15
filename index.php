<?php
require_once __DIR__ . '/auth.php';
$is_auth = is_authenticated();

if (!$is_auth):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gemini Watermark Studio (Velmora & Shreeja)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background-color: #080d1a;
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-slate-950">
    <!-- Glow effects -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-600/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-cyan-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative w-full max-w-md bg-slate-900/90 border border-slate-800 rounded-3xl p-8 shadow-2xl backdrop-blur-xl">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-400 text-white shadow-xl shadow-emerald-500/20 mb-4 ring-8 ring-emerald-500/10">
                <i data-lucide="shield-check" class="w-8 h-8"></i>
            </div>
            <h1 class="font-display text-2xl font-bold text-white">Private Studio Access</h1>
            <p class="text-xs text-slate-400 mt-1.5">Velmora Gems & Shreeja Gems Watermark Tool</p>
        </div>

        <?php if (!empty($login_error)): ?>
            <div class="mb-6 p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-medium flex items-center gap-2.5">
                <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 text-rose-400"></i>
                <span><?= htmlspecialchars($login_error) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php" class="space-y-5">
            <div>
                <label for="auth_password" class="block text-xs font-medium text-slate-300 mb-2">Enter Studio PIN</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input 
                        type="password" 
                        id="auth_password" 
                        name="auth_password" 
                        required 
                        autofocus
                        placeholder="Enter PIN"
                        class="w-full bg-slate-950/80 border border-slate-700/80 rounded-xl pl-10 pr-11 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition shadow-inner"
                    >
                    <button 
                        type="button" 
                        onclick="togglePasswordVisibility()" 
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-200 transition"
                    >
                        <i id="eyeIcon" data-lucide="eye" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <button 
                type="submit" 
                class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold text-sm shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 transition duration-150 flex items-center justify-center gap-2"
            >
                <i data-lucide="key-round" class="w-4 h-4"></i> Unlock Studio
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-800/80 text-center">
            <span class="text-[11px] text-slate-500 font-medium flex items-center justify-center gap-1.5">
                <i data-lucide="lock" class="w-3 h-3 text-emerald-500"></i> Protected Private Workspace
            </span>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function togglePasswordVisibility() {
            const passInput = document.getElementById('auth_password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.setAttribute('data-lucide', 'eye-off');
            } else {
                passInput.type = 'password';
                eyeIcon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
</body>
</html>
<?php
exit;
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemini Watermark Remover & Brand Studio - Velmora & Shreeja</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #0b1120;
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
        }
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }
        input[type="range"] {
            accent-color: #10b981;
        }
        .comparison-container {
            position: relative;
            overflow: hidden;
            user-select: none;
            display: inline-block;
            max-width: 100%;
        }
        .comparison-before {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            overflow: hidden;
            z-index: 10;
        }
        .comparison-divider {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #10b981;
            box-shadow: 0 0 12px rgba(16, 185, 129, 0.9);
            z-index: 20;
            cursor: ew-resize;
        }
        .comparison-handle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 32px;
            height: 32px;
            background: #10b981;
            border: 2px solid #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.6);
        }
        .brand-card-active {
            border-color: #10b981 !important;
            background: rgba(16, 185, 129, 0.1) !important;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Top Header -->
    <header class="border-b border-slate-800/80 bg-slate-900/90 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <i data-lucide="sparkles" class="w-5 h-5 text-white"></i>
                </div>
                <div>
                    <h1 class="font-display font-bold text-lg text-white leading-tight flex items-center gap-2">
                        Gemini Watermark Cleaner & Brand Studio
                        <span class="text-xs bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-2 py-0.5 rounded-full font-sans font-medium">Auto-Contrast Edition</span>
                    </h1>
                    <p class="text-xs text-slate-400">Velmora Gems & Shreeja Gems • Ultra-HD Etsy Listing Quality</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center gap-3">
                <a href="../create_draft.php" class="text-xs font-medium text-slate-300 hover:text-white px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 border border-slate-700 transition flex items-center gap-1.5">
                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Velmora Lab-Grown
                </a>
                <a href="../moissanite/index.php" class="text-xs font-medium text-slate-300 hover:text-white px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 border border-slate-700 transition flex items-center gap-1.5">
                    <i data-lucide="gem" class="w-3.5 h-3.5 text-cyan-400"></i> Shreeja Moissanite
                </a>
                <a href="auth.php?action=logout" class="text-xs font-medium text-rose-300 hover:text-white px-3 py-1.5 rounded-lg bg-rose-950/40 hover:bg-rose-900/60 border border-rose-800/60 transition flex items-center gap-1.5">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i> Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-6">
        
        <!-- Mode Tabs -->
        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
            <div class="inline-flex p-1 bg-slate-900 border border-slate-800 rounded-xl">
                <button onclick="switchMode('single')" id="tabSingle" class="px-5 py-2 text-sm font-semibold rounded-lg transition flex items-center gap-2 bg-emerald-500 text-white shadow">
                    <i data-lucide="image" class="w-4 h-4"></i> Single Image Studio
                </button>
                <button onclick="switchMode('batch')" id="tabBatch" class="px-5 py-2 text-sm font-semibold rounded-lg transition flex items-center gap-2 text-slate-400 hover:text-white">
                    <i data-lucide="layers" class="w-4 h-4"></i> Batch Bulk Processor
                </button>
            </div>
            
            <div class="text-xs text-slate-400 hidden sm:flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Smart Auto-Contrast Active (Adapts White/Color on Dark/Light Photos)</span>
            </div>
        </div>

        <!-- ==================== 1. SINGLE IMAGE STUDIO ==================== -->
        <div id="singleModeSection" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Left: Image Preview & Interactive Canvas (8 cols) -->
            <div class="lg:col-span-8 flex flex-col gap-4">
                
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 sm:p-6 flex flex-col relative shadow-2xl">
                    
                    <!-- Top Canvas Action Bar -->
                    <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-800 text-xs">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-slate-200">Image Canvas</span>
                            <span id="imageMeta" class="text-slate-400 truncate max-w-[200px]">No image loaded</span>
                        </div>
                        
                        <!-- View Mode Switcher -->
                        <div class="flex items-center gap-1.5" id="canvasControls" style="display: none;">
                            <div class="inline-flex p-0.5 bg-slate-950 rounded-lg border border-slate-800 text-[11px]">
                                <button onclick="setViewMode('split')" id="btnViewSplit" class="px-2.5 py-1 rounded font-medium bg-emerald-500 text-white">Split Swipe</button>
                                <button onclick="setViewMode('after')" id="btnViewAfter" class="px-2.5 py-1 rounded font-medium text-slate-400 hover:text-white">Final Result</button>
                                <button onclick="setViewMode('before')" id="btnViewBefore" class="px-2.5 py-1 rounded font-medium text-slate-400 hover:text-white">Original Gemini</button>
                            </div>
                        </div>
                    </div>

                    <!-- Dropzone / Image Viewport Container -->
                    <div id="dropzone" class="w-full min-h-[460px] max-h-[620px] rounded-xl border-2 border-dashed border-slate-700/80 hover:border-emerald-500/80 bg-slate-950/60 flex flex-col items-center justify-center p-4 text-center transition cursor-pointer relative overflow-hidden group">
                        
                        <!-- Empty State -->
                        <div id="emptyState" class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center group-hover:scale-110 transition duration-300">
                                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
                            </div>
                            <div>
                                <p class="text-base font-semibold text-slate-200">Drag & Drop your Gemini / AI jewelry photo here</p>
                                <p class="text-xs text-slate-400 mt-1">Supports JPG, PNG, WEBP • Paste directly with <kbd class="px-1.5 py-0.5 bg-slate-800 border border-slate-700 rounded text-slate-300">Ctrl+V</kbd></p>
                            </div>
                            <button class="mt-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold rounded-lg shadow-lg shadow-emerald-600/30 transition flex items-center gap-1.5">
                                <i data-lucide="file-plus" class="w-3.5 h-3.5"></i> Browse From Computer
                            </button>
                            <input type="file" id="fileInput" accept="image/*" class="hidden">
                        </div>

                        <!-- Active Media Viewport -->
                        <div id="previewContainer" class="hidden w-full h-full flex items-center justify-center relative overflow-hidden">
                            
                            <!-- Split Comparison Viewer (For Images) -->
                            <div id="comparisonBox" class="comparison-container rounded-lg shadow-2xl relative border border-slate-800">
                                <!-- Processed Image (Cleaned + Watermarked) -->
                                <img id="processedImg" class="max-h-[550px] w-auto max-w-full block object-contain select-none" alt="Processed Output">
                                
                                <!-- Original Image (Under Left Split) -->
                                <div id="comparisonBefore" class="comparison-before" style="width: 50%;">
                                    <img id="originalImg" class="max-h-[550px] w-auto max-w-full block object-contain select-none" alt="Original With Gemini Watermark">
                                    <div class="absolute top-3 left-3 bg-red-600/90 backdrop-blur-md text-white font-mono text-[10px] px-2 py-0.5 rounded uppercase tracking-wider font-bold z-10 pointer-events-none">
                                        Before (Gemini AI)
                                    </div>
                                </div>

                                <!-- Draggable Divider Handle -->
                                <div id="comparisonDivider" class="comparison-divider" style="left: 50%;">
                                    <div class="comparison-handle">
                                        <i data-lucide="chevrons-left-right" class="w-4 h-4 text-white"></i>
                                    </div>
                                </div>

                                <div id="badgeAfter" class="absolute top-3 right-3 bg-emerald-600/90 backdrop-blur-md text-white font-mono text-[10px] px-2 py-0.5 rounded uppercase tracking-wider font-bold z-10 pointer-events-none">
                                    After (<span id="currentBrandBadge">Velmora</span>)
                                </div>
                            </div>

                            <!-- Video Player Viewport (For Videos) -->
                            <div id="videoContainer" class="hidden w-full max-h-[550px] flex flex-col items-center justify-center gap-2">
                                <video id="processedVideo" class="max-h-[500px] max-w-full rounded-xl shadow-2xl border border-slate-800" controls autoplay loop playsinline muted></video>
                                <span class="text-[11px] text-emerald-400 font-medium flex items-center gap-1">
                                    <i data-lucide="film" class="w-3.5 h-3.5"></i> Video Watermarked & Rendered in H.264 HD
                                </span>
                            </div>

                        </div>

                        <!-- Processing Spinner -->
                        <div id="loadingOverlay" class="hidden absolute inset-0 bg-slate-950/80 backdrop-blur-sm z-30 flex flex-col items-center justify-center gap-3">
                            <div class="w-12 h-12 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin"></div>
                            <p class="text-sm font-semibold text-emerald-400 animate-pulse" id="loadingText">Inpainting Gemini watermark & applying branding...</p>
                        </div>
                    </div>

                    <!-- Bottom Quick Actions -->
                    <div id="bottomActionRow" class="hidden mt-4 pt-4 border-t border-slate-800 flex flex-wrap items-center justify-between gap-3">
                        <button onclick="clearCurrentSingle()" class="px-3 py-1.5 text-xs text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 rounded-lg border border-rose-500/20 transition flex items-center gap-1.5">
                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Clear & New Photo
                        </button>
                        <div class="flex items-center gap-3">
                            <button onclick="processSingle()" class="px-4 py-2 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 text-white text-xs font-bold rounded-lg shadow-lg shadow-emerald-500/20 transition flex items-center gap-1.5">
                                <i data-lucide="sparkles" class="w-4 h-4"></i> Re-Process / Apply Settings
                            </button>
                            <button onclick="downloadProcessedSingle()" class="px-5 py-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-xs font-extrabold rounded-lg shadow-lg shadow-emerald-500/30 transition flex items-center gap-1.5">
                                <i data-lucide="download" class="w-4 h-4"></i> Download Result
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right: Studio Controls Panel (4 cols) -->
            <div class="lg:col-span-4 flex flex-col gap-5">
                
                <!-- 1. Brand Selector (Velmora vs Shreeja) -->
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 shadow-xl space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center">
                                <i data-lucide="stamp" class="w-4 h-4"></i>
                            </div>
                            <h2 class="text-sm font-bold text-white">Select Your Brand</h2>
                        </div>
                        <span class="text-[11px] text-slate-400 font-medium" id="brandActiveIndicator">Velmora Gems</span>
                    </div>

                    <!-- 2 Brand Selection Cards -->
                    <div class="grid grid-cols-2 gap-3">
                        
                        <!-- Velmora Gems Card -->
                        <button type="button" onclick="selectBrand('velmora')" id="brandCardVelmora" class="brand-card-active p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-emerald-500/60 transition text-left flex flex-col gap-2 group">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-white group-hover:text-emerald-400 flex items-center gap-1.5">
                                    🌸 Velmora
                                </span>
                                <span id="checkVelmora" class="w-4 h-4 rounded-full bg-emerald-500 text-slate-950 flex items-center justify-center text-[10px] font-bold">✓</span>
                            </div>
                            <div class="w-full h-10 bg-slate-900 rounded-lg p-1 flex items-center justify-center border border-slate-800 overflow-hidden">
                                <img src="assets/logos/velmora_gems.png" class="max-h-full max-w-full object-contain" alt="Velmora Gems">
                            </div>
                            <span class="text-[10px] text-slate-400">Authentic & Fine Jewelry</span>
                        </button>

                        <!-- Shreeja Gems Card -->
                        <button type="button" onclick="selectBrand('shreeja')" id="brandCardShreeja" class="p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-amber-500/60 transition text-left flex flex-col gap-2 group">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-white group-hover:text-amber-400 flex items-center gap-1.5">
                                    💎 Shreeja
                                </span>
                                <span id="checkShreeja" class="w-4 h-4 rounded-full bg-slate-700 text-slate-400 flex items-center justify-center text-[10px] font-bold hidden">✓</span>
                            </div>
                            <div class="w-full h-10 bg-slate-900 rounded-lg p-1 flex items-center justify-center border border-slate-800 overflow-hidden">
                                <img src="assets/logos/shreeja_gems.png" class="max-h-full max-w-full object-contain" alt="Shreeja Gems">
                            </div>
                            <span class="text-[10px] text-slate-400">Moissanite & Diamonds</span>
                        </button>

                    </div>

                    <!-- Contrast & Color Appearance Mode -->
                    <div class="space-y-3 pt-2 border-t border-slate-800 text-xs">
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-slate-300 font-medium">Visibility & Contrast Mode</span>
                                <span class="text-[10px] text-emerald-400 font-semibold">Recommended: Auto</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" onclick="setColorMode('auto')" id="btnColorAuto" class="p-2 rounded-lg bg-emerald-500 text-white font-bold text-center text-[11px] shadow flex items-center justify-center gap-1">
                                    <span>⚡ Auto-Contrast</span>
                                </button>
                                <button type="button" onclick="setColorMode('white')" id="btnColorWhite" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-center text-[11px] border border-slate-700 flex items-center justify-center gap-1">
                                    <span>⚪ Crisp White</span>
                                </button>
                                <button type="button" onclick="setColorMode('original')" id="btnColorOriginal" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-center text-[11px] border border-slate-700 flex items-center justify-center gap-1">
                                    <span>🌸 Brand Colors</span>
                                </button>
                                <button type="button" onclick="setColorMode('gold')" id="btnColorGold" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-center text-[11px] border border-slate-700 flex items-center justify-center gap-1">
                                    <span>✨ Luxury Gold</span>
                                </button>
                            </div>
                        </div>

                        <!-- 9-Point Alignment Grid -->
                        <div>
                            <label class="text-slate-300 font-medium block mb-1.5">Logo Placement / Position</label>
                            <div class="grid grid-cols-3 gap-1.5 p-2 bg-slate-950/60 rounded-xl border border-slate-800">
                                <button type="button" onclick="setLogoPos('top_left')" data-pos="top_left" class="pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]">TL</button>
                                <button type="button" onclick="setLogoPos('top_center')" data-pos="top_center" class="pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]">Top</button>
                                <button type="button" onclick="setLogoPos('top_right')" data-pos="top_right" class="pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]">TR</button>
                                
                                <button type="button" onclick="setLogoPos('center_left')" data-pos="center_left" class="pos-btn p-2 rounded-lg bg-emerald-500 text-white font-bold text-center font-mono text-[10px]">Left</button>
                                <button type="button" onclick="setLogoPos('center')" data-pos="center" class="pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]">Center</button>
                                <button type="button" onclick="setLogoPos('center_right')" data-pos="center_right" class="pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]">Right</button>
                                
                                <button type="button" onclick="setLogoPos('bottom_left')" data-pos="bottom_left" class="pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]">BL</button>
                                <button type="button" onclick="setLogoPos('bottom_center')" data-pos="bottom_center" class="pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]">Bottom</button>
                                <button type="button" onclick="setLogoPos('bottom_right')" data-pos="bottom_right" class="pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]">BR</button>
                            </div>
                        </div>

                        <!-- Opacity Slider -->
                        <div>
                            <div class="flex justify-between items-center text-slate-400 mb-1">
                                <span class="font-medium text-slate-300">Logo Opacity</span>
                                <span id="valOpacity" class="text-emerald-400 font-mono font-bold">85%</span>
                            </div>
                            <input type="range" id="rngOpacity" min="0.20" max="1.0" step="0.05" value="0.85" class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer" oninput="document.getElementById('valOpacity').textContent = Math.round(this.value*100) + '%'" onchange="autoTriggerSingle()">
                            <div class="flex justify-between text-[10px] text-slate-400 mt-1">
                                <span onclick="setOpacityPreset(0.50)" class="cursor-pointer hover:text-emerald-400">50% (Subtle)</span>
                                <span onclick="setOpacityPreset(0.70)" class="cursor-pointer hover:text-emerald-400">70% (Medium)</span>
                                <span onclick="setOpacityPreset(0.85)" class="cursor-pointer hover:text-emerald-400 text-emerald-400 font-semibold">85% (High)</span>
                                <span onclick="setOpacityPreset(1.0)" class="cursor-pointer hover:text-emerald-400">100% (Solid)</span>
                            </div>
                        </div>

                        <!-- Scale Slider -->
                        <div>
                            <div class="flex justify-between text-slate-400 mb-1">
                                <span class="font-medium text-slate-300">Logo Size (Width %)</span>
                                <span id="valScale" class="text-emerald-400 font-mono">28%</span>
                            </div>
                            <input type="range" id="rngScale" min="0.10" max="0.65" step="0.01" value="0.28" class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer" oninput="document.getElementById('valScale').textContent = Math.round(this.value*100) + '%'" onchange="autoTriggerSingle()">
                        </div>

                        <!-- Drop Shadow Toggle -->
                        <div class="pt-2 border-t border-slate-800 flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer text-slate-300">
                                <input type="checkbox" id="chkShadow" checked class="rounded bg-slate-800 border-slate-700 text-emerald-500 focus:ring-0" onchange="autoTriggerSingle()">
                                <span>High-Contrast Drop Shadow</span>
                            </label>
                        </div>

                    </div>
                </div>

                <!-- 2. Gemini Watermark Removal Controls -->
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 shadow-xl space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-400 border border-amber-500/20 flex items-center justify-center">
                                <i data-lucide="eraser" class="w-4 h-4"></i>
                            </div>
                            <h2 class="text-sm font-bold text-white">2. Gemini Watermark Cleaner</h2>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="chkRemoveGemini" checked class="sr-only peer" onchange="autoTriggerSingle()">
                            <div class="w-9 h-5 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-500"></div>
                        </label>
                    </div>

                    <div id="geminiRemovalOptions" class="space-y-3 text-xs">
                        <div>
                            <label class="text-slate-300 font-medium block mb-1.5">Gemini Sparkle Location</label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex items-center gap-2 p-2 bg-slate-800/80 hover:bg-slate-800 rounded-lg border border-slate-700/80 cursor-pointer">
                                    <input type="radio" name="corner" value="bottom_right" checked class="text-emerald-500 focus:ring-0" onchange="autoTriggerSingle()">
                                    <span class="text-slate-200">Bottom-Right (Standard)</span>
                                </label>
                                <label class="flex items-center gap-2 p-2 bg-slate-800/80 hover:bg-slate-800 rounded-lg border border-slate-700/80 cursor-pointer">
                                    <input type="radio" name="corner" value="bottom_left" class="text-emerald-500 focus:ring-0" onchange="autoTriggerSingle()">
                                    <span class="text-slate-200">Bottom-Left</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 pt-1">
                            <div>
                                <div class="flex justify-between text-slate-400 mb-1">
                                    <span>Removal Box</span>
                                    <span id="valBoxSize" class="text-emerald-400 font-mono">9%</span>
                                </div>
                                <input type="range" id="rngBoxSize" min="0.04" max="0.18" step="0.01" value="0.09" class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer" oninput="document.getElementById('valBoxSize').textContent = Math.round(this.value*100) + '%'" onchange="autoTriggerSingle()">
                            </div>
                            <div>
                                <div class="flex justify-between text-slate-400 mb-1">
                                    <span>Corner Margin</span>
                                    <span id="valMargin" class="text-emerald-400 font-mono">3.5%</span>
                                </div>
                                <input type="range" id="rngMargin" min="0.01" max="0.08" step="0.005" value="0.035" class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer" oninput="document.getElementById('valMargin').textContent = (this.value*100).toFixed(1) + '%'" onchange="autoTriggerSingle()">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ==================== 2. BATCH PROCESSOR STUDIO ==================== -->
        <div id="batchModeSection" class="hidden flex-col gap-6">
            <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
                    <div>
                        <h2 class="text-base font-bold text-white flex items-center gap-2">
                            <i data-lucide="layers" class="w-5 h-5 text-emerald-400"></i>
                            Batch Image Cleaner & Watermarker
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Process 5, 20, or 100+ Gemini jewelry photos in one click with your selected brand.</p>
                    </div>
                    
                    <div id="batchGlobalActions" class="hidden flex flex-wrap items-center gap-3">
                        <button onclick="clearBatch()" class="px-3 py-2 text-xs text-rose-400 hover:bg-rose-500/10 rounded-lg border border-rose-500/20 transition">
                            Clear All
                        </button>
                        <button onclick="downloadAllIndividualImages()" id="btnDownloadAllDirect" class="px-5 py-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-xs font-bold rounded-lg shadow-lg shadow-emerald-500/30 transition flex items-center gap-1.5">
                            <i data-lucide="download" class="w-4 h-4"></i> Download All Images (Direct)
                        </button>
                        <a id="btnDownloadZip" href="#" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-lg border border-slate-700 transition flex items-center gap-1.5">
                            <i data-lucide="archive" class="w-4 h-4"></i> Download as ZIP
                        </a>
                    </div>
                </div>

                <!-- Batch Upload Zone -->
                <div id="batchDropzone" class="w-full min-h-[220px] rounded-xl border-2 border-dashed border-slate-700/80 hover:border-emerald-500/80 bg-slate-950/60 flex flex-col items-center justify-center p-6 text-center cursor-pointer transition relative group">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center group-hover:scale-110 transition duration-300">
                        <i data-lucide="folder-up" class="w-7 h-7"></i>
                    </div>
                    <p class="text-sm font-semibold text-slate-200 mt-3">Select or Drag Multiple Images / Whole Folders</p>
                    <p class="text-xs text-slate-400 mt-1">Batch clean all Gemini watermarks & apply <span id="batchSelectedBrandName" class="text-emerald-400 font-bold">Velmora Gems</span> watermark</p>
                    <button class="mt-3 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold rounded-lg border border-slate-700 transition">
                        Select Multiple Files
                    </button>
                    <input type="file" id="batchFileInput" multiple accept="image/*" class="hidden">
                </div>

                <!-- Batch Progress Bar -->
                <div id="batchProgressBox" class="hidden space-y-2">
                    <div class="flex justify-between text-xs">
                        <span class="text-slate-300 font-medium flex items-center gap-1.5">
                            <i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin text-emerald-400"></i> Processing Batch Images...
                        </span>
                        <span id="batchProgressPercent" class="text-emerald-400 font-mono font-bold">0%</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-800 rounded-full overflow-hidden">
                        <div id="batchProgressBar" class="h-full bg-emerald-500 transition-all duration-300 rounded-full" style="width: 0%;"></div>
                    </div>
                </div>

                <!-- Batch Results Grid -->
                <div id="batchResultsContainer" class="hidden space-y-3">
                    <div class="flex items-center justify-between text-xs text-slate-400">
                        <span>Processed Output Files (<span id="batchCountText">0</span>)</span>
                        <span class="text-emerald-400 font-medium">Ready for Etsy & Catalog</span>
                    </div>
                    <div id="batchGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                        <!-- Thumbnails injected dynamically -->
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Global Toast Notification -->
    <div id="toast" class="fixed bottom-5 right-5 bg-slate-900 border border-slate-700 text-slate-100 px-4 py-3 rounded-xl shadow-2xl z-50 flex items-center gap-2 transform translate-y-20 opacity-0 transition duration-300 pointer-events-none text-xs">
        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400" id="toastIcon"></i>
        <span id="toastMsg">Notification</span>
    </div>

    <!-- Frontend Script -->
    <script>
        let currentSingleFile = null;
        let currentProcessedUrl = null;
        let currentBrand = 'velmora'; // 'velmora' or 'shreeja'
        let currentColorMode = 'auto'; // 'auto', 'white', 'original', 'gold'
        let selectedLogoPos = 'center_left';
        let selectedInpaintMethod = 'telea';
        let currentViewMode = 'split';
        let isProcessing = false;

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            setupDragAndDrop();
            setupSplitSlider();
            loadSavedSettings();
            updateBrandUI();
            updateColorModeUI();
        });

        function showToast(msg, isError = false) {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toastMsg');
            toastMsg.textContent = msg;
            toast.className = isError 
                ? 'fixed bottom-5 right-5 bg-rose-950 border border-rose-800 text-rose-100 px-4 py-3 rounded-xl shadow-2xl z-50 flex items-center gap-2 transform translate-y-0 opacity-100 transition duration-300 text-xs'
                : 'fixed bottom-5 right-5 bg-slate-900 border border-slate-700 text-slate-100 px-4 py-3 rounded-xl shadow-2xl z-50 flex items-center gap-2 transform translate-y-0 opacity-100 transition duration-300 text-xs';
            setTimeout(() => {
                toast.className = 'fixed bottom-5 right-5 bg-slate-900 border border-slate-700 text-slate-100 px-4 py-3 rounded-xl shadow-2xl z-50 flex items-center gap-2 transform translate-y-20 opacity-0 transition duration-300 pointer-events-none text-xs';
            }, 3000);
        }

        function switchMode(mode) {
            const singleSec = document.getElementById('singleModeSection');
            const batchSec = document.getElementById('batchModeSection');
            const tabSingle = document.getElementById('tabSingle');
            const tabBatch = document.getElementById('tabBatch');

            if (mode === 'single') {
                singleSec.classList.remove('hidden');
                batchSec.classList.add('hidden');
                tabSingle.className = 'px-5 py-2 text-sm font-semibold rounded-lg transition flex items-center gap-2 bg-emerald-500 text-white shadow';
                tabBatch.className = 'px-5 py-2 text-sm font-semibold rounded-lg transition flex items-center gap-2 text-slate-400 hover:text-white';
            } else {
                singleSec.classList.add('hidden');
                batchSec.classList.remove('hidden');
                tabSingle.className = 'px-5 py-2 text-sm font-semibold rounded-lg transition flex items-center gap-2 text-slate-400 hover:text-white';
                tabBatch.className = 'px-5 py-2 text-sm font-semibold rounded-lg transition flex items-center gap-2 bg-emerald-500 text-white shadow';
            }
        }

        function selectBrand(brand) {
            currentBrand = brand;
            updateBrandUI();
            saveSettings();
            showToast(`Selected: ${brand === 'velmora' ? 'Velmora Gems' : 'Shreeja Gems'}`);
            autoTriggerSingle();
        }

        function setColorMode(mode) {
            currentColorMode = mode;
            updateColorModeUI();
            saveSettings();
            autoTriggerSingle();
        }

        function updateColorModeUI() {
            const modes = ['auto', 'white', 'original', 'gold'];
            modes.forEach(m => {
                const btn = document.getElementById('btnColor' + m.charAt(0).toUpperCase() + m.slice(1));
                if (btn) {
                    if (m === currentColorMode) {
                        btn.className = 'p-2 rounded-lg bg-emerald-500 text-white font-bold text-center text-[11px] shadow flex items-center justify-center gap-1';
                    } else {
                        btn.className = 'p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-center text-[11px] border border-slate-700 flex items-center justify-center gap-1';
                    }
                }
            });
        }

        function getActiveLogoFilename() {
            return currentBrand === 'velmora' ? 'velmora_gems.png' : 'shreeja_gems.png';
        }

        function updateBrandUI() {
            const cardVelmora = document.getElementById('brandCardVelmora');
            const cardShreeja = document.getElementById('brandCardShreeja');
            const checkVelmora = document.getElementById('checkVelmora');
            const checkShreeja = document.getElementById('checkShreeja');
            const brandActiveInd = document.getElementById('brandActiveIndicator');
            const currentBrandBadge = document.getElementById('currentBrandBadge');
            const batchSelectedBrandName = document.getElementById('batchSelectedBrandName');

            if (currentBrand === 'velmora') {
                cardVelmora.className = 'brand-card-active p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-emerald-500/60 transition text-left flex flex-col gap-2 group';
                cardShreeja.className = 'p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-amber-500/60 transition text-left flex flex-col gap-2 group';
                checkVelmora.classList.remove('hidden');
                checkShreeja.classList.add('hidden');
                brandActiveInd.textContent = 'Velmora Gems Active';
                currentBrandBadge.textContent = 'Velmora Gems';
                batchSelectedBrandName.textContent = 'Velmora Gems';
            } else {
                cardShreeja.className = 'brand-card-active p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-amber-500/60 transition text-left flex flex-col gap-2 group';
                cardVelmora.className = 'p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-emerald-500/60 transition text-left flex flex-col gap-2 group';
                checkShreeja.classList.remove('hidden');
                checkVelmora.classList.add('hidden');
                brandActiveInd.textContent = 'Shreeja Gems Active';
                currentBrandBadge.textContent = 'Shreeja Gems';
                batchSelectedBrandName.textContent = 'Shreeja Gems';
            }
        }

        function setLogoPos(pos) {
            selectedLogoPos = pos;
            document.querySelectorAll('.pos-btn').forEach(btn => {
                if (btn.getAttribute('data-pos') === pos) {
                    btn.className = 'pos-btn p-2 rounded-lg bg-emerald-500 text-white font-bold text-center font-mono text-[10px] shadow';
                } else {
                    btn.className = 'pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]';
                }
            });
            saveSettings();
            autoTriggerSingle();
        }

        function setOpacityPreset(val) {
            document.getElementById('rngOpacity').value = val;
            document.getElementById('valOpacity').textContent = Math.round(val * 100) + '%';
            saveSettings();
            autoTriggerSingle();
        }

        function setViewMode(mode) {
            currentViewMode = mode;
            const btnSplit = document.getElementById('btnViewSplit');
            const btnAfter = document.getElementById('btnViewAfter');
            const btnBefore = document.getElementById('btnViewBefore');
            const beforeBox = document.getElementById('comparisonBefore');
            const divider = document.getElementById('comparisonDivider');
            const badgeAfter = document.getElementById('badgeAfter');

            [btnSplit, btnAfter, btnBefore].forEach(b => b.className = 'px-2.5 py-1 rounded font-medium text-slate-400 hover:text-white');

            if (mode === 'split') {
                btnSplit.className = 'px-2.5 py-1 rounded font-medium bg-emerald-500 text-white';
                beforeBox.style.display = 'block';
                beforeBox.style.width = '50%';
                divider.style.display = 'block';
                divider.style.left = '50%';
                badgeAfter.style.display = 'block';
            } else if (mode === 'after') {
                btnAfter.className = 'px-2.5 py-1 rounded font-medium bg-emerald-500 text-white';
                beforeBox.style.display = 'none';
                divider.style.display = 'none';
                badgeAfter.style.display = 'block';
            } else if (mode === 'before') {
                btnBefore.className = 'px-2.5 py-1 rounded font-medium bg-emerald-500 text-white';
                beforeBox.style.display = 'block';
                beforeBox.style.width = '100%';
                divider.style.display = 'none';
                badgeAfter.style.display = 'none';
            }
        }

        function setupDragAndDrop() {
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('fileInput');

            dropzone.addEventListener('click', (e) => {
                if (!currentSingleFile) fileInput.click();
            });

            fileInput.addEventListener('change', (e) => {
                if (e.target.files && e.target.files[0]) {
                    loadSingleFile(e.target.files[0]);
                }
            });

            ['dragenter', 'dragover'].forEach(name => {
                dropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    dropzone.classList.add('border-emerald-500', 'bg-emerald-500/5');
                });
            });

            ['dragleave', 'drop'].forEach(name => {
                dropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('border-emerald-500', 'bg-emerald-500/5');
                });
            });

            dropzone.addEventListener('drop', (e) => {
                if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                    loadSingleFile(e.dataTransfer.files[0]);
                }
            });

            window.addEventListener('paste', (e) => {
                const items = e.clipboardData.items;
                for (let i = 0; i < items.length; i++) {
                    if (items[i].type.indexOf('image') !== -1) {
                        const blob = items[i].getAsFile();
                        loadSingleFile(blob);
                        showToast('Image pasted from clipboard!');
                        break;
                    }
                }
            });

            const batchDropzone = document.getElementById('batchDropzone');
            const batchFileInput = document.getElementById('batchFileInput');

            batchDropzone.addEventListener('click', () => batchFileInput.click());
            batchFileInput.addEventListener('change', (e) => {
                if (e.target.files && e.target.files.length > 0) {
                    processBatch(e.target.files);
                }
            });

            ['dragenter', 'dragover'].forEach(name => {
                batchDropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    batchDropzone.classList.add('border-emerald-500', 'bg-emerald-500/5');
                });
            });

            ['dragleave', 'drop'].forEach(name => {
                batchDropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    batchDropzone.classList.remove('border-emerald-500', 'bg-emerald-500/5');
                });
            });

            batchDropzone.addEventListener('drop', (e) => {
                if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                    processBatch(e.dataTransfer.files);
                }
            });
        }

        function loadSingleFile(file) {
            currentSingleFile = file;
            const isVideo = (file.type && file.type.startsWith('video/')) || /\.(mp4|mov|webm|avi|m4v)$/i.test(file.name || '');

            if (isVideo) {
                document.getElementById('emptyState').classList.add('hidden');
                document.getElementById('previewContainer').classList.remove('hidden');
                document.getElementById('canvasControls').style.display = 'none';
                document.getElementById('bottomActionRow').classList.remove('hidden');
                document.getElementById('imageMeta').textContent = `${file.name || 'Video'} • ${(file.size/(1024*1024)).toFixed(1)} MB`;
                processSingle();
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('originalImg').src = e.target.result;
                    document.getElementById('emptyState').classList.add('hidden');
                    document.getElementById('previewContainer').classList.remove('hidden');
                    document.getElementById('canvasControls').style.display = 'flex';
                    document.getElementById('bottomActionRow').classList.remove('hidden');
                    document.getElementById('imageMeta').textContent = `${file.name || 'Image'} • ${(file.size/1024).toFixed(1)} KB`;
                    processSingle();
                };
                reader.readAsDataURL(file);
            }
        }

        let debounceTimer = null;
        function autoTriggerSingle() {
            if (!currentSingleFile) return;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                processSingle();
            }, 300);
        }

        async function processSingle() {
            if (!currentSingleFile || isProcessing) return;
            isProcessing = true;

            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.remove('hidden');

            const logoName = getActiveLogoFilename();

            const formData = new FormData();
            formData.append('action', 'process_single');
            formData.append('image', currentSingleFile);
            formData.append('remove_gemini', document.getElementById('chkRemoveGemini').checked);
            
            const corner = document.querySelector('input[name="corner"]:checked') ? document.querySelector('input[name="corner"]:checked').value : 'bottom_right';
            formData.append('corner', corner);
            formData.append('box_size', document.getElementById('rngBoxSize').value);
            formData.append('margin', document.getElementById('rngMargin').value);
            formData.append('method', selectedInpaintMethod);
            formData.append('logo_name', logoName);
            formData.append('logo_pos', selectedLogoPos);
            formData.append('logo_scale', document.getElementById('rngScale').value);
            formData.append('logo_opacity', document.getElementById('rngOpacity').value);
            formData.append('logo_color', currentColorMode);
            formData.append('add_shadow', document.getElementById('chkShadow').checked);

            try {
                const res = await fetch('process.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    currentProcessedUrl = data.processed_url;
                    
                    if (data.is_video) {
                        document.getElementById('comparisonBox').classList.add('hidden');
                        document.getElementById('videoContainer').classList.remove('hidden');
                        const video = document.getElementById('processedVideo');
                        video.src = data.processed_url + '?t=' + Date.now();
                        video.play().catch(() => {});
                    } else {
                        document.getElementById('videoContainer').classList.add('hidden');
                        document.getElementById('comparisonBox').classList.remove('hidden');
                        const processedImg = document.getElementById('processedImg');
                        processedImg.src = data.processed_url + '?t=' + Date.now();
                        processedImg.onload = () => {
                            syncImageDimensions();
                        };
                    }
                    showToast(`${currentBrand === 'velmora' ? 'Velmora' : 'Shreeja'} watermark applied!`);
                } else {
                    showToast(data.error || 'Failed to process media', true);
                }
            } catch (e) {
                showToast('Network / Server Error', true);
            } finally {
                loadingOverlay.classList.add('hidden');
                isProcessing = false;
            }
        }

        function syncImageDimensions() {
            const proc = document.getElementById('processedImg');
            const orig = document.getElementById('originalImg');
            if (proc.clientWidth > 0) {
                orig.style.width = proc.clientWidth + 'px';
                orig.style.height = proc.clientHeight + 'px';
            }
        }

        function setupSplitSlider() {
            const container = document.getElementById('comparisonBox');
            const before = document.getElementById('comparisonBefore');
            const divider = document.getElementById('comparisonDivider');
            let isDragging = false;

            function updatePosition(clientX) {
                if (currentViewMode !== 'split') return;
                const rect = container.getBoundingClientRect();
                let x = clientX - rect.left;
                if (x < 0) x = 0;
                if (x > rect.width) x = rect.width;
                const pct = (x / rect.width) * 100;
                before.style.width = pct + '%';
                divider.style.left = pct + '%';
            }

            container.addEventListener('mousedown', (e) => {
                if (currentViewMode !== 'split') return;
                isDragging = true;
                updatePosition(e.clientX);
            });
            window.addEventListener('mouseup', () => isDragging = false);
            window.addEventListener('mousemove', (e) => {
                if (isDragging) updatePosition(e.clientX);
            });

            container.addEventListener('touchstart', (e) => {
                if (currentViewMode !== 'split') return;
                isDragging = true;
                if (e.touches[0]) updatePosition(e.touches[0].clientX);
            });
            window.addEventListener('touchend', () => isDragging = false);
            window.addEventListener('touchmove', (e) => {
                if (isDragging && e.touches[0]) updatePosition(e.touches[0].clientX);
            });

            window.addEventListener('resize', syncImageDimensions);
        }

        function downloadProcessedSingle() {
            if (!currentProcessedUrl) {
                showToast('No processed image ready to download', true);
                return;
            }
            const link = document.createElement('a');
            link.href = currentProcessedUrl;
            link.download = `${currentBrand}_cleaned_` + (currentSingleFile ? currentSingleFile.name : 'gemini_image.jpg');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            showToast('Image downloaded successfully!');
        }

        function clearCurrentSingle() {
            currentSingleFile = null;
            currentProcessedUrl = null;
            document.getElementById('fileInput').value = '';
            document.getElementById('originalImg').src = '';
            document.getElementById('processedImg').src = '';
            document.getElementById('emptyState').classList.remove('hidden');
            document.getElementById('previewContainer').classList.add('hidden');
            document.getElementById('canvasControls').style.display = 'none';
            document.getElementById('bottomActionRow').classList.add('hidden');
            document.getElementById('imageMeta').textContent = 'No image loaded';
        }

        async function processBatch(files) {
            if (!files || files.length === 0) return;

            const progressBox = document.getElementById('batchProgressBox');
            const progressBar = document.getElementById('batchProgressBar');
            const progressPercent = document.getElementById('batchProgressPercent');
            const resultsContainer = document.getElementById('batchResultsContainer');
            const grid = document.getElementById('batchGrid');
            const globalActions = document.getElementById('batchGlobalActions');
            const btnZip = document.getElementById('btnDownloadZip');

            progressBox.classList.remove('hidden');
            progressBar.style.width = '20%';
            progressPercent.textContent = '20%';

            const logoName = getActiveLogoFilename();

            const formData = new FormData();
            formData.append('action', 'process_batch');
            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            formData.append('remove_gemini', document.getElementById('chkRemoveGemini').checked);
            const corner = document.querySelector('input[name="corner"]:checked') ? document.querySelector('input[name="corner"]:checked').value : 'bottom_right';
            formData.append('corner', corner);
            formData.append('box_size', document.getElementById('rngBoxSize').value);
            formData.append('margin', document.getElementById('rngMargin').value);
            formData.append('method', selectedInpaintMethod);
            formData.append('logo_name', logoName);
            formData.append('logo_pos', selectedLogoPos);
            formData.append('logo_scale', document.getElementById('rngScale').value);
            formData.append('logo_opacity', document.getElementById('rngOpacity').value);
            formData.append('logo_color', currentColorMode);
            formData.append('add_shadow', document.getElementById('chkShadow').checked);

            try {
                progressBar.style.width = '60%';
                progressPercent.textContent = '60%';

                const res = await fetch('process.php', { method: 'POST', body: formData });
                const data = await res.json();

                progressBar.style.width = '100%';
                progressPercent.textContent = '100%';

                if (data.success && data.results) {
                    currentBatchResults = data.results;
                    grid.innerHTML = '';
                    data.results.forEach(item => {
                        const card = document.createElement('div');
                        card.className = 'bg-slate-950/80 border border-slate-800 rounded-xl p-2 flex flex-col gap-2 group hover:border-emerald-500/50 transition';
                        card.innerHTML = `
                            <div class="relative overflow-hidden rounded-lg aspect-square bg-slate-900">
                                <img src="${item.url}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy">
                            </div>
                            <div class="flex items-center justify-between text-[11px] px-1">
                                <span class="truncate text-slate-300 text-[10px]" title="${item.filename}">${item.filename}</span>
                                <a href="${item.url}" download="${item.filename}" class="text-emerald-400 hover:text-emerald-300 p-1">
                                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        `;
                        grid.appendChild(card);
                    });

                    document.getElementById('batchCountText').textContent = `${data.count} images`;
                    btnZip.href = data.zip_url;
                    resultsContainer.classList.remove('hidden');
                    globalActions.classList.remove('hidden');
                    lucide.createIcons();
                    showToast(`Batch completed: ${data.count} images processed!`);
                } else {
                    showToast(data.error || 'Batch processing failed', true);
                }
            } catch (e) {
                showToast('Batch processing network error', true);
            } finally {
                setTimeout(() => progressBox.classList.add('hidden'), 1000);
            }
        }

        let currentBatchResults = [];

        function downloadAllIndividualImages() {
            if (!currentBatchResults || currentBatchResults.length === 0) {
                showToast('No processed images to download', true);
                return;
            }

            showToast(`Downloading ${currentBatchResults.length} images directly to your Downloads folder...`);

            currentBatchResults.forEach((item, index) => {
                setTimeout(() => {
                    const link = document.createElement('a');
                    link.href = item.url;
                    link.download = item.filename;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }, index * 200);
            });
        }

        function clearBatch() {
            currentBatchResults = [];
            document.getElementById('batchFileInput').value = '';
            document.getElementById('batchResultsContainer').classList.add('hidden');
            document.getElementById('batchGlobalActions').classList.add('hidden');
            document.getElementById('batchGrid').innerHTML = '';
        }

        function saveSettings() {
            const settings = {
                brand: currentBrand,
                colorMode: currentColorMode,
                logoPos: selectedLogoPos,
                opacity: document.getElementById('rngOpacity').value,
                scale: document.getElementById('rngScale').value,
                shadow: document.getElementById('chkShadow').checked
            };
            localStorage.setItem('velmora_wm_settings', JSON.stringify(settings));
        }

        function loadSavedSettings() {
            try {
                const saved = localStorage.getItem('velmora_wm_settings');
                if (saved) {
                    const s = JSON.parse(saved);
                    if (s.brand) selectBrand(s.brand);
                    if (s.colorMode) setColorMode(s.colorMode);
                    if (s.logoPos) setLogoPos(s.logoPos);
                    if (s.opacity) {
                        document.getElementById('rngOpacity').value = s.opacity;
                        document.getElementById('valOpacity').textContent = Math.round(s.opacity * 100) + '%';
                    }
                    if (s.scale) {
                        document.getElementById('rngScale').value = s.scale;
                        document.getElementById('valScale').textContent = Math.round(s.scale * 100) + '%';
                    }
                    if (s.shadow !== undefined) {
                        document.getElementById('chkShadow').checked = s.shadow;
                    }
                }
            } catch (e) {}
        }
    </script>
</body>
</html>
