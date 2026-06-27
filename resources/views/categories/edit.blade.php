@extends('layouts.pharma')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 tracking-wide">Edit Category</h1>
        <a href="{{ route('categories.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition duration-150 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
        <form method="POST" action="{{ route('categories.update', $category->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Category Name</label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    value="{{ old('name', $category->name) }}"
                    placeholder="e.g., Antibiotics" 
                    class="w-full px-4 py-2.5 rounded-lg border @error('name') border-red-500 bg-red-50 @else border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @enderror text-gray-900 placeholder-gray-400 focus:outline-none transition duration-150"
                    required
                >
                @error('name')
                    <p class="text-sm text-red-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea 
                    id="description"
                    name="description" 
                    rows="4"
                    placeholder="Brief description of the category..." 
                    class="w-full px-4 py-2.5 rounded-lg border @error('description') border-red-500 bg-red-50 @else border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 @enderror text-gray-900 placeholder-gray-400 focus:outline-none transition duration-150"
                >{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-red-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 font-semibold text-gray-700 hover:bg-gray-50 transition duration-150 text-sm">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 font-semibold text-white shadow-md transition duration-200 text-sm">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection