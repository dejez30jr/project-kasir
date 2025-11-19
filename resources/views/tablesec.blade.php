<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

   @if (session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>nama</th>
                <th>email</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_post as $post)
            <tr>
                <td>{{ $post->nama }}</td>
                <td>{{ $post->email }}</td>
                <td>
                    <a href="{{ route('post.edit', $post->id) }}">Edit</a>
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')"  >
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td>data belum ada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>