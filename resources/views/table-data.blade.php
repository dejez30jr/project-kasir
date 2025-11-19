<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="background: rgb(32, 32, 32);" class="text-gray-800">

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#6366f1'
            });
        </script>
    @endif

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="shadow-xl shadow-3xl rounded-lg overflow-hidden">
            <div class="px-6 flex justify-between py-4 border-b border-gray-200">
                <h2 class="md:text-2xl font-semibold text-indigo-700">Rental Der</h2>
                <a href="/form"
                    class=" w-[fit-content] text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Buat
                    data</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="text-white">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Nama</th>
                            <th class="px-6 py-3 text-left font-semibold">Jenis PS</th>
                            <th class="px-6 py-3 text-left font-semibold">Jam Mulai</th>
                            <th class="px-6 py-3 text-left font-semibold">Jam Selesai</th>
                            <th class="px-6 py-3 text-left font-semibold">Total Bayar</th>
                            <th class="px-6 py-3 text-left font-semibold">Gambar</th>
                            <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-white divide-gray-100">
                        @forelse ($data_rental as $post)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->jenis_ps }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->jam_mulai }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $post->jam_selesai }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp
                                    {{ number_format($post->total_bayar, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $post->gambar) }}" alt="">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <a href="{{ route('rental.edit', $post->id) }}"
                                        class="inline-block bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Edit</a>
                                    <form action="{{ route('rental.destroy', $post->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin hapus?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Data rental belum
                                    tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
