<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Rental PS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body
    class="bg-[url('https://tse1.mm.bing.net/th/id/OIP.kJEjMZXNJzmL3CLdRLEnogHaEK?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3')] bg-center bg-cover backdrop-blur-lg min-h-screen flex items-center justify-center p-4">

    <!-- ======= ini form isi data nye ========== -->
    <form class="w-full max-w-xl bg-white p-8 rounded-xl shadow-xl border border-gray-200"
        action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Form Rental PS</h2>

          <div>
                <label for="">Gambar struk</label>
                <input type="file" name="gambar">
            </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penyewa</label>
            <input type="text" name="nama"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Contoh: Budi Santoso" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis PS</label>
            <select name="jenis_ps"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option>PS3</option>
                <option>PS4</option>
                <option>PS5</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                <input type="time" name="jam_mulai"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                <input type="time" name="jam_selesai"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Total Bayar (Rp)</label>
            <input type="number" name="total_bayar"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Contoh: 50000" />
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition duration-200">
                Simpan Data
            </button>
            <button
                class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition duration-200">
                <a href="{{ route('table.data') }}">
                    Batal
                </a>
            </button>
        </div>
    </form>

    <!-- ====== ini js ny ye ======= -->
    <script>
        const jamMulai = document.querySelector('input[name="jam_mulai"]');
        const jamSelesai = document.querySelector('input[name="jam_selesai"]');
        const totalBayar = document.querySelector('input[name="total_bayar"]');
        const hargaPerJam = 10000;

        function hitungTotalBayar() {
            if (jamMulai.value && jamSelesai.value) {
                const [mulaiJam, mulaiMenit] = jamMulai.value.split(':').map(Number);
                const [selesaiJam, selesaiMenit] = jamSelesai.value.split(':').map(Number);

                const mulai = new Date();
                mulai.setHours(mulaiJam, mulaiMenit);

                const selesai = new Date();
                selesai.setHours(selesaiJam, selesaiMenit);

                const durasiMs = selesai - mulai;
                const durasiJam = durasiMs / (1000 * 60 * 60);

                if (durasiJam > 0) {
                    totalBayar.value = Math.ceil(durasiJam) * hargaPerJam;
                } else {
                    totalBayar.value = 0;
                }
            }
        }

        jamMulai.addEventListener('change', hitungTotalBayar);
        jamSelesai.addEventListener('change', hitungTotalBayar);
    </script>
</body>

</html>
