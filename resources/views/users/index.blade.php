@extends('layouts.pharma')

@section('content')
<div class="space-y-6 p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-on-surface dark:text-white">Staff Management</h1>
            <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Add, update, and manage system access roles for your medical and administrative team.</p>
        </div>
        <div>
            <a href="{{ route('users.create') }}" 
               class="inline-flex items-center gap-2 bg-primary text-white hover:bg-primary/90 px-4 py-2.5 rounded-xl font-medium shadow-sm transition-all duration-200">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                <span>Add New Member</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-surface-container-low dark:bg-secondary-container/10 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
            <div class="p-3 bg-primary/10 text-primary rounded-lg">
                <span class="material-symbols-outlined">shield_person</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant dark:text-gray-400">Administrators</p>
                <p class="text-xl font-bold text-on-surface dark:text-white">{{ $users->where('role', 'admin')->count() }}</p>
            </div>
        </div>
        <div class="bg-surface-container-low dark:bg-secondary-container/10 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
            <div class="p-3 bg-secondary/10 text-secondary rounded-lg">
                <span class="material-symbols-outlined">lab_research</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant dark:text-gray-400">Pharmacists</p>
                <p class="text-xl font-bold text-on-surface dark:text-white">{{ $users->where('role', 'pharmacist')->count() }}</p>
            </div>
        </div>
        <div class="bg-surface-container-low dark:bg-secondary-container/10 p-4 rounded-xl border border-outline-variant/30 flex items-center gap-4">
            <div class="p-3 bg-tertiary/10 text-tertiary rounded-lg">
                <span class="material-symbols-outlined">point_of_sale</span>
            </div>
            <div>
                <p class="text-xs text-on-surface-variant dark:text-gray-400">Cashiers</p>
                <p class="text-xl font-bold text-on-surface dark:text-white">{{ $users->where('role', 'cashier')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-surface-container-low dark:bg-neutral-900/30 rounded-2xl border border-outline-variant/40 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container dark:bg-neutral-800/50 text-on-surface-variant dark:text-gray-300 border-b border-outline-variant/40 text-sm font-semibold">
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email Address</th>
                        <th class="px-6 py-4">Role / Permission</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-on-surface dark:text-gray-200 text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-surface-container-lowest dark:hover:bg-neutral-800/20 transition-colors duration-150">
                            <td class="px-6 py-4 font-medium text-base">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm uppercase">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-on-surface-variant dark:text-gray-400 font-mono">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Admin
                                    </span>
                                @elseif($user->role === 'pharmacist')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Pharmacist
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Cashier
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('users.edit', $user) }}" 
                                       class="p-1.5 text-on-surface-variant hover:text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                       title="Edit">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove this staff member?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-1.5 text-on-surface-variant hover:text-error hover:bg-error/10 rounded-lg transition-colors"
                                                    title="Delete">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-on-surface-variant dark:text-gray-500">
                                <span class="material-symbols-outlined text-4xl block mb-2">group_off</span>
                                No staff members registered yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection