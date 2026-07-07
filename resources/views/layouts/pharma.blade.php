<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>PharmaSmart Dashboard | Pharmacy Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-fixed-variant": "#7b2f00",
                        "primary-container": "#4f46e5",
                        "outline-variant": "#c7c4d8",
                        "on-secondary-fixed": "#001e2f",
                        "tertiary-fixed-dim": "#ffb695",
                        "secondary": "#006591",
                        "on-primary": "#ffffff",
                        "tertiary-fixed": "#ffdbcc",
                        "inverse-on-surface": "#eaf1ff",
                        "secondary-container": "#39b8fd",
                        "surface": "#f8f9ff",
                        "on-tertiary-container": "#ffd2be",
                        "error": "#ba1a1a",
                        "surface-container-low": "#eff4ff",
                        "inverse-surface": "#213145",
                        "tertiary-container": "#a44100",
                        "secondary-fixed": "#c9e6ff",
                        "error-container": "#ffdad6",
                        "surface-container": "#e5eeff",
                        "surface-bright": "#f8f9ff",
                        "on-tertiary-fixed": "#351000",
                        "primary-fixed": "#e2dfff",
                        "on-surface-variant": "#464555",
                        "on-secondary-fixed-variant": "#004c6e",
                        "surface-container-highest": "#d3e4fe",
                        "tertiary": "#7e3000",
                        "on-background": "#0b1c30",
                        "on-primary-fixed-variant": "#3323cc",
                        "on-error": "#ffffff",
                        "surface-tint": "#4d44e3",
                        "on-secondary-container": "#004666",
                        "surface-container-high": "#dce9ff",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#0b1c30",
                        "background": "#f8f9ff",
                        "outline": "#777587",
                        "on-error-container": "#93000a",
                        "surface-variant": "#d3e4fe",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#dad7ff",
                        "inverse-primary": "#c3c0ff",
                        "on-tertiary": "#ffffff",
                        "primary-fixed-dim": "#c3c0ff",
                        "surface-dim": "#cbdbf5",
                        "secondary-fixed-dim": "#89ceff",
                        "on-primary-fixed": "#0069",
                        "primary": "#3525cd"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sidebar-width": "280px",
                        "stack-md": "1rem",
                        "stack-sm": "0.5rem",
                        "container-max": "1440px",
                        "gutter": "1.5rem",
                        "stack-lg": "2rem"
                    },
                    "fontFamily": {
                        "label-md": ["Inter"],
                        "mono-sm": ["JetBrains Mono"],
                        "headline-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-sm": ["Inter"],
                        "display-lg": ["Inter"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "label-md": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "mono-sm": ["12px", {
                            "lineHeight": "16px",
                            "fontWeight": "400"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "headline-sm": ["20px", {
                            "lineHeight": "28px",
                            "fontWeight": "600"
                        }],
                        "display-lg": ["36px", {
                            "lineHeight": "44px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-md": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .ai-glow {
            box-shadow: 0 0 15px -3px rgba(79, 70, 229, 0.2);
        }

        .scroll-hide::-webkit-scrollbar {
            display: none;
        }

        .scroll-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-background text-on-background min-h-screen flex relative overflow-x-hidden">
    
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden md:hidden transition-opacity duration-200"></div>

    <aside id="main-sidebar"
        class="w-72 md:w-[sidebar-width] min-h-screen fixed md:sticky top-0 left-0 flex-col bg-surface-container-lowest dark:bg-surface-container-low border-r border-outline-variant dark:border-outline shadow-sm z-50 hidden md:flex transition-transform duration-300 -translate-x-full md:translate-x-0">
        <div class="flex flex-col p-4 gap-stack-md h-full overflow-y-auto">
            <div class="flex justify-between items-center mb-6 px-2">
                <div>
                    <h1 class="font-display-lg text-2xl md:text-display-lg font-bold text-primary dark:text-primary-container">
                        PharmaSmart</h1>
                    <p class="font-label-md text-label-md text-on-surface-variant">Admin Account</p>
                </div>
                <button id="close-sidebar" class="md:hidden material-symbols-outlined p-1 text-on-surface-variant hover:bg-surface-container rounded-lg">
                    close
                </button>
            </div>
            
            <a href="{{ route('sales.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-primary text-white hover:bg-primary/90 transition">
                <span class="material-symbols-outlined">add</span>
                New Sale
            </a>
            
            <nav class="flex-1 space-y-1">
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('dashboard') || request()->is('dashboard*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="{{ route('dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md text-label-md">Dashboard</span>
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('categories.*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="{{ route('categories.index') }}">
                    <span class="material-symbols-outlined">category</span>
                    <span class="font-label-md text-label-md">Categories</span>
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('suppliers.*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="{{ route('suppliers.index') }}">
                    <span class="material-symbols-outlined">group</span>
                    <span class="font-label-md text-label-md">Suppliers</span>
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('products.*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="{{ route('products.index') }}">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="font-label-md text-label-md">Products</span>
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('sales.*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="{{ route('sales.index') }}">
                    <span class="material-symbols-outlined">point_of_sale</span>
                    <span class="font-label-md text-label-md">Sales</span>
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('purchase.*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="{{ route('purchase.index') }}">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="font-label-md text-label-md">Purchases</span>
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('inventory.*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="#">
                    <span class="material-symbols-outlined">package_2</span>
                    <span class="font-label-md text-label-md">Inventory</span>
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('reports.*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="#">
                    <span class="material-symbols-outlined">analytics</span>
                    <span class="font-label-md text-label-md">Reports</span>
                </a>

                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('insights.*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="#">
                    <span class="material-symbols-outlined">psychology_alt</span>
                    <span class="font-label-md text-label-md">AI Insights</span>
                </a>
            </nav>
            
            <div class="mt-auto pt-4 border-t border-outline-variant space-y-1">
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('pharmacy.settings*') ? 'border-l-4 border-primary bg-surface-container-low dark:bg-secondary-container/20 text-primary dark:text-primary-container font-semibold' : 'text-on-surface-variant dark:text-on-secondary-fixed-variant hover:bg-surface-container dark:hover:bg-on-secondary-fixed-variant/10' }} transition-colors duration-200"
                    href="{{ route('pharmacy.settings') }}">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="font-label-md text-label-md">Settings</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container transition-colors duration-200"
                    href="#">
                    <span class="material-symbols-outlined">help</span>
                    <span class="font-label-md text-label-md">Support</span>
                </a>
                <div class="mt-4 flex items-center gap-3 px-2">
                    <img class="w-10 h-10 rounded-full bg-surface-container-highest object-cover"
                        data-alt="A professional headshot..."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAq2Q-sgmlUPrDSJ1k9JAYndLXfZNfxPJDe0MpbzTS1_dskyjdlFM-CJpR5nGX7wYWi05RM_xFHIo7-BZ22lcD2feC2zTio6Z-adjFuHdbxF3N1oUaCH2RFhQR3lPjMwr18Si9QtY6iLduiVKi7TtCWXHd9FdJT0ws7-HOJD3CIPnS57dcNFJn3lfbNZVv4i3DDJT52e3r6tFguxmSj0HPwBpJPLjua5cN3XgzwKwRZHI0MaKTGxNIX" />
                    <div class="overflow-hidden">
                        <p class="font-label-md text-label-md truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-on-surface-variant">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-h-screen overflow-x-hidden overflow-y-auto scroll-hide">
        <header
            class="h-16 w-full sticky top-0 z-40 bg-surface/95 backdrop-blur-md border-b border-outline-variant dark:border-outline">
            <div class="flex justify-between items-center px-4 md:px-gutter w-full max-w-container-max mx-auto h-full gap-4">
                
                <div class="flex items-center gap-3 flex-1">
                    <button id="open-sidebar" class="md:hidden material-symbols-outlined p-2 text-on-surface-variant hover:bg-surface-container-low rounded-lg transition-colors">
                        menu
                    </button>

                    <div class="relative w-full max-w-md focus-within:ring-2 focus-within:ring-primary rounded-lg transition-all">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                        <input
                            class="w-full bg-surface-container-low border-none rounded-lg pl-10 pr-10 md:pr-4 py-2 text-body-md focus:ring-0"
                            placeholder="Search inventory, Rx..." type="text" />
                        <span class="hidden sm:inline absolute right-3 top-1/2 -translate-y-1/2 font-mono-sm text-mono-sm text-outline-variant px-1.5 py-0.5 border border-outline-variant rounded">⌘K</span>
                    </div>
                    
                    <div class="hidden lg:flex gap-6 ml-4">
                        <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors"
                            href="#">Inventory Alerts</a>
                        <a class="font-body-md text-body-md text-on-surface-variant hover:text-primary transition-colors"
                            href="#">Recent Reports</a>
                    </div>
                </div>

                <div class="flex items-center gap-1 md:gap-2 shrink-0">
                    <button class="material-symbols-outlined p-2 text-on-surface-variant hover:bg-surface-container-low rounded-lg transition-colors">notifications</button>
                    <button class="hidden sm:inline-block material-symbols-outlined p-2 text-on-surface-variant hover:bg-surface-container-low rounded-lg transition-colors">history</button>
                    <div class="hidden sm:block h-8 w-[1px] bg-outline-variant mx-1"></div>
                    <button class="bg-secondary/10 text-secondary px-3 py-2 md:px-4 md:py-2 rounded-lg font-label-md text-xs md:text-label-md flex items-center gap-1 md:gap-2 hover:bg-secondary/20 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">qr_code_scanner</span>
                        <span class="hidden xs:inline">Scan Rx</span>
                    </button>
                </div>
            </div>
        </header>

        @if (session('success'))
            <div class="m-6 p-4 rounded-xl bg-emerald-500/10 text-emerald-600 font-semibold text-sm border border-emerald-500/20">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="m-6 p-4 rounded-xl bg-rose-500/10 text-rose-600 font-semibold text-sm border border-rose-500/20">
                {{ session('error') }}
            </div>
        @endif

        <div class="p-4 md:p-6 flex-1">
            @yield('content')
        </div>
    </main>

    <script>
        // دالة اختصار الكيبورد للبحث
        document.addEventListener('keydown', (e) => {
            if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                e.preventDefault();
                document.querySelector('input[type="text"]').focus();
            }
        });

        // تأثيرات حركية لبطاقات المؤشرات
        const metricCards = document.querySelectorAll('.bg-surface-container-lowest');
        metricCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-2px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });

        // جافاسكريبت للتحكم في فتح وإغلاق المنيو على الهواتف
        const openSidebarBtn = document.getElementById('open-sidebar');
        const closeSidebarBtn = document.getElementById('close-sidebar');
        const mainSidebar = document.getElementById('main-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            mainSidebar.classList.toggle('hidden');
            mainSidebar.classList.toggle('flex');
            sidebarOverlay.classList.toggle('hidden');
            
            setTimeout(() => {
                if (!mainSidebar.classList.contains('hidden')) {
                    mainSidebar.classList.remove('-translate-x-full');
                } else {
                    mainSidebar.classList.add('-translate-x-full');
                }
            }, 10);
        }

        if (openSidebarBtn && closeSidebarBtn) {
            openSidebarBtn.addEventListener('click', toggleSidebar);
            closeSidebarBtn.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);
        }
    </script>
</body>

</html>