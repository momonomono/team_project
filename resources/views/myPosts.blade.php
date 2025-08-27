<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- メインコンテンツ -->
        <main class="bg-white rounded-lg shadow-md p-6 sm:p-8">
            <!-- ヘッダーセクション -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b-2 border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">自分の投稿</h1>
                <a href="{{ route('create.article') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                    新規作成
                </a>
            </div>

            <!-- 投稿グリッド -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
                @foreach($myPosts as $myPost)
                    <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:transform hover:-translate-y-1 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <!-- 画像 -->
                        <div class="aspect-w-16 aspect-h-9">
                            @if($myPost->image_path)
                                <img src="{{ $myPost->image_path }}" alt="サンプル画像" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- コンテンツ -->
                        <div class="p-5">
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $myPost->title }}</h3>
                            <div class="flex flex-wrap items-center gap-2 mb-4 text-sm text-gray-600">
                                <span class="font-medium">{{ $myPost->user->name }}</span>
                                <span class="text-gray-400">•</span>
                                <span>{{ $myPost->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div class="mt-3">
                                <span class="inline-block bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $myPost->category_id->label() }}
                                </span>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('edit.article', $myPost->id) }}" 
                                   class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                                    編集
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- ページネーション -->
            <div class="mt-10 pt-8 border-t border-gray-200">
                {{ $myPosts->links() }}
            </div>
        </main>
    </div>
</x-app-layout>
