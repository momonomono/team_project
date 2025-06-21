<!DOCTYPE html>
<html>
<head>
    <title>画像アップロードテスト</title>
</head>
<body>
    <h1>画像アップロードテスト</h1>

    <form method="POST" action="/image-test" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button type="submit">アップロード</button>
    </form>

    @if ($imageExists)
        <h2>保存された画像:</h2>
        <img src="{{ asset('storage/images/example.jpg') }}" alt="example" width="300">
    @else
        <p>画像はまだ保存されていません。</p>
    @endif
</body>
</html>
