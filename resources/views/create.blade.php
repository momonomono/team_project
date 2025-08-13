<x-app-layout>
    <div class="container ">
        <form method="POST" enctype="multipart/form-data">
            @csrf

            {{-- タイトル --}}
            <label>
                <p>タイトル</p>
                <input type="text" name="title" value="{{ old('title') }}">
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </label>
            
            {{-- 画像 --}}
            <label>
                <p>画像</p>
                <article class="w-52 h-52 bg-gray-500 relative flex justify-center items-center">
                    <div>
                        <p class="text-white">ここにドラッグしてください</p>
                    </div>
                    <input type="file" name="image_path" class="w-fit h-fit hidden" id="js-form-imagePath">
                    <img id="js-image" class="w-52 h-52 absolute top-0 left-0 hidden">
                </article>
                @error('image_path')
                    <p>{{ $message }}</p>
                @enderror
            </label>
            
            {{-- カテゴリー --}}
            <label>
                <p>カテゴリー</p>
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->value }}" @selected(old('category_id') == $category->value )>
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
                <textarea name="content">{{ old('content') }}</textarea>
                @error('content')
                    <p>{{ $message }}</p>
                @enderror
            </label>
        
            <button class="px-4 py-2 w-fit bg-gray-500 text-white">
                送信する
            </button>
        </form>
    </div>
</x-app-layout>
