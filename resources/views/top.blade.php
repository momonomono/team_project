<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- メインコンテンツ -->
        <main class="bg-white rounded-lg shadow-md p-6 sm:p-8">
            <!-- ヘッダーセクション -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b-2 border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">投稿一覧</h1>
            </div>

            <!-- Search Section -->
            <div class="mb-8">
                <form method="GET" action="{{ route('top') }}" class="space-y-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="ポストを検索"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-colors"
                                value="{{ request('search') }}"
                            >
                        </div>
                        <div class="sm:w-48">
                            <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-colors bg-white">
                                <option value="">全てのカテゴリー</option>
                                @foreach(Category::cases() as $category) 
                                    <option value="{{ $category->value }}" {{ request('category') == $category->value ? 'selected' : '' }}>
                                        {{ $category->label() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors inline-flex items-center justify-center">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <span class="ml-2 hidden sm:inline">検索</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Blog articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if($articles->isEmpty())
                    <div class="col-span-full text-center py-12">
                        <p class="text-lg font-medium text-gray-500">投稿がありません。</p>
                    </div>
                @else
                    @foreach($articles as $article)
                        <a href="{{ route('post.show', $article->id)}}">
                            <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
                                <div class="aspect-w-16 aspect-h-9">
                                    @if($article->image_path)
                                        <img src="{{ $article->image_path }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition-colors line-clamp-2 leading-tight mb-2">
                                        {{ $article->title }}
                                    </h2>
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($article->detail, 50) }}</p>
                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                        <span class="font-medium">{{ $article->user->name ?? 'Unknown' }}</span>
                                        <time class="text-gray-400">{{ $article->created_at->format('Y年m月d日') }}</time>
                                    </div>
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full">
                                        {{ $article->category_id->label() }}
                                    </span>
                                </div>
                            </article>
                        </a>
                    @endforeach
                @endif
            </div>

            <!-- ページネーション -->
            <div class="mt-10 pt-8 border-t border-gray-200">
                {{ $articles->links() }}
            </div>
        </main>
    </div>
</x-app-layout>
