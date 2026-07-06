@extends('layouts.pharma')
@section('content')
    <link href="https://fonts.googleapis.com/pipe/css?family=Material+Icons+Outlined" rel="stylesheet">

    <div class="max-w-6xl mx-auto px-4 py-10 sm:px-6 lg:px-8" dir="ltr">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between pb-8 mb-10 border-b border-slate-100 gap-6">
            <div>
                <div class="flex items-center gap-2 text-[11px] text-slate-400 font-bold uppercase tracking-widest mb-2">
                    <span>Workspace</span>
                    <span class="material-icons-outlined text-[10px]">chevron_right</span>
                    <span class="text-emerald-600">Management</span>
                    <span class="material-icons-outlined text-[10px]">chevron_right</span>
                    <span class="text-slate-300 font-normal">Settings</span>
                </div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">System Settings</h1>
                <p class="text-sm text-slate-500 mt-2 max-w-xl leading-relaxed">Refine your pharmacy brand identity, control operational preferences, and manage global workspace configurations.</p>
            </div>

            <div class="flex items-center dynamic-actions">
                <button type="submit" form="settings-form"
                    class="w-full md:w-auto inline-flex justify-center items-center gap-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold py-3 px-7 rounded-2xl shadow-xl shadow-slate-900/10 hover:shadow-slate-900/20 active:scale-[0.98] transition-all duration-200 cursor-pointer">
                    <span class="material-icons-outlined text-lg">check_circle</span>
                    Save Changes
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            <aside class="lg:col-span-3 space-y-1">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider px-4 mb-3">Core Sections</p>
                <a href="#"
                    class="flex items-center justify-between bg-emerald-50/60 text-emerald-700 font-bold px-4 py-3.5 rounded-xl border border-emerald-100/50 transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-icons-outlined text-xl text-emerald-600">storefront</span>
                        <span class="text-sm">Pharmacy Profile</span>
                    </div>
                    <span class="material-icons-outlined text-xs opacity-0 group-hover:opacity-100 transition-all transform translate-x-[-4px] group-hover:translate-x-0">arrow_forward</span>
                </a>
                <a href="#"
                    class="flex items-center justify-between text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-medium px-4 py-3.5 rounded-xl transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-icons-outlined text-xl text-slate-400 group-hover:text-slate-600">manage_accounts</span>
                        <span class="text-sm">Admin Account</span>
                    </div>
                </a>
                <a href="#"
                    class="flex items-center justify-between text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-medium px-4 py-3.5 rounded-xl transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-icons-outlined text-xl text-slate-400 group-hover:text-slate-600">payments</span>
                        <span class="text-sm">Billing & Plan</span>
                    </div>
                </a>
                <a href="#"
                    class="flex items-center justify-between text-slate-500 hover:bg-slate-50 hover:text-slate-900 font-medium px-4 py-3.5 rounded-xl transition-all group">
                    <div class="flex items-center gap-3">
                        <span class="material-icons-outlined text-xl text-slate-400 group-hover:text-slate-600">tune</span>
                        <span class="text-sm">Preferences</span>
                    </div>
                </a>
            </aside>

            <main class="lg:col-span-9 bg-white border border-slate-100 rounded-3xl shadow-2xl shadow-slate-200/50 p-6 sm:p-10 relative overflow-hidden">
                
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-emerald-100/20 to-transparent rounded-full blur-2xl pointer-events-none"></div>

                <div class="mb-8 relative z-10">
                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Pharmacy Profile Details</h2>
                    <p class="text-xs text-slate-400 mt-1">Ensure your pharmacy’s public facing information is compliant and updated.</p>
                </div>

                <form id="settings-form" action="{{ route('pharmacy.settings.update') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-8 relative z-10">

                    @csrf
                    @method('PUT')

                    <div class="bg-slate-50/40 p-6 rounded-2xl border border-slate-100 flex flex-col md:flex-row items-center gap-6">
                        <div class="relative group">
                            <div id="logo-preview"
                                class="w-24 h-24 bg-white rounded-2xl border-2 border-dashed border-slate-200 shadow-inner flex items-center justify-center overflow-hidden bg-cover bg-center transition-all duration-300 group-hover:border-emerald-400"
                                style="background-image: url('{{ $pharmacy->logo ? asset("pharmacy_logos/{$pharmacy->logo}") : 'https://placehold.co/150x150/10b981/ffffff?text=PH' }}');">
                                <span id="logo-placeholder-icon"
                                    class="material-icons-outlined text-3xl text-slate-300 {{ $pharmacy->logo ? 'hidden' : '' }}">image</span>
                            </div>
                        </div>

                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-sm font-bold text-slate-800">Brand Representation</h3>
                            <p class="text-xs text-slate-400 mt-1 max-w-md leading-relaxed">This asset dictates your pharmacy logo visibility on printable invoices, dynamic medical prescriptions, and structural reports.</p>

                            <div class="flex flex-wrap items-center justify-center md:justify-start gap-2 pt-4">
                                <label for="logo-upload"
                                    class="cursor-pointer inline-flex items-center gap-2 bg-white border border-slate-200 hover:border-slate-300 px-3.5 py-2 rounded-xl font-semibold text-xs text-slate-700 shadow-sm hover:bg-slate-50 transition-all">
                                    <span class="material-icons-outlined text-sm text-slate-400">cloud_upload</span>
                                    Upload Brand Logo
                                    <input id="logo-upload" name="logo" type="file" accept="image/*" class="sr-only">
                                </label>
                                <button type="button" id="btn-remove-logo"
                                    class="inline-flex items-center gap-2 bg-transparent border border-transparent hover:bg-rose-50 px-3.5 py-2 rounded-xl font-semibold text-xs text-rose-600 transition-all">
                                    <span class="material-icons-outlined text-sm">delete_sweep</span>
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">

                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pharmacy Corporate Name <span class="text-rose-500">*</span></label>
                            <input type="text" name="name" required value="{{ $pharmacy->name }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200/80 bg-white text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 focus:outline-none transition-all duration-150 text-sm">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Hotline / Phone Number <span class="text-rose-500">*</span></label>
                            <input type="text" name="phone" required value="{{ $pharmacy->phone }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200/80 bg-white text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 focus:outline-none transition-all duration-150 text-sm">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Official Email Address</label>
                            <input type="email" name="email" value="{{ $pharmacy->email }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200/80 bg-white text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 focus:outline-none transition-all duration-150 text-sm">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Institutional License ID</label>
                            <input type="text" name="license_number" value="{{ $pharmacy->license_number }}"
                                class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200/80 bg-white text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 focus:outline-none transition-all duration-150 text-sm">
                        </div>

                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Physical Headquarters Location</label>
                        <textarea name="address" rows="3"
                            class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200/80 bg-white text-slate-800 shadow-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 focus:outline-none transition-all duration-150 text-sm resize-none leading-relaxed">{{ $pharmacy->address }}</textarea>
                    </div>

                    <div class="flex items-start gap-3.5 p-4 bg-emerald-50/40 border border-emerald-100/70 rounded-2xl text-emerald-800 text-xs leading-relaxed">
                        <span class="material-icons-outlined text-lg text-emerald-600 mt-0.5">verified_user</span>
                        <div class="space-y-0.5">
                            <p class="font-bold text-emerald-950">System Audit Warning</p>
                            <p class="text-emerald-700/90">Modifying core entities such as the legal pharmacy branch title or primary contact email triggers a persistent log notification dispatched directly to all enterprise stakeholders for security protocol compliance.</p>
                        </div>
                    </div>

                </form>
            </main>
        </div>
    </div>

    <script>
        const logoUploadInput = document.getElementById('logo-upload');
        const logoPreview = document.getElementById('logo-preview');
        const placeholderIcon = document.getElementById('logo-placeholder-icon');
        const btnRemoveLogo = document.getElementById('btn-remove-logo');

        logoUploadInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.style.backgroundImage = `url('${e.target.result}')`;
                    placeholderIcon.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        btnRemoveLogo.addEventListener('click', function() {
            logoUploadInput.value = "";
            logoPreview.style.backgroundImage = 'none';
            placeholderIcon.classList.remove('hidden');
        });
    </script>
@endsection