<x-app-layout>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Posts</title>
        <link rel="stylesheet" href="{{ asset('css/myPosts.css') }}">
    </head>
    <body>
        <div class="container">
            <!-- メインコンテンツ -->
            <main class="main-content">
                <!-- ヘッダーセクション -->
                <div class="content-header">
                    <h1 class="page-title">Your Post</h1>
                </div>
    
                <!-- 投稿グリッド -->
                <div class="posts-grid">
                    @foreach($myPosts as $myPost)
                    <article class="post-card">
                        <div class="post-image">
                            <div class="placeholder-image"></div>
                        </div>
                        <div class="post-content">
                            <h3 class="post-title">{{ $myPost->title }}</h3>
                            <div class="post-meta">
                                <span class="post-author">{{ $myPost->user->name }}</span>
                                <span class="post-time">{{ $myPost->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div class="post-category">
                                <span class="category-tag">{{ $myPost->category_id }}</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
    
                <!-- ページネーション -->
                {{-- <div class="pagination-wrapper">
                    <nav class="pagination">
                        <button class="pagination-btn prev-btn">Previous Page</button>
                        
                        <div class="page-numbers">
                            @for($page = 1; $page <= 10; $page++)
                            <button class="page-number {{ $page == 1 ? 'active' : '' }}">{{ $page }}</button>
                            @endfor
                        </div>
                        
                        <button class="pagination-btn next-btn">Next Page</button>
                    </nav>
                </div> --}}
            </main>
        </div>
    </body>
    </html>
</x-app-layout>