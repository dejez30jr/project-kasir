<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Produk - Kasir Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <div class="min-h-screen p-4 md:p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow p-6">

      {{-- Header --}}
      <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
          <h1 class="text-2xl font-bold text-emerald-700">Data Produk</h1>
          <p class="text-sm text-gray-500">Kelola daftar barang untuk sistem kasir Anda</p>
        </div>
        <div class="flex gap-2">
        <a onclick="openModal(true)"
           class="mt-3 md:mt-0 inline-flex items-center gap-2 bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition">
          ➕ Tambah Produk
        </a>
        <a href="/kasir"
           class="mt-3 md:mt-0 inline-flex items-center gap-2 bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition">
           kembali
        </a>
        </div>
      </div>

      {{-- Table Responsive --}}
      <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm">
          <thead class="bg-emerald-100 text-emerald-800">
            <tr>
              <th class="px-4 py-3 text-left">#</th>
              <th class="px-4 py-3 text-left">Gambar</th>
              <th class="px-4 py-3 text-left">Nama Produk</th>
              <th class="px-4 py-3 text-right">Harga</th>
              <th class="px-4 py-3 text-center">Stok</th>
              <th class="px-4 py-3 text-center">Diskon</th>
              <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($products as $index => $product)
              <tr class="border-b hover:bg-gray-50 transition">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3">
                  @if($product->image)
                    <img src="{{ asset('storage/'. $product->image) }}" class="w-16 h-16 rounded-md object-cover border">
                  @else
                    <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-md text-gray-400">No Img</div>
                  @endif
                </td>
                <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                <td class="px-4 py-3 text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-4 py-3 text-center">{{ $product->stock }}</td>
                <td class="px-4 py-3 text-center">{{ $product->discount }}%</td>
                <td class="px-4 py-3 text-center space-x-2">
                  <a href=""
                     class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">Edit</a>
                  <form action="{{ route('post.delete', $product->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-6 text-gray-500">Belum ada data produk.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- Footer --}}
      <div class="mt-6 text-sm text-gray-500 text-center">
        © {{ date('Y') }} Sistem Kasir Deris — All rights reserved.
      </div>
    </div>
  </div>

   <!-- Modal Popup -->
  <div id="modalForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 relative">
      <h3 class="text-xl font-bold text-gray-800 mb-4">Tambah Barang</h3>

      <form action="{{ route('create.produk') }}" method="post" enctype="multipart/form-data" class="space-y-3">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
          <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Kategori</label>
          <input type="text" name="kategori" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Harga</label>
          <input type="number" name="price" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" required />
        </div>
        <div>
          <label for="image">Gambar</label>
          <input type="file" name="image">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Stok</label>
          <input type="number" name="stock" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500" required />
        </div>

        <div class="flex justify-end gap-3 pt-3">
          <button type="button" onclick="openModal(false)" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
            Batal
          </button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function openModal(show) {
    document.getElementById('modalForm').classList.toggle('hidden', !show);
  }
</script>

</body>
</html>
