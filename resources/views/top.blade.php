<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog Posts</title>
        <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    </head>
    <body>
        
        <main class="main-content">
            <!-- Search Section -->
            <div class="search-container">
                <form method="GET" action="{{ route('blog.index') }}" class="search-form">
                    <div class="search-input-wrapper">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search posts..."
                            class="search-input"
                            value="{{ request('search') }}"
                        >
                        
                        <!-- カテゴリー選択 -->
                        <select name="category" class="category-select">
                            <option value="">全てのカテゴリー</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->value }}" 
                                    {{ request('category') == $category->value ? 'selected' : '' }}>
                                    {{ $category->label() }}
                                </option>
                            @endforeach
                        </select>
                        
                        <button type="submit" class="search-button">
                            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </div>
                </form>
                
                <!-- アクティブなフィルターの表示 -->
                @if(request('search') || request('category'))
                    <div class="active-filters">
                        <span class="filter-label">アクティブなフィルター:</span>
                        
                        @if(request('search'))
                            <span class="filter-tag">
                                検索: "{{ request('search') }}"
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="remove-filter">×</a>
                            </span>
                        @endif
                        
                        @if(request('category'))
                            <span class="filter-tag">
                                カテゴリー: {{ App\Enums\Category::from(request('category'))->label() }}
                                <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="remove-filter">×</a>
                            </span>
                        @endif
                        
                        <a href="{{ route('blog.index') }}" class="clear-all-filters">全てクリア</a>
                    </div>
                @endif
            </div>
    
            <!-- Blog Posts Grid -->
            <div class="posts-grid">
                @if($posts->isEmpty())
                    <div class="no-posts">
                        @if(request('search') || request('category'))
                            <p>検索条件に一致する投稿が見つかりませんでした。</p>
                            <a href="{{ route('blog.index') }}" class="reset-search">全ての投稿を表示</a>
                        @else
                            <p>投稿がありません。</p>
                        @endif
                    </div>
                @else
                    @foreach($posts as $post)
                        <article class="post-card">
                            <div class="post-image">
                                @if(!empty($post->image_url))
                                    <img src="{{ $post->image_url }}" 
                                         alt="{{ $post->title }}">
                                @else
                                    <div class="placeholder-image"></div>
                                @endif
                            </div>
                            
                            <div class="post-content">
                                <h3 class="post-title">
                                    <a href="{{ route('post.show', $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                
                                <div class="post-excerpt">
                                    {{ Str::limit($post->detail, 100) }}
                                </div>
                                
                                <div class="post-meta">
                                    <span class="post-author">{{ $post->user->name ?? 'Unknown' }}</span>
                                    <span class="post-time">{{ $post->created_at->format('Y年m月d日') }}</span>
                                </div>
                                
                                <div class="post-category">
                                    {{ App\Enums\Category::from($post->category_id)->label() }}
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endif
            </div>
    
            <!-- Results Count -->
            @if($posts->isNotEmpty())
                <div class="results-info">
                    {{ $posts->total() }}件中 {{ $posts->firstItem() }}～{{ $posts->lastItem() }}件を表示
                </div>
            @endif
    
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
            
        </main>
    </body>
    </html>
    </x-app-layout>