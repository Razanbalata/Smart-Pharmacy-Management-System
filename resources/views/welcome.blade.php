<!DOCTYPE html>
<html lang="en" dir="ltr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaSmart - Next-Gen AI Pharmacy Management</title>
    
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f7ff',
                            100: '#e0e7ff',
                            500: '#6366f1', // Indigo primary
                            600: '#4f46e5',
                            700: '#4338ca',
                        },
                        accent: {
                            500: '#3b82f6', // Royal Blue
                            600: '#2563eb',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-slate-50/50 text-slate-800 font-sans antialiased overflow-x-hidden">

    <!-- Ambient Glow Backgrounds -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-brand-100/50 rounded-full filter blur-3xl -z-10"></div>
    <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-100/40 rounded-full filter blur-3xl -z-10"></div>

    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 h-20 flex justify-between items-center">
            
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="bg-gradient-to-tr from-brand-600 to-accent-600 text-white p-2.5 rounded-2xl shadow-md shadow-brand-500/20 transform group-hover:scale-105 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z"/><path d="m8.5 8.5 7 7"/></svg>
                </div>
                <span class="text-2xl font-extrabold tracking-tight text-slate-900">
                    Pharma<span class="text-brand-600">Smart</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 font-semibold text-slate-600">
                <a href="#features" class="hover:text-brand-600 transition-colors">Features</a>
                <a href="#transformation" class="hover:text-brand-600 transition-colors">Why Us</a>
                <a href="#ai" class="hover:text-brand-600 transition-colors">AI Assistant</a>
                <a href="#workflow" class="hover:text-brand-600 transition-colors">How It Works</a>
            </nav>

            <!-- CTA Actions -->
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-900 font-semibold transition-colors px-4 py-2">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all duration-200 hover:-translate-y-0.5">
                    Get Started
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 lg:px-8 pt-16 pb-24 grid lg:grid-cols-12 gap-12 items-center">
        
        <!-- Hero Content -->
        <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 bg-brand-50 text-brand-700 px-4 py-1.5 rounded-full text-sm font-semibold border border-brand-100/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                <span>Automated Pharmacy Intelligence Ecosystem</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-slate-950 leading-[1.15] tracking-tight">
                Manage your pharmacy 
                <span class="bg-gradient-to-r from-brand-600 to-accent-500 bg-clip-text text-transparent block mt-2">
                    smarter with AI
                </span>
            </h1>
            
            <p class="text-lg text-slate-500 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                PharmaSmart unifies high-frequency point of sale, dynamic multi-batch inventory syncing, and real-time LLM cognitive predictions into one seamless cloud dashboard.
            </p>

            <div class="pt-4 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg shadow-brand-500/20 transition-all hover:-translate-y-0.5 text-center">
                    Start Managing Free
                </a>
                <a href="#features" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-8 py-4 rounded-xl font-bold text-lg transition-all text-center">
                    Explore Features
                </a>
            </div>
        </div>

        <!-- Dashboard Mockup -->
        <div id="dashboard" class="lg:col-span-6 relative">
            <div class="absolute inset-0 bg-gradient-to-tr from-brand-500 to-accent-500 opacity-10 rounded-3xl blur-2xl"></div>
            
            <div class="relative bg-slate-900 rounded-3xl p-4 shadow-2xl border border-slate-800">
                <div class="flex gap-1.5 mb-4 px-2">
                    <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                    <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                    <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                </div>

                <div class="bg-slate-950 rounded-2xl p-6 border border-slate-800 text-slate-400 text-sm">
                    <div class="flex justify-between items-center border-b border-slate-800 pb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-brand-500 animate-pulse"></span>
                            <h3 class="font-bold text-white text-base">Pharmacy Dashboard</h3>
                        </div>
                        <span class="bg-brand-500/10 text-brand-400 border border-brand-500/20 px-2.5 py-1 rounded-md text-xs font-semibold flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                            AI Analytics Active
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mt-6">
                        <div class="p-4 bg-slate-900/50 border border-slate-800/80 rounded-xl">
                            <p class="text-xs text-slate-500 mb-1">Total Products</p>
                            <h2 class="text-2xl font-black text-white">120</h2>
                        </div>
                        <div class="p-4 bg-slate-900/50 border border-slate-800/80 rounded-xl">
                            <p class="text-xs text-slate-500 mb-1">Daily Sales</p>
                            <h2 class="text-2xl font-black text-accent-400">4.2k</h2>
                        </div>
                        <div class="p-4 bg-slate-900/50 border border-slate-800/80 rounded-xl">
                            <p class="text-xs text-slate-500 mb-1">Restock Alerts</p>
                            <h2 class="text-2xl font-black text-rose-500">5</h2>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-slate-900/30 border border-slate-800/60 rounded-xl">
                        <p class="text-xs text-slate-500 mb-3">Live Growth Index</p>
                        <div class="h-16 flex items-end gap-2 pt-2">
                            <div class="w-full bg-slate-800 h-1/3 rounded-sm"></div>
                            <div class="w-full bg-slate-800 h-2/3 rounded-sm"></div>
                            <div class="w-full bg-brand-600 h-1/2 rounded-sm"></div>
                            <div class="w-full bg-accent-500 h-5/6 rounded-sm"></div>
                            <div class="w-full bg-gradient-to-t from-brand-500 to-accent-500 h-full rounded-sm"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: The Transformation (Problem vs Solution) -->
    <section id="transformation" class="bg-slate-900 text-white py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                <h2 class="text-3xl sm:text-4xl font-black tracking-tight">Stop wasting hours on manual tracking</h2>
                <p class="text-slate-400">See how shifting from fragmented legacy sheets to automated AI operations changes your day-to-day work.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
                <!-- Legacy Way -->
                <div class="bg-slate-950/50 border border-slate-800 rounded-3xl p-8 space-y-6">
                    <h4 class="text-xl font-bold text-rose-400 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        The Fragmented Legacy Method
                    </h4>
                    <ul class="space-y-4 text-slate-400 text-sm">
                        <li class="flex gap-3">❌ <span class="pt-0.5">Sudden out-of-stock crises turning patients away unexpectedly.</span></li>
                        <li class="flex gap-3">❌ <span class="pt-0.5">Expired medications found sitting silently on shelves, wasting money.</span></li>
                        <li class="flex gap-3">❌ <span class="pt-0.5">Hours lost wrestling with slow spreadsheets and confusing math scripts.</span></li>
                    </ul>
                </div>

                <!-- PharmaSmart Way -->
                <div class="bg-brand-600/10 border border-brand-500/20 rounded-3xl p-8 space-y-6 relative">
                    <div class="absolute top-4 right-4 bg-brand-500 text-white text-xs font-bold px-2.5 py-1 rounded-full uppercase">Optimized</div>
                    <h4 class="text-xl font-bold text-brand-400 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        The Autonomous PharmaSmart Way
                    </h4>
                    <ul class="space-y-4 text-slate-300 text-sm">
                        <li class="flex gap-3">✅ <span class="pt-0.5">Predictive inventory smart-alerts before critical products drain.</span></li>
                        <li class="flex gap-3">✅ <span class="pt-0.5">Proactive batch notifications way ahead of actual expiration windows.</span></li>
                        <li class="flex gap-3">✅ <span class="pt-0.5">Instant natural language chat summaries for automated supplier purchase orders.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-white border-y border-slate-100 py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <h2 class="text-3xl sm:text-4xl font-black text-slate-950 tracking-tight">Engineered for absolute accuracy</h2>
                <p class="text-slate-500 text-lg">Powerful components structured to run complex high-frequency store flows seamlessly.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
                <!-- Feature 1 -->
                <div class="bg-slate-50 hover:bg-white p-8 rounded-2xl border border-slate-100/80 shadow-sm hover:shadow-xl hover:border-transparent transition-all duration-300 group">
                    <div class="bg-white group-hover:bg-brand-50 text-slate-700 group-hover:text-brand-600 w-12 h-12 flex items-center justify-center rounded-xl shadow-sm transition-colors mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-2">Inventory Sync</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Track expiry dates, lots, and batch allocations with zero margin for error.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 hover:bg-white p-8 rounded-2xl border border-slate-100/80 shadow-sm hover:shadow-xl hover:border-transparent transition-all duration-300 group">
                    <div class="bg-white group-hover:bg-brand-50 text-slate-700 group-hover:text-brand-600 w-12 h-12 flex items-center justify-center rounded-xl shadow-sm transition-colors mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-2">Point of Sale</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Lightning-fast checkout system engineered for high-volume patient support.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 hover:bg-white p-8 rounded-2xl border border-slate-100/80 shadow-sm hover:shadow-xl hover:border-transparent transition-all duration-300 group">
                    <div class="bg-white group-hover:bg-brand-50 text-slate-700 group-hover:text-brand-600 w-12 h-12 flex items-center justify-center rounded-xl shadow-sm transition-colors mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-2">Advanced Analytics</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Gain absolute transparency into revenue flow and top-performing pharmaceutical products.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-slate-50 hover:bg-white p-8 rounded-2xl border border-slate-100/80 shadow-sm hover:shadow-xl hover:border-transparent transition-all duration-300 group">
                    <div class="bg-white group-hover:bg-brand-50 text-slate-700 group-hover:text-brand-600 w-12 h-12 flex items-center justify-center rounded-xl shadow-sm transition-colors mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-2">Smart Alerts</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Automated instant push alerts deployed prior to stock depletion or critical expiration dates.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- AI Conversational Engine Section -->
    <section id="ai" class="max-w-7xl mx-auto px-6 lg:px-8 py-24">
        <div class="bg-gradient-to-br from-slate-950 via-slate-900 to-brand-950 rounded-[2.5rem] p-8 lg:p-16 text-white relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:20px_20px]"></div>
            
            <div class="grid lg:grid-cols-12 gap-12 items-center relative z-10">
                
                <!-- AI Copywriting -->
                <div class="lg:col-span-6 space-y-6">
                    <div class="inline-flex items-center gap-2 bg-white/10 text-brand-300 px-4 py-1.5 rounded-full text-sm font-semibold border border-white/15">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275Z"/></svg>
                        Generative LLM Integration
                    </div>
                    <h2 class="text-4xl sm:text-5xl font-black leading-tight tracking-tight">
                        Your Copilot for Pharmacy Intelligence
                    </h2>
                    <p class="text-slate-400 text-lg leading-relaxed">
                        Query your transactional database using standard natural language. Run forecast simulations, identify stock leaks, and generate dynamic supplier orders instantly.
                    </p>

                    <!-- Interactive Micro Mockup -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 space-y-4 backdrop-blur-sm text-sm">
                        <div class="flex items-start gap-3">
                            <span class="bg-white/15 px-2.5 py-1 rounded-md text-xs font-bold text-white uppercase tracking-wider shrink-0 mt-0.5">User</span>
                            <p class="text-slate-200">"Which high-margin antibiotics are expiring next month?"</p>
                        </div>
                        <div class="flex items-start gap-3 border-t border-white/5 pt-3">
                            <span class="bg-brand-500 px-2.5 py-1 rounded-md text-xs font-bold text-white uppercase tracking-wider shrink-0 mt-0.5">AI</span>
                            <p class="text-brand-300 font-medium">"Amoxicillin Batch #402. I have drafted an upfront clearance promotion workflow for your approval."</p>
                        </div>
                    </div>
                </div>

                <!-- Chat UI Component -->
                <div class="lg:col-span-6 bg-slate-900/60 border border-white/10 rounded-3xl p-6 shadow-inner space-y-4">
                    <div class="bg-slate-950/80 border border-slate-800 p-4 rounded-xl text-slate-300 text-left flex items-center justify-between">
                        <span>How many products require immediate restock?</span>
                        <span class="text-slate-600 text-xs">11:14 AM</span>
                    </div>
                    
                    <div class="bg-gradient-to-r from-brand-600 to-accent-600 p-4 rounded-xl text-white text-left shadow-md flex items-start gap-3">
                        <div class="shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                        </div>
                        <p class="font-medium">You currently have 5 critical items below minimum threshold parameters. Restock order slips generated.</p>
                    </div>

                    <div class="flex gap-2 mt-4 pt-2 border-t border-slate-800">
                        <input type="text" disabled placeholder="Type your dynamic query..." class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-400 focus:outline-none opacity-70 cursor-not-allowed">
                        <button disabled class="bg-brand-500 px-4 rounded-xl opacity-70 cursor-not-allowed text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- NEW SECTION: How It Works -->
    <section id="workflow" class="bg-slate-50 border-t border-slate-100 py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
                <h2 class="text-3xl sm:text-4xl font-black text-slate-950 tracking-tight">Three steps to autonomous control</h2>
                <p class="text-slate-500">Getting your pharmacy up and running on PharmaSmart takes less than 10 minutes.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                <!-- Step 1 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200/60 shadow-sm relative space-y-4">
                    <span class="text-5xl font-extrabold text-indigo-100 block">01</span>
                    <h4 class="text-xl font-bold text-slate-900">Create Account & Upload</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Sign up and securely upload your legacy stock lists via simple CSV sheets or scan existing inventory codes directly.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200/60 shadow-sm relative space-y-4">
                    <span class="text-5xl font-extrabold text-indigo-100 block">02</span>
                    <h4 class="text-xl font-bold text-slate-900">Connect the AI Assistant</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Our AI scans your products to map expiration safety groups, sales rates, and automated alerts completely on autopilot.</p>
                </div>
                <!-- Step 3 -->
                <div class="bg-white p-8 rounded-2xl border border-slate-200/60 shadow-sm relative space-y-4">
                    <span class="text-5xl font-extrabold text-indigo-100 block">03</span>
                    <h4 class="text-xl font-bold text-slate-900">Run Transactions Smarter</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">Serve customers via our high-speed point of sale interface while the core architecture runs back-end optimizations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: FAQ -->
    <section class="bg-white border-t border-slate-100 py-24">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="text-center space-y-4 mb-16">
                <h2 class="text-3xl sm:text-4xl font-black text-slate-950 tracking-tight">Frequently Asked Questions</h2>
                <p class="text-slate-500">Clear insights addressing critical data migration and security operations.</p>
            </div>

            <div class="space-y-6">
                <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                    <h4 class="font-bold text-slate-900 mb-2">Is my store transactional database secure?</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">Yes. All records are fully encrypted using end-to-end cloud database protocols, ensuring complete internal privacy.</p>
                </div>
                <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                    <h4 class="font-bold text-slate-900 mb-2">Can I import datasets from existing software?</h4>
                    <p class="text-slate-600 text-sm leading-relaxed">Absolutely. PharmaSmart integrates generic mapping systems to ingest standard .xlsx, Excel, and legacy system files instantly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action (CTA) -->
    <section class="max-w-4xl mx-auto px-6 text-center py-20 space-y-6">
        <h2 class="text-4xl sm:text-5xl font-black text-slate-950 tracking-tight">Ready to upgrade your workflow?</h2>
        <p class="text-lg text-slate-500 max-w-xl mx-auto">
            Scale accuracy, eliminate medication shrinkage, and run smarter analytics with PharmaSmart.
        </p>
        <div class="pt-4">
            <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-700 hover:to-accent-700 text-white px-10 py-4 rounded-xl font-bold text-lg shadow-xl shadow-brand-500/20 transition-all hover:-translate-y-0.5">
                Create Your Account Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-slate-500 text-sm font-medium">
            <p>© {{ date('Y') }} PharmaSmart. All rights reserved.</p>
            <p class="flex items-center gap-1.5">
                Precision pharmacy tooling built for modern ecosystems.
            </p>
        </div>
    </footer>

</body>
</html>