<div x-data="aiDrawer">

    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 backdrop-blur-none" x-transition:enter-end="opacity-100 backdrop-blur-md"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 backdrop-blur-md"
        x-transition:leave-end="opacity-0 backdrop-blur-none" class="fixed inset-0 z-50 bg-slate-900/60" @click="close()">
    </div>

    <div x-show="open" x-cloak
        x-transition:enter="transition-transform ease-[cubic-bezier(0.2,0.8,0.2,1)] duration-500"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 z-[60] h-screen w-full max-w-[620px] bg-[#fcfdff] shadow-[0_0_60px_-15px_rgba(0,0,0,0.3)] rounded-l-lg flex flex-col overflow-hidden border-l border-white/50">
        <div
            class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-indigo-500/10 to-transparent pointer-events-none">
        </div>

        <div
            class="relative z-10 bg-white/70 backdrop-blur-xl border-b border-slate-100/80 px-6 py-5 shrink-0 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="relative flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 shadow-lg shadow-indigo-500/30 text-white">
                    <span class="material-symbols-outlined text-[24px] animate-pulse-slow">smart_toy</span>
                    <span
                        class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-white rounded-full"></span>
                </div>
                <div>
                    <h2
                        class="text-lg font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-slate-900 to-slate-700">
                        PharmaSmart AI
                    </h2>
                    <p class="text-[11px] font-bold text-indigo-500/80 tracking-wide uppercase"
                        x-text="title"></p>
                </div>
            </div>

            <div class="flex items-center gap-1.5">
                <button @click="loadAI()"
                    class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-500 hover:text-indigo-600 hover:bg-indigo-50/50 group transition-all duration-300"
                    title="Refresh Analysis">
                    <span
                        class="material-symbols-outlined text-[20px] group-hover:rotate-180 transition-transform duration-500">refresh</span>
                </button>

                <button @click="close()"
                    class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100/80 transition-all duration-200">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
        </div>

        <div class="relative flex-1 overflow-y-auto px-6 py-2 space-y-8 scroll-hide z-0">

            <div x-show="loading" class="h-full flex flex-col items-center justify-center py-20">
                <div class="relative w-24 h-24 mb-6">
                    <div class="absolute inset-0 rounded-full border border-indigo-200 animate-ping opacity-20"></div>
                    <div
                        class="absolute inset-2 rounded-full border border-violet-300 animate-ping opacity-40 animation-delay-300">
                    </div>
                    <div
                        class="absolute inset-4 rounded-full bg-gradient-to-tr from-indigo-500 to-violet-400 shadow-xl shadow-indigo-500/40 flex items-center justify-center text-white ai-breathe">
                        <span class="material-symbols-outlined text-[32px]">memory</span>
                    </div>
                </div>
                <h3 class="text-base font-bold text-slate-800 tracking-tight">AI is analyzing business data...</h3>
                <p class="text-xs text-slate-400 mt-1.5 text-center max-w-[260px]">Compiling deep metrics and real-time
                    pharmacy parameters.</p>
            </div>

            <div x-show="!loading && data" x-transition:enter="transition ease-out duration-500 delay-150"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                class="space-y-6">

                <div class="p-4 bg-white border border-slate-100 rounded-2xl shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                                    :class="{
                                        'bg-emerald-400': data?.status?.level === 'good',
                                        'bg-amber-400': data?.status?.level === 'warning',
                                        'bg-rose-400': data?.status?.level === 'critical'
                                    }"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2"
                                    :class="{
                                        'bg-emerald-500': data?.status?.level === 'good',
                                        'bg-amber-500': data?.status?.level === 'warning',
                                        'bg-rose-500': data?.status?.level === 'critical'
                                    }"></span>
                            </span>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Health
                                Assessment</span>
                        </div>
                        <div class="px-3 py-1 rounded-full text-xs font-bold"
                            :class="{
                                'bg-emerald-50 text-emerald-700': data?.status?.level === 'good',
                                'bg-amber-50 text-amber-700': data?.status?.level === 'warning',
                                'bg-rose-50 text-rose-700': data?.status?.level === 'critical'
                            }"
                            x-text="data?.status?.label || 'Optimal'">
                        </div>
                    </div>

                    <div x-show="data?.generated_at"
                        class="flex items-center gap-1.5 pt-2 border-t border-slate-50 text-[11px] text-slate-400 font-medium">
                        <span class="material-symbols-outlined text-[14px]">schedule</span>
                        <span>Generated:</span>
                        <span class="text-slate-600 font-semibold" x-text="data?.generated_at"></span>
                    </div>
                </div>

                <div x-show="data?.summary?.length">
                    <div class="flex items-center gap-2 mb-3.5 px-1">
                        <span class="material-symbols-outlined text-slate-400 text-[18px]">query_stats</span>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Executive Summary</h3>
                    </div>
                    <div class="space-y-3">
                        <template x-for="item in data?.summary">
                            <div
                                class="group relative p-4 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:border-indigo-100 transition-all duration-300 cursor-default overflow-hidden">
                                <div
                                    class="absolute left-0 top-0 bottom-0 w-1 bg-slate-200 group-hover:bg-indigo-500 transition-colors duration-300">
                                </div>
                                <h4 class="text-xs font-bold text-slate-800 mb-1" x-text="item.title"></h4>
                                <p class="text-[11px] text-slate-500 leading-relaxed font-medium" x-text="item.message">
                                </p>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="data?.alerts?.length">
                    <div class="flex items-center gap-2 mb-3.5 px-1">
                        <span class="material-symbols-outlined text-rose-500 text-[18px]">warning</span>
                        <h3 class="text-xs font-bold text-rose-500 uppercase tracking-wider">Critical Alerts</h3>
                    </div>
                    <div class="space-y-3">
                        <template x-for="alert in data?.alerts">
                            <div class="p-4 rounded-2xl border transition-all duration-200"
                                :class="{
                                    'bg-rose-50/50 border-rose-100 text-rose-900': alert.level === 'high',
                                    'bg-amber-50/50 border-amber-100 text-amber-900': alert.level === 'medium',
                                    'bg-slate-50 border-slate-100 text-slate-800': alert.level === 'low'
                                }">
                                <div class="flex items-start gap-2.5">
                                    <span class="material-symbols-outlined text-[18px] mt-0.5"
                                        :class="{
                                            'text-rose-500': alert.level === 'high',
                                            'text-amber-500': alert.level === 'medium',
                                            'text-slate-400': alert.level === 'low'
                                        }">notification_important</span>
                                    <div>
                                        <h4 class="text-xs font-bold" x-text="alert.title"></h4>
                                        <p class="mt-1 text-[11px] opacity-80 leading-relaxed font-medium"
                                            x-text="alert.message"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="data?.recommendations?.length">
                    <div class="flex items-center gap-2 mb-3.5 px-1">
                        <span class="material-symbols-outlined text-amber-500 text-[18px]">tips_and_updates</span>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Actionable
                            Recommendations</h3>
                    </div>
                    <div class="bg-slate-50/40 rounded-2xl border border-slate-100/70 p-1.5">
                        <template x-for="item in data?.recommendations">
                            <div
                                class="flex items-start gap-3 p-3 hover:bg-white rounded-xl transition-all duration-200 group">
                                <div
                                    class="w-5 h-5 rounded-full bg-white border-2 border-slate-200 flex items-center justify-center group-hover:border-amber-400 group-hover:bg-amber-50 transition-all shrink-0 mt-0.5">
                                    <span
                                        class="material-symbols-outlined text-[12px] text-transparent group-hover:text-amber-500">check</span>
                                </div>
                                <span
                                    class="text-xs font-semibold text-slate-600 leading-relaxed group-hover:text-slate-900 transition-colors"
                                    x-text="item"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="data?.insights?.length" class="pb-6">
                    <div class="flex items-center gap-2 mb-3.5 px-1">
                        <span class="material-symbols-outlined text-violet-500 text-[18px]">auto_awesome</span>
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Deep Insights</h3>
                    </div>
                    <div class="space-y-2.5">
                        <template x-for="item in data?.insights">
                            <div
                                class="flex items-start gap-3 p-3.5 bg-white border border-slate-100 rounded-2xl hover:border-violet-200 transition-all shadow-sm">
                                <span
                                    class="material-symbols-outlined text-violet-400 text-[16px] shrink-0 mt-0.5">blur_on</span>
                                <span class="text-xs font-medium text-slate-600 leading-relaxed"
                                    x-text="item"></span>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
        </div>

        <div
            class="absolute bottom-0 left-0 right-0 h-12 bg-gradient-to-t from-[#fcfdff] to-transparent pointer-events-none z-10">
        </div>
    </div>
</div>
