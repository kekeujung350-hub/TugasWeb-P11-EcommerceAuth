<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Online - Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<header class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('products.index') }}" class="text-xl font-bold">🛒 Toko Online</a>
        <nav class="flex gap-4 text-sm">
            <a href="{{ route('products.eager-demo') }}" class="hover:underline">Demo Eager Loading</a>
            @auth
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard ({{ auth()->user()->role }})</a>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </nav>
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-6">
    <form method="GET" class="mb-6 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari produk..."
               class="flex-1 rounded border-gray-300 px-3 py-2 border">
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Cari</button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @forelse ($products as $product)
            <div class="bg-white rounded shadow p-4 flex flex-col">
                <span class="text-xs text-indigo-600 font-semibold">{{ $product->category->name }}</span>
                <h2 class="font-semibold mt-1">{{ $product->name }}</h2>
                <p class="text-lg font-bold mt-2">{{ $product->formatted_price }}</p>
                <p class="text-xs text-gray-500 mt-auto pt-2">Stok: {{ $product->stock }}</p>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Produk tidak ditemukan.</p>
        @endforelse
    </div>

    <div class="mt-6">{{ $products->links() }}</div>
</main>
</body>
</html>
