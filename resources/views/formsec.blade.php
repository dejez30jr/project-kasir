<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @if (session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif
    <form action="{{ route('post.data') }}" method="pOST">
        @csrf
        <input type="nama" name="nama" placeholder="Masukkan Nama">
        <input type="email" name="email" placeholder="Masukkan Email">
        <button type="submit">Kirim</button>
    </form>
</body>
</html>