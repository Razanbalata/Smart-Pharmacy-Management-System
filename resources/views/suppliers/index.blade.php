@extends('layouts.pharma')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-6" dir="ltr">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 011-1v-4a1 1 0 011-1h2l4 4v3a1 1 0 01-1 1h-1m-6 0a1 1 0 001-1v-4h3m-5 4h5"></path>
                </svg>
                Suppliers
            </h1>
            <p class="text-sm text-gray-500 mt-1">Manage all wholesale suppliers, pharmaceutical companies, and contact records.</p>
        </div>
        
        <a href="{{ route('suppliers.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl transition-colors shadow-sm shadow-indigo-100 group">
            <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add New Supplier
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($suppliers->isEmpty())
            <div class="p-12 text-center text-gray-500">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 011-1v-4a1 1 0 011-1h2l4 4v3a1 1 0 01-1 1h-1m-6 0a1 1 0 001-1v-4h3m-5 4h5"></path>
                </svg>
                <p class="text-base font-medium text-gray-600">No suppliers found</p>
                <p class="text-sm text-gray-400 mt-1">Click the button above to register your first supplier profile.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Supplier Name</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Phone Number</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($suppliers as $supplier) {{-- استبدل هذا السطر بـ @foreach($suppliers as $supplier) الأصلي لديك --}}
                            <tr class="hover:bg-gray-50/70 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div class="font-semibold text-gray-900">{{ $supplier->name }}</div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1.5 text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span class="font-mono">{{ $supplier->phone ?? 'N/A' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 hover:bg-amber-50 text-gray-600 hover:text-amber-700 rounded-lg transition-colors border border-gray-200 hover:border-amber-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('suppliers.destroy', $supplier->id) }}" onsubmit="return confirm('Are you sure you want to delete this supplier? This action cannot be undone.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 hover:bg-red-50 text-gray-600 hover:text-red-700 rounded-lg transition-colors border border-gray-200 hover:border-red-200">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>

                                            
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                    
                </table>
@if(method_exists($suppliers, 'links') && $suppliers->hasPages())
            <div class="px-6 py-4 border-t border-outline-variant/40 bg-surface-container dark:bg-neutral-800/30">
                {{ $suppliers->appends(request()->query())->links() }}
            </div>
        @endif

            </div>
        @endif
    </div>
</div>
@endsection