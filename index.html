<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemini Watermark Cleaner & Brand Studio - Shreeja & Velmora</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- JSZip & FileSaver for 100% Client-Side In-Browser Bulk Downloads -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
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
            accent-color: #f59e0b;
        }
        .brand-card-active-shreeja {
            border-color: #f59e0b !important;
            background: rgba(245, 158, 11, 0.12) !important;
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.25);
        }
        .brand-card-active-velmora {
            border-color: #10b981 !important;
            background: rgba(16, 185, 129, 0.12) !important;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.25);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-amber-500 selection:text-white">

    <!-- ==================== PIN AUTHENTICATION MODAL (1243) ==================== -->
    <div id="pinAuthModal" class="fixed inset-0 z-[999] bg-slate-950 flex items-center justify-center p-4">
        <!-- Background Ambient Glow -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-amber-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative w-full max-w-md bg-slate-900/90 border border-slate-800 rounded-3xl p-8 shadow-2xl backdrop-blur-xl">
            <div class="text-center mb-7">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 shadow-xl shadow-amber-500/20 mb-4 ring-8 ring-amber-500/10">
                    <i data-lucide="gem" class="w-8 h-8"></i>
                </div>
                <h1 class="font-display text-2xl font-bold text-white">Private Studio Access</h1>
                <p class="text-xs text-slate-400 mt-1.5">Shreeja Gems & Velmora Gems Watermark Tool</p>
            </div>

            <div id="pinErrorMsg" class="hidden mb-5 p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-medium flex items-center gap-2.5">
                <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 text-rose-400"></i>
                <span id="pinErrorText">Incorrect PIN. Please try again.</span>
            </div>

            <form id="pinForm" onsubmit="handlePinSubmit(event)" class="space-y-5">
                <div>
                    <label for="authPinInput" class="block text-xs font-medium text-slate-300 mb-2">Enter Studio PIN</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </div>
                        <input 
                            type="password" 
                            id="authPinInput" 
                            required 
                            autofocus
                            placeholder="Enter 4-digit PIN"
                            class="w-full bg-slate-950/80 border border-slate-700/80 rounded-xl pl-10 pr-11 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition shadow-inner font-mono tracking-widest text-center"
                        >
                        <button 
                            type="button" 
                            onclick="togglePinVisibility()" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-200 transition"
                        >
                            <i id="eyePinIcon" data-lucide="eye" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <button 
                    type="submit" 
                    class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-400 hover:from-amber-600 hover:to-yellow-500 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/25 hover:shadow-amber-500/40 transition duration-150 flex items-center justify-center gap-2"
                >
                    <i data-lucide="key-round" class="w-4 h-4"></i> Unlock Studio
                </button>
            </form>

            <div class="mt-7 pt-5 border-t border-slate-800/80 text-center">
                <span class="text-[11px] text-slate-500 font-medium flex items-center justify-center gap-1.5">
                    <i data-lucide="lock" class="w-3 h-3 text-amber-500"></i> Protected Private Workspace
                </span>
            </div>
        </div>
    </div>

    <!-- Top Header -->
    <header class="border-b border-slate-800/80 bg-slate-900/90 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-yellow-400 flex items-center justify-center shadow-lg shadow-amber-500/20 text-slate-950">
                    <i data-lucide="gem" class="w-5 h-5"></i>
                </div>
                <div>
                    <h1 class="font-display font-bold text-lg text-white leading-tight flex items-center gap-2">
                        Gemini Watermark Cleaner & Brand Studio
                        <span class="text-xs bg-amber-500/20 text-amber-400 border border-amber-500/30 px-2 py-0.5 rounded-full font-sans font-medium">Batch Studio</span>
                    </h1>
                    <p class="text-xs text-slate-400">Shreeja Gems & Velmora Gems • Ultra-HD Batch Processor</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center gap-3">
                <span class="hidden md:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-800/80 border border-slate-700 text-xs text-slate-300">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    Default: <strong id="headerBrandBadge" class="text-amber-400">Shreeja Gems</strong>
                </span>
                <button onclick="lockStudio()" class="text-xs font-medium text-rose-300 hover:text-white px-3 py-1.5 rounded-lg bg-rose-950/40 hover:bg-rose-900/60 border border-rose-800/60 transition flex items-center gap-1.5" title="Lock Studio">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i> Lock
                </button>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-6">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Left: Batch Upload Zone & Gallery (8 cols) -->
            <div class="lg:col-span-8 flex flex-col gap-5">
                
                <!-- Batch Upload Zone -->
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-5">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-800">
                        <div>
                            <h2 class="text-base font-bold text-white flex items-center gap-2">
                                <i data-lucide="folder-up" class="w-5 h-5 text-amber-400"></i>
                                Batch Images / Video Processor
                            </h2>
                            <p class="text-xs text-slate-400 mt-0.5">Select multiple images (5, 20, 100+) or whole folders to batch clean and watermark.</p>
                        </div>
                        <span class="text-xs px-2.5 py-1 rounded-lg bg-slate-800 text-slate-300 border border-slate-700 flex items-center gap-1 self-start sm:self-auto">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-amber-400"></i> Multi-Select Active
                        </span>
                    </div>

                    <!-- Dropzone -->
                    <div id="batchDropzone" class="w-full min-h-[220px] rounded-xl border-2 border-dashed border-slate-700/80 hover:border-amber-500/80 bg-slate-950/60 flex flex-col items-center justify-center p-6 text-center cursor-pointer transition relative group">
                        <div class="w-16 h-16 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center group-hover:scale-110 transition duration-300">
                            <i data-lucide="upload-cloud" class="w-8 h-8"></i>
                        </div>
                        <p class="text-base font-semibold text-slate-200 mt-3">Click or Drag & Drop Multiple Photos Here</p>
                        <p class="text-xs text-slate-400 mt-1">Supports JPG, PNG, WEBP, MP4 • Paste directly with <kbd class="px-1.5 py-0.5 bg-slate-800 border border-slate-700 rounded text-slate-300">Ctrl+V</kbd></p>
                        <p class="text-xs text-amber-400 font-medium mt-1">Applying <span id="batchSelectedBrandName" class="font-bold">Shreeja Gems</span> logo watermark</p>
                        
                        <div class="mt-4 flex items-center gap-2">
                            <button type="button" class="px-5 py-2.5 bg-gradient-to-r from-amber-500 to-yellow-400 hover:from-amber-600 hover:to-yellow-500 text-slate-950 font-bold text-xs rounded-xl shadow-lg shadow-amber-500/20 transition flex items-center gap-1.5">
                                <i data-lucide="images" class="w-4 h-4"></i> Browse Multiple Files
                            </button>
                        </div>
                        <input type="file" id="batchFileInput" multiple accept="image/*,video/*,.mp4,.mov,.webm,.avi,.m4v" class="hidden">
                    </div>

                    <!-- Batch Progress Bar -->
                    <div id="batchProgressBox" class="hidden space-y-2 p-4 bg-slate-950/70 border border-slate-800 rounded-xl">
                        <div class="flex justify-between text-xs">
                            <span class="text-slate-300 font-medium flex items-center gap-2" id="batchProgressLabel">
                                <i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin text-amber-400"></i> Processing images...
                            </span>
                            <span id="batchProgressPercent" class="text-amber-400 font-mono font-bold">0%</span>
                        </div>
                        <div class="w-full h-2.5 bg-slate-800 rounded-full overflow-hidden">
                            <div id="batchProgressBar" class="h-full bg-gradient-to-r from-amber-500 to-yellow-400 transition-all duration-200 rounded-full" style="width: 0%;"></div>
                        </div>
                    </div>

                </div>

                <!-- Batch Results Gallery -->
                <div id="batchResultsContainer" class="hidden bg-slate-900/80 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-5">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
                        <div>
                            <h3 class="text-base font-bold text-white flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400"></i>
                                Processed Photos (<span id="batchCountText">0</span>)
                            </h3>
                            <p class="text-xs text-slate-400 mt-0.5">High-definition images ready for Etsy & catalog upload.</p>
                        </div>
                        
                        <!-- Batch Action Buttons -->
                        <div class="flex flex-wrap items-center gap-2">
                            <button onclick="clearBatch()" class="px-3 py-2 text-xs text-rose-400 hover:bg-rose-500/10 rounded-lg border border-rose-500/20 transition flex items-center gap-1">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Clear
                            </button>
                            <button onclick="reprocessCurrentBatch()" class="px-3 py-2 text-xs text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 rounded-lg border border-slate-700 transition flex items-center gap-1" title="Re-apply new settings to current images">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Re-Apply
                            </button>
                            <button onclick="downloadAllIndividualImages()" id="btnDownloadAllDirect" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-lg border border-slate-700 transition flex items-center gap-1.5">
                                <i data-lucide="download" class="w-3.5 h-3.5 text-amber-400"></i> Download All
                            </button>
                            <a id="btnDownloadZip" href="#" class="px-5 py-2 bg-gradient-to-r from-amber-500 to-yellow-400 hover:from-amber-600 hover:to-yellow-500 text-slate-950 text-xs font-bold rounded-lg shadow-lg shadow-amber-500/20 transition flex items-center gap-1.5">
                                <i data-lucide="archive" class="w-4 h-4"></i> Download ZIP
                            </a>
                        </div>
                    </div>

                    <!-- Thumbnails Grid -->
                    <div id="batchGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        <!-- Injected via JavaScript -->
                    </div>
                </div>

            </div>

            <!-- Right: Studio Controls Panel (4 cols) -->
            <div class="lg:col-span-4 flex flex-col gap-5">
                
                <!-- 1. Brand Selector -->
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 shadow-xl space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-400 border border-amber-500/20 flex items-center justify-center">
                                <i data-lucide="stamp" class="w-4 h-4"></i>
                            </div>
                            <h2 class="text-sm font-bold text-white">1. Select Brand</h2>
                        </div>
                        <span class="text-[11px] text-amber-400 font-bold" id="brandActiveIndicator">Shreeja Gems Active</span>
                    </div>

                    <!-- 2 Brand Selection Cards (Default: Shreeja Gems) -->
                    <div class="grid grid-cols-2 gap-3">
                        
                        <!-- Shreeja Gems Card (Default) -->
                        <button type="button" onclick="selectBrand('shreeja')" id="brandCardShreeja" class="brand-card-active-shreeja p-3 rounded-xl border border-amber-500 bg-slate-950/60 hover:border-amber-400 transition text-left flex flex-col gap-2 group">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-white group-hover:text-amber-400 flex items-center gap-1">
                                    💎 Shreeja
                                </span>
                                <span id="checkShreeja" class="w-4 h-4 rounded-full bg-amber-500 text-slate-950 flex items-center justify-center text-[10px] font-bold">✓</span>
                            </div>
                            <div class="w-full h-11 bg-slate-900 rounded-lg p-1 flex items-center justify-center border border-slate-800 overflow-hidden">
                                <img src="assets/logos/shreeja_gems.png" class="max-h-full max-w-full object-contain" alt="Shreeja Gems">
                            </div>
                            <span class="text-[10px] text-amber-300 font-medium">Luxury Moissanite</span>
                        </button>

                        <!-- Velmora Gems Card -->
                        <button type="button" onclick="selectBrand('velmora')" id="brandCardVelmora" class="p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-emerald-500/60 transition text-left flex flex-col gap-2 group">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-white group-hover:text-emerald-400 flex items-center gap-1">
                                    🌸 Velmora
                                </span>
                                <span id="checkVelmora" class="w-4 h-4 rounded-full bg-slate-700 text-slate-400 flex items-center justify-center text-[10px] font-bold hidden">✓</span>
                            </div>
                            <div class="w-full h-11 bg-slate-900 rounded-lg p-1 flex items-center justify-center border border-slate-800 overflow-hidden">
                                <img src="assets/logos/velmora_gems.png" class="max-h-full max-w-full object-contain" alt="Velmora Gems">
                            </div>
                            <span class="text-[10px] text-slate-400">Lab-Grown Jewelry</span>
                        </button>

                    </div>

                    <!-- Visibility / Color Mode -->
                    <div class="space-y-3 pt-2 border-t border-slate-800 text-xs">
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-slate-300 font-medium">Visibility / Color Contrast</span>
                                <span class="text-[10px] text-amber-400 font-semibold">Adaptive</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" onclick="setColorMode('auto')" id="btnColorAuto" class="p-2 rounded-lg bg-amber-500 text-slate-950 font-bold text-center text-[11px] shadow flex items-center justify-center gap-1">
                                    <span>⚡ Auto-Contrast</span>
                                </button>
                                <button type="button" onclick="setColorMode('white')" id="btnColorWhite" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-center text-[11px] border border-slate-700 flex items-center justify-center gap-1">
                                    <span>⚪ Crisp White</span>
                                </button>
                                <button type="button" onclick="setColorMode('original')" id="btnColorOriginal" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-center text-[11px] border border-slate-700 flex items-center justify-center gap-1">
                                    <span>💎 Brand Gold</span>
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
                                
                                <button type="button" onclick="setLogoPos('center_left')" data-pos="center_left" class="pos-btn p-2 rounded-lg bg-amber-500 text-slate-950 font-bold text-center font-mono text-[10px]">Left</button>
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
                                <span id="valOpacity" class="text-amber-400 font-mono font-bold">90%</span>
                            </div>
                            <input type="range" id="rngOpacity" min="0.20" max="1.0" step="0.05" value="0.90" class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer" oninput="document.getElementById('valOpacity').textContent = Math.round(this.value*100) + '%'; saveSettings();">
                        </div>

                        <!-- Scale Slider -->
                        <div>
                            <div class="flex justify-between text-slate-400 mb-1">
                                <span class="font-medium text-slate-300">Logo Size (Width %)</span>
                                <span id="valScale" class="text-amber-400 font-mono font-bold">32%</span>
                            </div>
                            <input type="range" id="rngScale" min="0.10" max="0.65" step="0.01" value="0.32" class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer" oninput="document.getElementById('valScale').textContent = Math.round(this.value*100) + '%'; saveSettings();">
                        </div>

                        <!-- Drop Shadow Toggle -->
                        <div class="pt-2 border-t border-slate-800 flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer text-slate-300">
                                <input type="checkbox" id="chkShadow" checked class="rounded bg-slate-800 border-slate-700 text-amber-500 focus:ring-0" onchange="saveSettings()">
                                <span>High-Contrast Drop Shadow</span>
                            </label>
                        </div>

                    </div>
                </div>

                <!-- 2. Gemini Sparkle Watermark Cleaner -->
                <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-5 shadow-xl space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center">
                                <i data-lucide="eraser" class="w-4 h-4"></i>
                            </div>
                            <h2 class="text-sm font-bold text-white">2. Gemini Sparkle Cleaner</h2>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="chkRemoveGemini" class="sr-only peer" onchange="saveSettings()">
                            <div class="w-9 h-5 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-amber-500"></div>
                        </label>
                    </div>

                    <div class="text-xs text-slate-400 space-y-2.5">
                        <p class="text-[11px] text-slate-300">
                            Smooth feather inpaint blend removes AI watermark without dark boxes or distortion.
                        </p>
                        <div>
                            <label class="text-slate-300 font-medium block mb-1">Corner Location</label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="flex items-center gap-2 p-2 bg-slate-800/80 hover:bg-slate-800 rounded-lg border border-slate-700/80 cursor-pointer">
                                    <input type="radio" name="corner" value="bottom_right" checked class="text-amber-500 focus:ring-0" onchange="saveSettings()">
                                    <span class="text-slate-200">Bottom-Right</span>
                                </label>
                                <label class="flex items-center gap-2 p-2 bg-slate-800/80 hover:bg-slate-800 rounded-lg border border-slate-700/80 cursor-pointer">
                                    <input type="radio" name="corner" value="bottom_left" class="text-amber-500 focus:ring-0" onchange="saveSettings()">
                                    <span class="text-slate-200">Bottom-Left</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <!-- Full Image Preview Lightbox Modal -->
    <div id="previewModal" class="fixed inset-0 z-[990] bg-slate-950/90 backdrop-blur-md hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-[90vh] bg-slate-900 border border-slate-800 rounded-3xl p-4 flex flex-col items-center gap-3 shadow-2xl overflow-hidden">
            <div class="w-full flex items-center justify-between pb-2 border-b border-slate-800">
                <span id="previewModalTitle" class="text-xs font-semibold text-slate-200 truncate">Image Preview</span>
                <div class="flex items-center gap-2">
                    <a id="previewModalDownload" href="#" download class="px-3 py-1 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-lg flex items-center gap-1">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i> Download
                    </a>
                    <button onclick="closePreviewModal()" class="p-1 text-slate-400 hover:text-white rounded-lg hover:bg-slate-800">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
            <div class="flex-1 overflow-auto flex items-center justify-center max-h-[75vh]">
                <img id="previewModalImg" src="" class="max-h-[75vh] w-auto object-contain rounded-xl shadow-lg" alt="Full Preview">
                <video id="previewModalVid" src="" class="hidden max-h-[75vh] w-auto object-contain rounded-xl shadow-lg" controls autoplay loop></video>
            </div>
        </div>
    </div>

    <!-- Global Toast Notification -->
    <div id="toast" class="fixed bottom-5 right-5 bg-slate-900 border border-slate-700 text-slate-100 px-4 py-3 rounded-xl shadow-2xl z-50 flex items-center gap-2 transform translate-y-20 opacity-0 transition duration-300 pointer-events-none text-xs">
        <i data-lucide="check-circle" class="w-4 h-4 text-amber-400" id="toastIcon"></i>
        <span id="toastMsg">Notification</span>
    </div>

    <!-- Frontend Script -->
    <script>
        // ==================== CONFIGURATION & DEFAULTS ====================
        const MASTER_PIN = "1243";
        let currentBrand = 'shreeja'; // Default to Shreeja Gems
        let currentColorMode = 'auto'; // 'auto', 'white', 'original', 'gold'
        let selectedLogoPos = 'center_left';
        let currentBatchFiles = [];
        let currentBatchResults = [];
        const logoImgCache = {};

        document.addEventListener('DOMContentLoaded', () => {
            checkPinAuthOnLoad();
            lucide.createIcons();
            setupBatchEvents();
            loadSavedSettings();
            updateBrandUI();
            updateColorModeUI();
        });

        // ==================== PIN AUTHENTICATION ====================
        function checkPinAuthOnLoad() {
            const isAuth = sessionStorage.getItem('velmora_wm_auth_pin');
            const modal = document.getElementById('pinAuthModal');
            if (isAuth === MASTER_PIN) {
                modal.classList.add('hidden');
            } else {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    const inp = document.getElementById('authPinInput');
                    if (inp) inp.focus();
                }, 100);
            }
        }

        function handlePinSubmit(e) {
            if (e) e.preventDefault();
            const pinInput = document.getElementById('authPinInput');
            const errorMsg = document.getElementById('pinErrorMsg');
            const errorText = document.getElementById('pinErrorText');
            const val = pinInput.value.trim();

            if (val === MASTER_PIN) {
                sessionStorage.setItem('velmora_wm_auth_pin', MASTER_PIN);
                document.getElementById('pinAuthModal').classList.add('hidden');
                errorMsg.classList.add('hidden');
                pinInput.value = '';
                showToast('PIN Verified. Welcome to Studio!');
            } else {
                errorMsg.classList.remove('hidden');
                errorText.textContent = 'Incorrect PIN! Please enter 1243 to unlock.';
                pinInput.value = '';
                pinInput.focus();
            }
        }

        function togglePinVisibility() {
            const pinInput = document.getElementById('authPinInput');
            if (pinInput.type === 'password') {
                pinInput.type = 'text';
            } else {
                pinInput.type = 'password';
            }
        }

        function lockStudio() {
            sessionStorage.removeItem('velmora_wm_auth_pin');
            const modal = document.getElementById('pinAuthModal');
            modal.classList.remove('hidden');
            const pinInput = document.getElementById('authPinInput');
            if (pinInput) {
                pinInput.value = '';
                pinInput.focus();
            }
            showToast('Studio Locked.');
        }

        // ==================== TOAST & UI ====================
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

        function selectBrand(brand) {
            currentBrand = brand;
            updateBrandUI();
            saveSettings();
            showToast(`Selected: ${brand === 'shreeja' ? 'Shreeja Gems' : 'Velmora Gems'}`);
            if (currentBatchFiles.length > 0) {
                processBatch(currentBatchFiles);
            }
        }

        function setColorMode(mode) {
            currentColorMode = mode;
            updateColorModeUI();
            saveSettings();
            if (currentBatchFiles.length > 0) {
                processBatch(currentBatchFiles);
            }
        }

        function updateColorModeUI() {
            const modes = ['auto', 'white', 'original', 'gold'];
            modes.forEach(m => {
                const btn = document.getElementById('btnColor' + m.charAt(0).toUpperCase() + m.slice(1));
                if (btn) {
                    if (m === currentColorMode) {
                        btn.className = 'p-2 rounded-lg bg-amber-500 text-slate-950 font-bold text-center text-[11px] shadow flex items-center justify-center gap-1';
                    } else {
                        btn.className = 'p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 text-center text-[11px] border border-slate-700 flex items-center justify-center gap-1';
                    }
                }
            });
        }

        function updateBrandUI() {
            const cardVelmora = document.getElementById('brandCardVelmora');
            const cardShreeja = document.getElementById('brandCardShreeja');
            const checkVelmora = document.getElementById('checkVelmora');
            const checkShreeja = document.getElementById('checkShreeja');
            const brandActiveInd = document.getElementById('brandActiveIndicator');
            const batchSelectedBrandName = document.getElementById('batchSelectedBrandName');
            const headerBrandBadge = document.getElementById('headerBrandBadge');

            if (currentBrand === 'shreeja') {
                if (cardShreeja) cardShreeja.className = 'brand-card-active-shreeja p-3 rounded-xl border border-amber-500 bg-slate-950/60 hover:border-amber-400 transition text-left flex flex-col gap-2 group';
                if (cardVelmora) cardVelmora.className = 'p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-emerald-500/60 transition text-left flex flex-col gap-2 group';
                if (checkShreeja) checkShreeja.classList.remove('hidden');
                if (checkVelmora) checkVelmora.classList.add('hidden');
                if (brandActiveInd) brandActiveInd.textContent = 'Shreeja Gems Active';
                if (batchSelectedBrandName) batchSelectedBrandName.textContent = 'Shreeja Gems';
                if (headerBrandBadge) headerBrandBadge.textContent = 'Shreeja Gems';
            } else {
                if (cardVelmora) cardVelmora.className = 'brand-card-active-velmora p-3 rounded-xl border border-emerald-500 bg-slate-950/60 hover:border-emerald-400 transition text-left flex flex-col gap-2 group';
                if (cardShreeja) cardShreeja.className = 'p-3 rounded-xl border border-slate-700 bg-slate-950/60 hover:border-amber-500/60 transition text-left flex flex-col gap-2 group';
                if (checkVelmora) checkVelmora.classList.remove('hidden');
                if (checkShreeja) checkShreeja.classList.add('hidden');
                if (brandActiveInd) brandActiveInd.textContent = 'Velmora Gems Active';
                if (batchSelectedBrandName) batchSelectedBrandName.textContent = 'Velmora Gems';
                if (headerBrandBadge) headerBrandBadge.textContent = 'Velmora Gems';
            }
        }

        function setLogoPos(pos) {
            selectedLogoPos = pos;
            document.querySelectorAll('.pos-btn').forEach(btn => {
                if (btn.getAttribute('data-pos') === pos) {
                    btn.className = 'pos-btn p-2 rounded-lg bg-amber-500 text-slate-950 font-bold text-center font-mono text-[10px] shadow';
                } else {
                    btn.className = 'pos-btn p-2 rounded-lg bg-slate-800/80 hover:bg-slate-700 text-slate-300 text-center font-mono text-[10px]';
                }
            });
            saveSettings();
            if (currentBatchFiles.length > 0) {
                processBatch(currentBatchFiles);
            }
        }

        // ==================== BATCH DRAG & DROP ====================
        function setupBatchEvents() {
            const dropzone = document.getElementById('batchDropzone');
            const fileInput = document.getElementById('batchFileInput');

            dropzone.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', (e) => {
                if (e.target.files && e.target.files.length > 0) {
                    currentBatchFiles = Array.from(e.target.files);
                    processBatch(currentBatchFiles);
                }
            });

            ['dragenter', 'dragover'].forEach(name => {
                dropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    dropzone.classList.add('border-amber-500', 'bg-amber-500/5');
                });
            });

            ['dragleave', 'drop'].forEach(name => {
                dropzone.addEventListener(name, (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('border-amber-500', 'bg-amber-500/5');
                });
            });

            dropzone.addEventListener('drop', (e) => {
                if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                    currentBatchFiles = Array.from(e.dataTransfer.files);
                    processBatch(currentBatchFiles);
                }
            });

            window.addEventListener('paste', (e) => {
                const items = e.clipboardData ? e.clipboardData.items : [];
                const pastedFiles = [];
                for (let i = 0; i < items.length; i++) {
                    if (items[i].type && items[i].type.indexOf('image') !== -1) {
                        pastedFiles.push(items[i].getAsFile());
                    }
                }
                if (pastedFiles.length > 0) {
                    currentBatchFiles = pastedFiles;
                    processBatch(currentBatchFiles);
                    showToast(`${pastedFiles.length} photo(s) pasted from clipboard!`);
                }
            });
        }

        // ==================== IN-BROWSER HTML5 CANVAS ENGINE ====================
        function getPreloadedLogo(logoPath) {
            return new Promise((resolve) => {
                if (logoImgCache[logoPath]) {
                    resolve(logoImgCache[logoPath]);
                    return;
                }
                const img = new Image();
                img.crossOrigin = "anonymous";
                img.onload = () => {
                    logoImgCache[logoPath] = img;
                    resolve(img);
                };
                img.onerror = () => {
                    resolve(null);
                };
                img.src = logoPath;
            });
        }

        // Safe inpaint: samples adjacent natural texture with feathered circular mask (NO dark/black box!)
        function removeGeminiWatermarkCanvas(ctx, width, height, corner) {
            const boxSize = Math.max(24, Math.round(Math.min(width, height) * 0.08));
            const margin = Math.max(6, Math.round(Math.min(width, height) * 0.025));

            let targetX = 0, targetY = 0;
            let srcX = 0, srcY = 0;

            if (corner === 'bottom_right') {
                targetX = width - boxSize - margin;
                targetY = height - boxSize - margin;
                srcX = Math.max(0, targetX - Math.round(boxSize * 0.4));
                srcY = Math.max(0, targetY - Math.round(boxSize * 1.1));
            } else if (corner === 'bottom_left') {
                targetX = margin;
                targetY = height - boxSize - margin;
                srcX = Math.min(width - boxSize, targetX + Math.round(boxSize * 0.4));
                srcY = Math.max(0, targetY - Math.round(boxSize * 1.1));
            }

            targetX = Math.max(0, Math.min(targetX, width - boxSize));
            targetY = Math.max(0, Math.min(targetY, height - boxSize));

            try {
                const offCanvas = document.createElement('canvas');
                offCanvas.width = boxSize;
                offCanvas.height = boxSize;
                const offCtx = offCanvas.getContext('2d');

                // Draw source patch
                offCtx.drawImage(ctx.canvas, srcX, srcY, boxSize, boxSize, 0, 0, boxSize, boxSize);

                // Create soft radial alpha gradient
                offCtx.globalCompositeOperation = 'destination-in';
                const maskGrad = offCtx.createRadialGradient(
                    boxSize / 2, boxSize / 2, boxSize * 0.1,
                    boxSize / 2, boxSize / 2, boxSize * 0.48
                );
                maskGrad.addColorStop(0, 'rgba(0, 0, 0, 1.0)');
                maskGrad.addColorStop(0.65, 'rgba(0, 0, 0, 0.85)');
                maskGrad.addColorStop(1, 'rgba(0, 0, 0, 0.0)');

                offCtx.fillStyle = maskGrad;
                offCtx.fillRect(0, 0, boxSize, boxSize);

                // Blend softly over watermark location
                ctx.save();
                ctx.globalAlpha = 0.95;
                ctx.drawImage(offCanvas, targetX, targetY);
                ctx.restore();
            } catch (e) {
                // If anything is unsupported, bypass cleanly without drawing any black box!
            }
        }

        // Draw brand logo on canvas with Smart Auto-Contrast luminance & skin-tone detection
        async function drawBrandLogoCanvas(ctx, width, height, brand, colorMode, pos, scalePct, opacityPct, addShadow) {
            const minDim = Math.min(width, height);
            const targetW = Math.max(60, minDim * scalePct);
            const margin = Math.max(12, minDim * 0.04);

            let sampleX = margin;
            let sampleY = (height - (targetW * 0.35)) / 2;
            let sampleW = targetW;
            let sampleH = targetW * 0.35;

            if (pos === 'center') {
                sampleX = (width - targetW) / 2;
                sampleY = (height - sampleH) / 2;
            } else if (pos === 'center_left') {
                sampleX = margin;
                sampleY = (height - sampleH) / 2;
            } else if (pos === 'center_right') {
                sampleX = width - targetW - margin;
                sampleY = (height - sampleH) / 2;
            } else if (pos === 'bottom_center') {
                sampleX = (width - targetW) / 2;
                sampleY = height - sampleH - margin;
            } else if (pos === 'bottom_left') {
                sampleX = margin;
                sampleY = height - sampleH - margin;
            } else if (pos === 'bottom_right') {
                sampleX = width - targetW - margin;
                sampleY = height - sampleH - margin;
            } else if (pos === 'top_left') {
                sampleX = margin;
                sampleY = margin;
            } else if (pos === 'top_right') {
                sampleX = width - targetW - margin;
                sampleY = margin;
            } else if (pos === 'top_center') {
                sampleX = (width - targetW) / 2;
                sampleY = margin;
            }

            // Advanced Luminance & Skin Tone Detection
            let isDarkOrSkin = false;
            try {
                const safeSx = Math.max(0, Math.min(Math.round(sampleX), width - 1));
                const safeSy = Math.max(0, Math.min(Math.round(sampleY), height - 1));
                const safeSw = Math.min(Math.round(sampleW), width - safeSx);
                const safeSh = Math.min(Math.round(sampleH), height - safeSy);

                if (safeSw > 0 && safeSh > 0) {
                    const imgData = ctx.getImageData(safeSx, safeSy, safeSw, safeSh);
                    const data = imgData.data;
                    let sumR = 0, sumG = 0, sumB = 0, samples = 0;
                    for (let i = 0; i < data.length; i += 16) {
                        sumR += data[i];
                        sumG += data[i+1];
                        sumB += data[i+2];
                        samples++;
                    }
                    const meanR = samples > 0 ? sumR / samples : 128;
                    const meanG = samples > 0 ? sumG / samples : 128;
                    const meanB = samples > 0 ? sumB / samples : 128;
                    const avgLum = 0.2126 * meanR + 0.7152 * meanG + 0.0722 * meanB;
                    const isSkinTone = (meanR > 115 && meanG > 75 && meanR > meanB + 10 && avgLum < 195);

                    // On dark backgrounds OR human skin tones -> Crisp White logo provides 100% crystal clear legibility
                    // On pure white/light studio lightbox -> Brand Gold/Color logo provides maximum luxury contrast
                    isDarkOrSkin = (avgLum < 170 || isSkinTone);
                } else {
                    isDarkOrSkin = true;
                }
            } catch(e) {
                isDarkOrSkin = true;
            }

            let logoPath = '';
            if (brand === 'shreeja') {
                if (colorMode === 'white' || (colorMode === 'auto' && isDarkOrSkin)) {
                    logoPath = 'assets/logos/shreeja_gems_white.png';
                } else {
                    logoPath = 'assets/logos/shreeja_gems.png';
                }
            } else {
                if (colorMode === 'white' || (colorMode === 'auto' && isDarkOrSkin)) {
                    logoPath = 'assets/logos/velmora_gems_white.png';
                } else {
                    logoPath = 'assets/logos/velmora_gems.png';
                }
            }

            const logoImg = await getPreloadedLogo(logoPath);
            if (!logoImg || !logoImg.width) return;

            const aspect = logoImg.height / logoImg.width;
            const targetH = Math.round(targetW * aspect);
            let posX = 0, posY = 0;

            if (pos === 'center') {
                posX = (width - targetW) / 2;
                posY = (height - targetH) / 2;
            } else if (pos === 'center_left') {
                posX = margin;
                posY = (height - targetH) / 2;
            } else if (pos === 'center_right') {
                posX = width - targetW - margin;
                posY = (height - targetH) / 2;
            } else if (pos === 'bottom_center') {
                posX = (width - targetW) / 2;
                posY = height - targetH - margin;
            } else if (pos === 'bottom_left') {
                posX = margin;
                posY = height - targetH - margin;
            } else if (pos === 'bottom_right') {
                posX = width - targetW - margin;
                posY = height - targetH - margin;
            } else if (pos === 'top_left') {
                posX = margin;
                posY = margin;
            } else if (pos === 'top_right') {
                posX = width - targetW - margin;
                posY = margin;
            } else if (pos === 'top_center') {
                posX = (width - targetW) / 2;
                posY = margin;
            }

            posX = Math.round(posX);
            posY = Math.round(posY);

            // Multi-pass high-contrast shadow rendering for 100% clarity
            ctx.save();
            ctx.globalAlpha = opacityPct;
            if (addShadow) {
                // Pass 1: Ambient soft shadow
                ctx.shadowColor = 'rgba(0, 0, 0, 0.85)';
                ctx.shadowBlur = 10;
                ctx.shadowOffsetX = 1.5;
                ctx.shadowOffsetY = 1.5;
            }
            ctx.drawImage(logoImg, posX, posY, targetW, targetH);
            ctx.restore();
        }

        // Process a single image file on client canvas
        function processImageOnClient(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = new Image();
                    img.onload = async () => {
                        try {
                            const canvas = document.createElement('canvas');
                            canvas.width = img.naturalWidth || img.width;
                            canvas.height = img.naturalHeight || img.height;
                            const ctx = canvas.getContext('2d', { willReadFrequently: true });

                            // Draw original photo
                            ctx.drawImage(img, 0, 0);

                            // Optional Gemini clean (Safe soft feather inpaint)
                            const removeGemini = document.getElementById('chkRemoveGemini').checked;
                            const corner = document.querySelector('input[name="corner"]:checked') ? document.querySelector('input[name="corner"]:checked').value : 'bottom_right';

                            if (removeGemini) {
                                removeGeminiWatermarkCanvas(ctx, canvas.width, canvas.height, corner);
                            }

                            // Brand logo overlay
                            const scalePct = parseFloat(document.getElementById('rngScale').value) || 0.28;
                            const opacityPct = parseFloat(document.getElementById('rngOpacity').value) || 0.85;
                            const shadow = document.getElementById('chkShadow').checked;

                            await drawBrandLogoCanvas(ctx, canvas.width, canvas.height, currentBrand, currentColorMode, selectedLogoPos, scalePct, opacityPct, shadow);

                            canvas.toBlob((blob) => {
                                if (blob) {
                                    const blobUrl = URL.createObjectURL(blob);
                                    resolve({ blob, blobUrl, dataUrl: canvas.toDataURL('image/jpeg', 0.95) });
                                } else {
                                    reject(new Error('Canvas export failed'));
                                }
                            }, 'image/jpeg', 0.95);
                        } catch (err) {
                            reject(err);
                        }
                    };
                    img.onerror = reject;
                    img.src = e.target.result;
                };
                reader.onerror = reject;
                reader.readAsDataURL(file);
            });
        }

        // ==================== BATCH PROCESSOR ====================
        async function processBatch(files) {
            if (!files || files.length === 0) return;

            const progressBox = document.getElementById('batchProgressBox');
            const progressBar = document.getElementById('batchProgressBar');
            const progressPercent = document.getElementById('batchProgressPercent');
            const progressLabel = document.getElementById('batchProgressLabel');
            const resultsContainer = document.getElementById('batchResultsContainer');
            const btnZip = document.getElementById('btnDownloadZip');

            progressBox.classList.remove('hidden');
            progressBar.style.width = '5%';
            progressPercent.textContent = '5%';

            let handledByServer = false;
            const logoName = currentBrand === 'shreeja' ? 'shreeja_gems.png' : 'velmora_gems.png';

            // Try server backend if available (local XAMPP with FFmpeg/Python)
            try {
                const formData = new FormData();
                formData.append('action', 'process_batch');
                for (let i = 0; i < files.length; i++) {
                    formData.append('images[]', files[i]);
                }
                formData.append('remove_gemini', document.getElementById('chkRemoveGemini').checked);
                const corner = document.querySelector('input[name="corner"]:checked') ? document.querySelector('input[name="corner"]:checked').value : 'bottom_right';
                formData.append('corner', corner);
                formData.append('box_size', '0.08');
                formData.append('margin', '0.025');
                formData.append('method', 'telea');
                formData.append('logo_name', logoName);
                formData.append('logo_pos', selectedLogoPos);
                formData.append('logo_scale', document.getElementById('rngScale').value);
                formData.append('logo_opacity', document.getElementById('rngOpacity').value);
                formData.append('logo_color', currentColorMode);
                formData.append('add_shadow', document.getElementById('chkShadow').checked);

                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 12000);

                const res = await fetch('process.php', { method: 'POST', body: formData, signal: controller.signal });
                clearTimeout(timeoutId);

                if (res.ok) {
                    const data = await res.json();
                    if (data.success && data.results) {
                        handledByServer = true;
                        currentBatchResults = data.results;
                        renderBatchGrid(data.results, data.count, data.zip_url);
                        showToast(`Batch completed: ${data.count} images processed!`);
                    }
                }
            } catch (e) {
                // Fall back to in-browser canvas
            }

            // Client-side Batch Fallback (GitHub Pages & in-browser)
            if (!handledByServer) {
                currentBatchResults = [];
                const total = files.length;

                for (let i = 0; i < total; i++) {
                    const file = files[i];
                    progressLabel.innerHTML = `<i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin text-amber-400"></i> Processing photo ${i+1} of ${total}...`;
                    lucide.createIcons();

                    try {
                        const res = await processImageOnClient(file);
                        const cleanName = `${currentBrand}_${file.name || `photo_${i+1}.jpg`}`;
                        currentBatchResults.push({
                            filename: cleanName,
                            url: res.blobUrl,
                            blob: res.blob
                        });
                    } catch (err) {
                        console.error('Batch item error:', err);
                    }
                    const pct = Math.round(((i + 1) / total) * 100);
                    progressBar.style.width = pct + '%';
                    progressPercent.textContent = pct + '%';
                }

                renderBatchGrid(currentBatchResults, currentBatchResults.length, '#');
                btnZip.onclick = (e) => {
                    e.preventDefault();
                    downloadBatchZipClient();
                };
                showToast(`Batch completed: ${currentBatchResults.length} photos ready!`);
            }

            setTimeout(() => progressBox.classList.add('hidden'), 800);
        }

        function renderBatchGrid(results, count, zipUrl) {
            const resultsContainer = document.getElementById('batchResultsContainer');
            const grid = document.getElementById('batchGrid');
            const btnZip = document.getElementById('btnDownloadZip');

            grid.innerHTML = '';
            results.forEach((item, index) => {
                const isVid = (item.is_video) || /\.(mp4|mov|webm|avi|m4v)$/i.test(item.filename || '');
                const mediaTag = isVid 
                    ? `<video src="${item.url}" class="w-full h-full object-cover" muted loop onmouseover="this.play()" onmouseout="this.pause()"></video><div class="absolute bottom-1.5 left-1.5 bg-slate-950/80 border border-slate-700/60 text-amber-400 text-[9px] px-1.5 py-0.5 rounded font-bold flex items-center gap-1"><i data-lucide="film" class="w-2.5 h-2.5"></i> MP4</div>`
                    : `<img src="${item.url}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy">`;

                const card = document.createElement('div');
                card.className = 'bg-slate-950/90 border border-slate-800 rounded-xl p-2.5 flex flex-col gap-2 group hover:border-amber-500/60 transition shadow-lg';
                card.innerHTML = `
                    <div onclick="openPreviewModal(${index})" class="relative overflow-hidden rounded-lg aspect-square bg-slate-900 flex items-center justify-center cursor-pointer">
                        ${mediaTag}
                        <div class="absolute inset-0 bg-slate-950/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center pointer-events-none">
                            <span class="px-2.5 py-1 rounded-lg bg-slate-900/90 text-white text-[10px] font-semibold border border-slate-700 flex items-center gap-1">
                                <i data-lucide="maximize-2" class="w-3 h-3"></i> View
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-[11px] px-1">
                        <span class="truncate text-slate-300 text-[10px] font-medium" title="${item.filename}">${item.filename}</span>
                        <a href="${item.url}" download="${item.filename}" class="text-amber-400 hover:text-amber-300 p-1 hover:bg-slate-800 rounded transition" title="Download">
                            <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                `;
                grid.appendChild(card);
            });

            document.getElementById('batchCountText').textContent = `${count}`;
            if (zipUrl && zipUrl !== '#') {
                btnZip.href = zipUrl;
                btnZip.onclick = null;
            }
            resultsContainer.classList.remove('hidden');
            lucide.createIcons();
        }

        function reprocessCurrentBatch() {
            if (currentBatchFiles.length === 0) {
                showToast('Please select images first', true);
                return;
            }
            processBatch(currentBatchFiles);
        }

        async function downloadBatchZipClient() {
            if (!currentBatchResults || currentBatchResults.length === 0) {
                showToast('No processed photos available to zip', true);
                return;
            }
            if (typeof JSZip === 'undefined') {
                downloadAllIndividualImages();
                return;
            }

            showToast('Generating in-browser ZIP file...');
            const zip = new JSZip();
            const folder = zip.folder(`${currentBrand}_processed_photos`);

            for (let item of currentBatchResults) {
                if (item.blob) {
                    folder.file(item.filename, item.blob);
                } else if (item.url) {
                    try {
                        const resp = await fetch(item.url);
                        const b = await resp.blob();
                        folder.file(item.filename, b);
                    } catch (e) {}
                }
            }

            zip.generateAsync({ type: 'blob' }).then((content) => {
                if (typeof saveAs !== 'undefined') {
                    saveAs(content, `${currentBrand}_batch_cleaned.zip`);
                } else {
                    const url = URL.createObjectURL(content);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `${currentBrand}_batch_cleaned.zip`;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }
                showToast('ZIP downloaded successfully!');
            });
        }

        function downloadAllIndividualImages() {
            if (!currentBatchResults || currentBatchResults.length === 0) {
                showToast('No photos to download', true);
                return;
            }

            showToast(`Downloading ${currentBatchResults.length} photos directly...`);
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
            currentBatchFiles = [];
            currentBatchResults = [];
            document.getElementById('batchFileInput').value = '';
            document.getElementById('batchResultsContainer').classList.add('hidden');
            document.getElementById('batchGrid').innerHTML = '';
            showToast('Batch cleared');
        }

        // ==================== LIGHTBOX MODAL ====================
        function openPreviewModal(index) {
            const item = currentBatchResults[index];
            if (!item) return;

            const modal = document.getElementById('previewModal');
            const img = document.getElementById('previewModalImg');
            const vid = document.getElementById('previewModalVid');
            const title = document.getElementById('previewModalTitle');
            const dl = document.getElementById('previewModalDownload');

            title.textContent = item.filename;
            dl.href = item.url;
            dl.download = item.filename;

            const isVid = (item.is_video) || /\.(mp4|mov|webm|avi|m4v)$/i.test(item.filename || '');
            if (isVid) {
                img.classList.add('hidden');
                vid.classList.remove('hidden');
                vid.src = item.url;
            } else {
                vid.classList.add('hidden');
                img.classList.remove('hidden');
                img.src = item.url;
            }

            modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function closePreviewModal() {
            const modal = document.getElementById('previewModal');
            const vid = document.getElementById('previewModalVid');
            vid.pause();
            modal.classList.add('hidden');
        }

        // ==================== SETTINGS STORAGE ====================
        function saveSettings() {
            const settings = {
                brand: currentBrand,
                colorMode: currentColorMode,
                logoPos: selectedLogoPos,
                opacity: document.getElementById('rngOpacity').value,
                scale: document.getElementById('rngScale').value,
                shadow: document.getElementById('chkShadow').checked,
                removeGemini: document.getElementById('chkRemoveGemini').checked
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
                    if (s.removeGemini !== undefined) {
                        document.getElementById('chkRemoveGemini').checked = s.removeGemini;
                    }
                }
            } catch (e) {}
        }
    </script>
</body>
</html>
