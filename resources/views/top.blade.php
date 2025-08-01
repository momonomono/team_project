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
            <form method="GET" action="" class="search-form">
                <div class="search-input-wrapper">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search"
                        class="search-input"
                    >
                    {{-- <select name="category">
                        <option value="">全てのカテゴリー</option>
                        <option value="1" {{ request('category') == '1' ? 'selected' : '' }}>絶景ドライブコース</option>
                        <option value="2" {{ request('category') == '2' ? 'selected' : '' }}>ロードトリップのコツ</option>
                    </select> --}}
                    <button type="submit" class="search-button">
                        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                </div>
                {{-- <?php if (isset($_GET['page'])): ?>
                    <input type="hidden" name="page" value="<?php echo $current_page; ?>">
                <?php endif; ?> --}}
            </form>
        </div>

        <!-- Blog Posts Grid -->
        <div class="posts-grid">
            @if(empty($posts))
                <div class="no-posts">
                    <p>No posts found.</p>
                </div>
            @else
                @foreach($posts as $post)
                    <article class="post-card">
                        <div class="post-image">
                            @if(!empty($post['image_url']))
                                <img src="{{ $post['image_url'] }}" 
                                     alt="{{ $post['title'] }}">
                            @else
                                <div class="placeholder-image"></div>
                            @endif
                        </div>
                        
                        <div class="post-content">
                            <h3 class="post-title">
                                <a href="/post/{{ $post['id'] }}">
                                    {{ $post['title'] }}
                                </a>
                            </h3>
                            
                            <div class="post-meta">
                                <span class="post-author">{{ $post['user_id'] }}</span>
                                <span class="post-time">{{ $post['created_at'] }}</span>
                            </div>
                            
                            <div class="post-category">
                                {{ App\Enums\Category::from($post['category_id'])->label() }}
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
        
    </main>
</body>
</html>
</x-app-layout>