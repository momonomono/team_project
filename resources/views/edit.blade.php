<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 sm:p-8 mt-4">
        
            {{-- ページタイトル --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b-2 border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">投稿編集・削除</h1>
            </div>
            {{-- 投稿フォーム --}}
            <form method="POST" enctype="multipart/form-data" class>
                @csrf
                @method('PATCH')
                
                <article class="">
                    {{-- タイトル --}}
                    <label class="grid gap-4 mb-4">
                        <p>タイトル</p>
                        <input type="text" name="title" 
                            value="{{ old('title', $article->title ?? '') }}"
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>
                    
                    {{-- 画像 --}}
                    <article class="grid gap-4 mb-4">
                        <p>画像</p>
                        <article class="w-52 h-52 relative">
                            <div class="w-full h-full flex justify-center items-center bg-gray-600">
                                <p class="text-white">画像を追加する</p>
                            </div>
                            <label class="z-10 absolute top-0 left-0 w-52 h-52">
                                <input type="file" name="image_path" class="hidden" id="js-form-imagePath">
                            </label>
                            <img id="js-image" 
                                class="w-52 h-52 absolute top-0 left-0 object-cover"
                                src="{{ $article->image_path ?? '' }}"
                            >
                        </article>
                        @error('image_path')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </article>
                    
                    {{-- カテゴリー --}}
                    <label class="grid gap-4 mb-4">
                        <p>カテゴリー</p>
                        <select name="category_id" class="w-fit">
                            @foreach($categories as $category)
                                <option value="{{ $category->value }}" @selected(old('category_id', $article->category_id) == $category->value )>
                                    {{ $category->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>
                
                    {{-- 詳細 --}}
                    <label class="grid gap-4 mb-4">
                        <p>詳細</p>
                        <textarea name="content">{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>
                </article>
            
            <div class="grid gap-10">
                <button class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 w-20 rounded-lg transition duration-300 ease-in-out">
                    編集
                </button>
                </form>
    
                <form method="POST" action="{{ route('delete.article') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $article->id }}">
                    <button 
                        class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 w-20 rounded-lg transition duration-300 ease-in-out"
                        id="js-button-delete"    
                    >
                        削除
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
