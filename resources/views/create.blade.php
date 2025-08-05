<x-app-layout>
    <div class="container ">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <label>
                <p>タイトル</p>
                <input type="text" name="title" value="{{ old('title') }}">
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </label>
            
            <label>
                <p>画像</p>
                <input type="file" name="image_path">
                @error('image_path')
                    <p>{{ $message }}</p>
                @enderror
            </label>
            
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
