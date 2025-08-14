<x-app-layout>
    <div class="container ">
        <h1>編集</h1>

        {{-- 投稿フォーム --}}
        <form method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- タイトル --}}
            <label>
                <p>タイトル</p>
                <input type="text" name="title" 
                    value="{{ old('title', $article->title ?? '') }}"
                >
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </label>
            
            {{-- 画像 --}}
            <label>
                <p>画像</p>
                <div class="h-28 w-28 relative">
                    <input 
                        type="file" name="image_path" 
                        class="w-full h-full" id="js-edit-fileUploader"
                    >
                    <img
                        id="js-edit-image"
                        src="{{ asset('storage/'.$article->image_path ?? '') }}" 
                        class="w-full h-full absolute top-0 left-0"
                    >
                </div>
                @error('image_path')
                    <p>{{ $message }}</p>
                @enderror
            </label>
            
            {{-- カテゴリー --}}
            <label>
                <p>カテゴリー</p>
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->value }}" @selected(old('category_id', $article->category_id) == $category->value )>
                            {{ $category->label() }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p>{{ $message }}</p>
                @enderror
            </label>
        
            {{-- 詳細 --}}
            <label>
                <p>詳細</p>
                <textarea name="content">{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <p>{{ $message }}</p>
                @enderror
            </label>
        
            <button class="px-4 py-2 w-fit bg-gray-500 text-white">
                更新する
            </button>
        </form>

        <form method="POST" action="{{ route('delete.article' )}}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $article->id }}">
            <button type="submit" id="js-button-delete" class="px-4 py-2 w-fit bg-gray-500 text-white">
                削除する
            </button>
        </form>
    </div>
</x-app-layout>
