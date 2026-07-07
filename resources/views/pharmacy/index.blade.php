@extends('layouts.pharma')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    
    <!-- الهيدر العلوي للصفحة -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 mb-8 border-b border-slate-200 gap-4">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-brand-text">My Pharmacy</h1>
            <p class="text-sm text-slate-500 mt-1">Overview of your registered pharmacy workspace profile details.</p>
        </div>
        
        @if($pharmacy)
            <!-- زر الانتقال لصفحة التعديل -->
            <div>
                <a href="{{ route('pharmacy.settings') }}" class="inline-flex justify-center items-center gap-2 bg-gradient-to-r from-brand-primary to-[#4338CA] text-white py-2.5 px-6 rounded-xl font-bold shadow-md shadow-indigo-600/10 hover:opacity-[0.97] transition-all duration-200 text-sm">
                    <span class="material-icons-outlined text-lg">edit</span>
                    Edit Settings
                </a>
            </div>
        @endif
    </div>

    @if($pharmacy)
        <!-- بطاقة عرض البيانات الأساسية بشكل احترافي -->
        <div class="bg-white border border-slate-200/60 rounded-3xl shadow-xl shadow-slate-100/40 p-6 sm:p-8 space-y-8">
            
            <!-- بروفايل الصيدلية (اللوجو والاسم) -->
            <div class="flex flex-col sm:flex-row items-center gap-5 pb-6 border-b border-slate-100">
                <div class="w-20 h-20 bg-slate-100 rounded-2xl border border-slate-200 overflow-hidden flex items-center justify-center bg-cover bg-center shadow-sm">
                    @if($pharmacy->logo)
                        <img src="{{ asset('storage/' . $pharmacy->logo) }}" alt="{{ $pharmacy->name }}" class="w-full h-full object-cover">
                    @else
                        <!-- لوجو افتراضي في حال عدم وجود لوجو مرفوع -->
                        <span class="material-icons-outlined text-3xl text-slate-400">storefront</span>
                    @endif
                </div>
                <div class="text-center sm:text-left">
                    <h2 class="text-xl font-bold text-brand-text">{{ $pharmacy->name }}</h2>
                    <p class="text-xs text-brand-primary font-semibold uppercase tracking-wider mt-0.5">Active Pharmaceutical Workspace</p>
                </div>
            </div>

            <!-- شبكة عرض البيانات التفصيلية -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- رقم الهاتف -->
                <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50/60 border border-slate-100">
                    <div class="p-2.5 bg-white text-brand-primary rounded-xl border border-slate-200/60 shadow-sm flex items-center justify-center">
                        <span class="material-icons-outlined text-xl">phone</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Phone Number</span>
                        <span class="text-sm font-semibold text-brand-text mt-0.5 block">{{ $pharmacy->phone }}</span>
                    </div>
                </div>

                <!-- البريد الإلكتروني -->
                <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50/60 border border-slate-100">
                    <div class="p-2.5 bg-white text-brand-primary rounded-xl border border-slate-200/60 shadow-sm flex items-center justify-center">
                        <span class="material-icons-outlined text-xl">mail</span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Email Address</span>
                        <span class="text-sm font-semibold text-brand-text mt-0.5 block">{{ $pharmacy->email ?? 'Not Provided' }}</span>
                    </div>
                </div>

            </div>

            <!-- العنوان الكامل (بسطر عريض بالأسفل) -->
            <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50/60 border border-slate-100">
                <div class="p-2.5 bg-white text-brand-primary rounded-xl border border-slate-200/60 shadow-sm flex items-center justify-center">
                    <span class="material-icons-outlined text-xl">location_on</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Physical Location</span>
                    <span class="text-sm font-semibold text-brand-text mt-0.5 block leading-relaxed">{{ $pharmacy->address ?? 'Not Provided' }}</span>
                </div>
            </div>

        </div>
    @else
        <!-- حالة عدم وجود صيدلية في النظام (Empty State) بتصميم فخم جداً -->
        <div class="bg-white border border-slate-200/60 rounded-3xl shadow-xl shadow-slate-100/40 p-12 text-center max-w-md mx-auto mt-12">
            <div class="w-16 h-16 bg-indigo-50 text-brand-primary rounded-2xl flex items-center justify-center mx-auto mb-4 border border-indigo-100">
                <span class="material-icons-outlined text-3xl">storefront</span>
            </div>
            <h2 class="text-xl font-bold text-brand-text">No Pharmacy Found</h2>
            <p class="text-sm text-slate-400 mt-2 mb-6 leading-relaxed">You haven't registered or created a pharmacy workspace yet. Let's build your workspace now.</p>
            
            <a href="{{ route('pharmacy.setup') }}" class="inline-flex justify-center items-center gap-2 bg-gradient-to-r from-brand-primary to-[#4338CA] text-white py-3 px-6 rounded-xl font-bold shadow-md shadow-indigo-600/10 hover:opacity-[0.97] transition-all duration-200 text-sm w-full">
                Create Pharmacy Workspace
                <span class="material-icons-outlined text-sm">arrow_forward</span>
            </a>
        </div>
    @endif

</div>
@endsection