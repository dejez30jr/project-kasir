<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="{{ route('post.update', $data_old->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input value="{{ old('nama', $data_old->nama) }}" type="nama" name="nama" placeholder="Masukkan Nama">
        <input value="{{ old('email', $data_old->email) }}" type="email" name="email" placeholder="Masukkan Email">
        <button type="submit">Kirim</button>
    </form>
</body>
</html>