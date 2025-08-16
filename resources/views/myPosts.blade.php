<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- メインコンテンツ -->
        <main class="bg-white rounded-lg shadow-md p-6 sm:p-8">
            <!-- ヘッダーセクション -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-6 border-b-2 border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Your Posts</h1>
            </div>

            <!-- 投稿グリッド -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
                @foreach($myPosts as $myPost)
                    <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:transform hover:-translate-y-1 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <!-- 画像プレースホルダー -->
                        <div class="w-full h-48 bg-gray-100">
                            <div class="w-full h-full bg-gray-300 bg-opacity-50" 
                                style="background-image: repeating-linear-gradient(45deg, #d1d5db 0, #d1d5db 10px, transparent 10px, transparent 20px), repeating-linear-gradient(-45deg, #d1d5db 0, #d1d5db 10px, transparent 10px, transparent 20px);">
                            </div>
                        </div>
                        
                        <!-- コンテンツ -->
                        <div class="p-5">
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $myPost->title }}</h3>
                            
                            <!-- メタ情報 -->
                            <div class="flex flex-wrap items-center gap-2 mb-4 text-sm text-gray-600">
                                <span class="font-medium">{{ $myPost->user->name }}</span>
                                <span class="text-gray-400">•</span>
                                <span>{{ $myPost->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            
                            <!-- カテゴリ -->
                            <div class="mt-3">
                                <span class="inline-block bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ App\Enums\Category::from($myPost->category_id)->label() }}
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- ページネーション -->
            <div class="mt-10 pt-8 border-t border-gray-200">
                <div class="pagination-custom space-y-4">
                    {{ $myPosts->links() }}
                </div>
            </div>
        </main>
    </div>
</x-app-layout>