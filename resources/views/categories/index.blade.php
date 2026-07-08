@extends('layouts.pharma')

@section('content')
<div class="container mx-auto px-4 py-6 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 tracking-wide">Categories</h1>
            <p class="text-sm text-gray-500 mt-1">Manage and organize pharmacy item classifications.</p>
        </div>
        
        <div class="flex items-center">
            <a href="{{ route('categories.create') }}" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-sm hover:shadow transition duration-200 flex items-center justify-center gap-2 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Category
            </a>
        </div>
    </div>

    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
        <form method="GET" action="{{ route('categories.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative w-full sm:flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search categories by name..."
                    class="w-full pl-10 pr-4 py-2 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                >
                
                @if(request('search'))
                    <a href="{{ route('categories.index') }}" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.416l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full sm:w-auto bg-gray-900 hover:bg-gray-800 text-white font-medium text-sm py-2 px-5 rounded-xl transition duration-150 shadow-sm">
                Search
            </button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left">
                <thead class="bg-gray-50/70">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Category Name</th>
                        <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-150">
                    @forelse ($categories as $category)
                        <tr id="category-{{ $category->id }}"
                                class="
hover:bg-surface-container-lowest 
dark:hover:bg-neutral-800/20 
transition-all 
duration-300

@if (request('highlight') == $category->id) bg-primary/10
ring-2
ring-primary
shadow-lg @endif
"><td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-950">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition duration-150 text-xs font-semibold">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition duration-150 text-xs font-semibold">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-12 text-center text-sm text-gray-500">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>No categories found {{ request('search') ? 'matching "' . request('search') . '"' : '' }}.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($categories, 'links') && $categories->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $categories->appends(['search' => request('search')])->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const highlightId = "{{ request('highlight') }}";
        if (highlightId) {
            const row = document.getElementById(`category-${highlightId}`);
            if (row) {
                row.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

@endsection