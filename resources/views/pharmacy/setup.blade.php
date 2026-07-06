<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Your Pharmacy - PharmaSmart</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-primary': '#4F46E5',
                        'brand-gradient-to': '#0EA5E9',
                        'brand-text': '#0F172A',
                        'brand-bg': '#F1F5F9',
                        'error': '#EF4444',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body
    class="bg-brand-bg text-brand-text font-sans min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 selection:bg-brand-primary/10 selection:text-brand-primary">

    <div
        class="w-full max-w-5xl bg-white shadow-2xl shadow-slate-300/40 rounded-[2rem] border border-slate-100 overflow-hidden grid grid-cols-1 lg:grid-cols-12">

        <div
            class="lg:col-span-4 bg-gradient-to-br from-brand-primary via-[#4338CA] to-brand-gradient-to p-8 lg:p-12 flex flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-sky-300/20 rounded-full blur-3xl"></div>

            <div class="space-y-6 relative z-10">
                <div
                    class="inline-flex items-center justify-center w-14 h-14 bg-white/10 backdrop-blur-lg rounded-2xl text-white shadow-lg border border-white/20">
                    <span class="material-icons-outlined text-3xl">local_hospital</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight">PharmaSmart</h1>
                    <p class="text-indigo-100/80 text-sm mt-2 leading-relaxed">Let's set up your new digital
                        pharmaceutical workspace in just a few simple steps.</p>
                </div>
            </div>

            <div class="pt-12 lg:pt-0 relative z-10">
                <div
                    class="flex items-center gap-3 text-xs uppercase tracking-widest text-indigo-50 font-bold bg-white/10 px-4 py-3 rounded-xl backdrop-blur-md w-fit border border-white/10 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-sky-300 animate-pulse"></span>
                    Step 1: Core Profile
                </div>
            </div>
        </div>

        <div class="lg:col-span-8 p-8 lg:p-12 bg-slate-50/50">
            <h2 class="text-2xl font-bold text-brand-text mb-1 tracking-tight">Pharmacy Information</h2>
            <p class="text-sm text-slate-400 mb-8">Please provide the registered details for your pharmacy branch.</p>

            <form action="{{ route('pharmacy.setup.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Pharmacy Name
                            <span class="text-error">*</span></label>
                        <input type="text" name="name" required
                            class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-brand-text shadow-sm focus:border-brand-primary focus:ring-4 focus:ring-brand-primary/10 focus:outline-none transition-all duration-200 placeholder:text-slate-300 text-sm"
                            placeholder="e.g. CareFirst Pharmacy">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Phone Number
                            <span class="text-error">*</span></label>
                        <input type="text" name="phone" required
                            class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-brand-text shadow-sm focus:border-brand-primary focus:ring-4 focus:ring-brand-primary/10 focus:outline-none transition-all duration-200 placeholder:text-slate-300 text-sm"
                            placeholder="e.g. +970 599 000 000">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Pharmacy Email
                            <span class="text-slate-400 font-normal lowercase">(optional)</span></label>
                        <input type="email" name="email"
                            class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-brand-text shadow-sm focus:border-brand-primary focus:ring-4 focus:ring-brand-primary/10 focus:outline-none transition-all duration-200 placeholder:text-slate-300 text-sm"
                            placeholder="contact@pharmacy.com">
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">License Number
                            <span class="text-slate-400 font-normal lowercase">(optional)</span></label>
                        <input type="text" name="license_number"
                            class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-brand-text shadow-sm focus:border-brand-primary focus:ring-4 focus:ring-brand-primary/10 focus:outline-none transition-all duration-200 placeholder:text-slate-300 text-sm"
                            placeholder="e.g. LIC-2026-XXXX">
                    </div>

                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Address / Physical
                        Location</label>
                    <textarea name="address" rows="2"
                        class="mt-1 block w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-brand-text shadow-sm focus:border-brand-primary focus:ring-4 focus:ring-brand-primary/10 focus:outline-none transition-all duration-200 placeholder:text-slate-300 text-sm resize-none"
                        placeholder="Street, Building, City..."></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">Pharmacy Logo</label>
                    <div
                        class="mt-1 flex items-center gap-4 p-4 border border-slate-200 bg-white rounded-xl hover:border-brand-primary/40 hover:bg-indigo-50/10 transition-all duration-200 group cursor-pointer relative shadow-sm">

                        <div id="logo-preview-container"
                            class="flex items-center justify-center w-12 h-12 bg-slate-100 rounded-xl text-slate-400 group-hover:bg-brand-primary/10 group-hover:text-brand-primary transition-all overflow-hidden bg-cover bg-center">
                            <span id="logo-icon" class="material-icons-outlined text-xl">image</span>
                        </div>

                        <div class="flex-1 text-left">
                            <label for="file-upload"
                                class="cursor-pointer font-bold text-brand-primary hover:text-[#4338CA] text-sm focus-within:outline-none block">
                                <span id="upload-text">Upload logo image</span>
                                <input id="file-upload" name="logo" type="file" accept="image/*" class="sr-only">
                            </label>
                            <p class="text-xs text-slate-400 mt-0.5">PNG, JPG or WEBP up to 2MB</p>
                        </div>
                    </div>
                </div>

                <div class="pt-5 flex items-center justify-end border-t border-slate-100">
                    <button type="submit"
                        class="w-full sm:w-auto flex justify-center items-center gap-2 bg-gradient-to-r from-brand-primary to-[#4338CA] text-white py-3.5 px-8 rounded-xl font-bold shadow-lg shadow-indigo-600/20 hover:opacity-[0.97] hover:shadow-xl hover:shadow-indigo-600/30 focus:outline-none focus:ring-4 focus:ring-brand-primary/20 transform active:scale-[0.99] transition-all duration-200 cursor-pointer text-sm">
                        Create Workspace
                        <span class="material-icons-outlined text-sm">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('file-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = document.getElementById('logo-preview-container');
                    const icon = document.getElementById('logo-icon');
                    const uploadText = document.getElementById('upload-text');

                    // تعيين الصورة المرفوعة كخلفية للمربع الصغير
                    container.style.backgroundImage = `url('${e.target.result}')`;
                    // إخفاء الأيقونة الافتراضية للجمالية
                    icon.style.display = 'none';
                    // تغيير النص ليوضح أنه تم اختيار صورة
                    uploadText.textContent = "Change logo image";
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>
