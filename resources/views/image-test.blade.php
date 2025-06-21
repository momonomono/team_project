<!DOCTYPE html>
<html>
<head>
    <title>画像アップロードテスト</title>
</head>
<body>
    <h1>画像アップロードテスト（DB保存あり）</h1>

    <form method="POST" action="/image-test" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button type="submit">アップロード</button>
    </form>

    @if ($image && Storage::disk('public')->exists($image->path))
        <h2>保存された画像:</h2>
        <img src="{{ asset('storage/' . $image->path) }}" alt="example" width="300">
    @else
        <p>画像はまだ保存されていません。</p>
    @endif
</body>
</html>
