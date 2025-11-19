<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>POS - Kasir</title>
    {{-- Pastikan Tailwind sudah di-build melalui Vite (Laravel 11) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* sedikit shadow dan rounded yang konsisten */
        .card-shadow {
            box-shadow: 0 6px 18px rgba(20, 20, 20, 0.06);
        }
    </style>
</head>

<body class="bg-gray-50 text-slate-900">
    <div class="min-h-screen p-4 md:p-8">
        <div class="max-w-[1400px] mx-auto">
            {{-- Top bar --}}
            <header class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold">Kasir DZ</h1>
                        <p class="text-sm text-slate-500">Jakpus</p>
                    </div>

                    <div class="flex items-center gap-4">


                        <div class="flex items-center gap-3">
                            <div class="text-sm text-slate-600">Admin<br /><span
                                    class="text-xs text-slate-400">Logout</span></div>
                            <div class="w-10 h-10 rounded-full bg-emerald-200 flex items-center justify-center">MN</div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Layout main: grid -> content + sidebar --}}
            <main class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                {{-- Left content (menu) --}}
                <section class="lg:col-span-9 space-y-4">

                    {{-- category pills --}}
                    <div class="flex flex-wrap gap-3">
                        <button class="px-4 py-2 rounded-full border border-slate-200 bg-white"><a href="{{ route('post.kategori', 'Makanan') }}">Makanan</a></button>
                        <button class="px-4 py-2 rounded-full border border-slate-200 bg-white"><a href="{{ route('post.kategori', 'Minuman') }}">Minuman</a></button>
                        <div class="relative w-full max-w-[420px] md:max-w-[520px]">
                            <input placeholder="Search menu"
                                class="w-full pl-4 pr-10 py-3 rounded-full border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-300" />
                            <button class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full">
                                🔍
                            </button>
                        </div>
                    </div>

                    {{-- hero row cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        <a href="{{ route('show.table') }}">
                            <div class="card-shadow text-center rounded-lg overflow-hidden bg-white p-4">
                                <div class="text-xl font-semibold">Buat Mwnu Baru</div>
                                <p class="text-sm text-slate-500">Klik disini</p>
                            </div>
                        </a>
                        <!-- <div class="card-shadow text-center rounded-lg overflow-hidden bg-white p-4">
              <div class="text-xl font-semibold">Minuman</div>
              <p class="text-sm text-slate-500">Order Now</p>
            </div> -->
                    </div>

                    {{-- product grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        @foreach($kategoriProducts as $post)
                        <div class="card-shadow rounded-lg bg-white p-4 flex flex-col justify-between">
                            <div>
                                <div
                                    class="h-40 w-full bg-slate-100 rounded-md mb-3 flex items-center justify-center text-slate-400">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full" alt="">
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-semibold">{{ $post->name }}</h3>
                                        <b class="font-semibold">{{ $post->kategori }}</b>
                                        <div class="text-lg font-bold mt-1">Rp.{{ $post->price }}</div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button
                                            class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center">-</button>
                                        <input value="{{ old('stock', $post->stock) }}" readonly
                                            class="w-12 text-center rounded-md border border-slate-200 py-1" />
                                        <button data-action="increment"
                                            class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 flex items-center justify-between">
                                <button data-id="{{ $post->id }}"
                                    class="btn-add px-3 py-2 rounded-md border border-emerald-500 bg-emerald-50 text-emerald-600">
                                    Add
                                </button>
                                <div class="text-xs text-slate-400">50% OFF</div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </section>

                {{-- Right sidebar (order summary) --}}
                <aside class="lg:col-span-3">
                    <div class="card-shadow rounded-lg bg-white p-4 sticky top-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h4 class="font-semibold">Order Summary</h4>
                                <div class="text-xs text-slate-400">Order ID 2091213</div>
                            </div>
                            <button class="p-2 rounded-md border border-slate-200">↻</button>
                        </div>

                        @php
                        $cart = session('cart', []) ?? [];
                        // pastikan fallback untuk struktur lama:
                        foreach ($cart as $id => $it) {
                        $qty = $it['quantity'] ?? $it['qty'] ?? $it['jumlah'] ?? 1;
                        $price = $it['price'] ?? 0;
                        $cart[$id]['quantity'] = (int)$qty;
                        $cart[$id]['price'] = (int)$price;
                        }
                        $subtotal = 0;
                        @endphp

                        <div class="space-y-3 mb-4 max-h-64 overflow-auto pr-2" id="order-list">
                            @forelse ($cart as $id => $item)
                            @php
                            $line = $item['price'] * $item['quantity'];
                            $subtotal += $line;
                            @endphp

                            <div class="flex items-center justify-between bg-slate-50 p-3 rounded-md"
                                data-id="{{ $id }}">
                                <div>
                                    <div class="font-medium">{{ $item['name'] ?? 'Unnamed' }}</div>
                                    <div class="text-sm text-slate-500">Rp.{{ number_format($line,0,',','.') }}</div>
                                    <div class="text-xs">x<span class="item-qty">{{ $item['quantity'] }}</span></div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="decrease text-sm px-2 py-1" data-id="{{ $id }}">-</button>
                                    <button class="increase text-sm px-2 py-1" data-id="{{ $id }}">+</button>
                                    <button class="remove text-red-500 ml-2" data-id="{{ $id }}">🗑</button>
                                </div>
                            </div>
                            @empty
                            <p class="text-center text-slate-400 text-sm">Belum ada pesanan</p>
                            @endforelse
                        </div>

                        @php
                        $tax = $subtotal * 0.1;
                        $total = $subtotal + $tax;
                        @endphp

                        <div class="border-t pt-4" id="summary-block">
                            <div class="flex justify-between text-sm text-slate-600">
                                <div>Price</div>
                                <div id="subtotal-text">Rp.{{ number_format($subtotal,0,',','.') }}</div>
                            </div>
                            <div class="flex justify-between text-sm text-slate-600">
                                <div>Taxes</div>
                                <div>10%</div>
                            </div>
                            <div class="flex justify-between text-lg font-semibold mt-2">
                                <div>Total</div>
                                <div id="total-text">Rp.{{ number_format($total,0,',','.') }}</div>
                            </div>
                        </div>

                        <button class="w-full mt-4 py-3 rounded-md bg-emerald-600 text-white font-semibold">Confirm
                            Order</button>
                    </div>

        </div>
        </aside>
        </main>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrf = '{{ csrf_token() }}';

            async function postJSON(url, data) {
                const res = await fetch(url, {
                    method: data ? 'POST' : 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: data ? JSON.stringify(data) : null
                });
                return res.json();
            }

            // tombol Add pada produk: pastikan tombol memiliki class .btn-add dan data-id
            document.querySelectorAll('.btn-add').forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    const id = btn.dataset.id;
                    const data = await postJSON(`/cart/add/${id}`, {});
                    refreshUI(data.cart);
                });
            });

            // increase / decrease / remove di sidebar
            document.body.addEventListener('click', async (e) => {
                if (e.target.matches('.increase')) {
                    const id = e.target.dataset.id;
                    // ambil qty sekarang di DOM
                    const parent = document.querySelector(`[data-id="${id}"]`);
                    const qtyEl = parent?.querySelector('.item-qty');
                    const qty = qtyEl ? parseInt(qtyEl.textContent || '1') + 1 : 1;
                    const data = await postJSON(`/cart/update/${id}`, { quantity: qty });
                    refreshUI(data.cart);
                }

                if (e.target.matches('.decrease')) {
                    const id = e.target.dataset.id;
                    const parent = document.querySelector(`[data-id="${id}"]`);
                    const qtyEl = parent?.querySelector('.item-qty');
                    const qtyNow = qtyEl ? parseInt(qtyEl.textContent || '1') : 1;
                    const qty = Math.max(0, qtyNow - 1);
                    const data = await postJSON(`/cart/update/${id}`, { quantity: qty });
                    refreshUI(data.cart);
                }

                if (e.target.matches('.remove')) {
                    const id = e.target.dataset.id;
                    const res = await fetch(`/cart/remove/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        }
                    });
                    const data = await res.json();
                    refreshUI(data.cart);
                }
            });

            function refreshUI(cart) {
                // rebuild order-list and summary
                const orderList = document.getElementById('order-list');
                const subtotalText = document.getElementById('subtotal-text');
                const totalText = document.getElementById('total-text');

                let html = '';
                let subtotal = 0;
                for (const [id, item] of Object.entries(cart || {})) {
                    const qty = item.quantity ?? item.qty ?? 1;
                    const price = Number(item.price ?? 0);
                    const line = price * qty;
                    subtotal += line;
                    html += `
        <div class="flex items-center justify-between bg-slate-50 p-3 rounded-md" data-id="${id}">
          <div>
            <div class="font-medium">${item.name ?? 'Unnamed'}</div>
            <div class="text-sm text-slate-500">Rp.${line.toLocaleString('id-ID')}</div>
            <div class="text-xs">x<span class="item-qty">${qty}</span></div>
          </div>
          <div class="flex items-center gap-2">
            <button class="decrease text-sm px-2 py-1" data-id="${id}">-</button>e
            <button class="increase text-sm px-2 py-1" data-id="${id}">+</button>
            <button class="remove text-red-500 ml-2" data-id="${id}">🗑</button>
          </div>
        </div>
      `;
                }

                orderList.innerHTML = html || '<p class="text-center text-slate-400 text-sm">Belum ada pesanan</p>';
                const tax = subtotal * 0.1;
                const total = subtotal + tax;
                subtotalText.textContent = 'Rp.' + subtotal.toLocaleString('id-ID');
                totalText.textContent = 'Rp.' + total.toLocaleString('id-ID');
            }

        });
    </script>

</body>

</html>