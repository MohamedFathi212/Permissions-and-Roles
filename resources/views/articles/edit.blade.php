<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Articles / Edit
            </h2>
            <a href="{{ route('articles.index') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('articles.update', $article->id) }}" method="post">
                        @csrf
                        {{-- Title Field --}}
                        <div class="mb-6">
                            <label for="title" class="block text-lg font-medium mb-2">Title</label>
                            <input  name="title" id="title" value="{{old("title",$article->title) }}"
                                type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg text-black">
                            @error('title')
                                <p class="text-red-400 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Text Field --}}
                        <div class="mb-6">
                            <label for="text" class="block text-lg font-medium mb-2">Content</label>
                            <textarea name="text" id="text"
                                class="border-gray-300 shadow-sm w-1/2 rounded-lg text-black" cols="30"
                                rows="10">{{ old("text",$article->text) }}</textarea>
                            @error('text')
                                <p class="text-red-400 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Author Field --}}
                        <div class="mb-6">
                            <label for="author" class="block text-lg font-medium mb-2">Author</label>
                            <input  name="author" id="author" value="{{ old("author",$article->author) }}"
                                type="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg text-black">
                            @error('author')
                                <p class="text-red-400 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="bg-slate-700 hover:bg-slate-500 text-sm rounded-md text-white px-5 py-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>