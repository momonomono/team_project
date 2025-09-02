<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
        <!-- ブログタイトル -->
        <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>

        <!-- 画像 -->
        @if ($article->image_path)
            <div class="mb-4">
                <img src="{{ $article->image_path }}" alt="サンプル画像" class="w-full rounded-lg">
            </div>
        @endif

        <!-- カテゴリー -->
        <div class="text-sm text-gray-500 mb-2">
            カテゴリー: <span class="font-semibold">{{ $article->category_id->label() }}</span>
        </div>

        <!-- 本文 -->
        <div class="text-gray-700 leading-relaxed mb-8">
            {!! nl2br(e($article->content)) !!}
        </div>

        <!-- コメントセクション -->
        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-4">コメント</h2>

            <!-- コメント投稿フォーム（ログインユーザーのみ） -->
            @auth
                <form action="{{ route('comments.store', $article->id) }}" method="POST" class="flex">
                    @csrf
                    <input type="text" name="comment" placeholder="コメントを入力してください" class="w-full border rounded-l-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">投稿</button>
                </form>
                <!-- バリデーションエラーメッセージ -->
                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            @endauth

            <!-- コメントリスト -->
            <div class="mt-4 space-y-4">
                
                @forelse ($article->comments as $comment)
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="text-gray-800">{{ $comment->content }}</p>
                        <div class="text-sm text-gray-500 mt-1">
                            {{ $comment->user->name }} ・ {{ $comment->created_at->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="text-gray-800">まだコメントはありません</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
