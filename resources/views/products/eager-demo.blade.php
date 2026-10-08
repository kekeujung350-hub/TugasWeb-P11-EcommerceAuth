<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo Eager Loading</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<main class="max-w-4xl mx-auto px-4 py-8">
    <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline">&larr; Kembali</a>
    <h1 class="text-2xl font-bold mt-2">Demo: Lazy Loading (N+1) vs Eager Loading</h1>
    <p class="text-sm text-gray-600 mb-6">Mengambil 10 produk lalu menampilkan nama kategori masing-masing.</p>

    <div class="grid md:grid-cols-2 gap-4">
        <section class="bg-white rounded shadow p-4">
            <h2 class="font-semibold text-red-600">Lazy loading: {{ $lazy->count() }} query</h2>
            <code class="text-xs block mt-1">Product::available()->take(10)->get()</code>
            <ol class="list-decimal ml-5 mt-3 text-xs space-y-1">
                @foreach ($lazy as $q)
                    <li>{{ $q['query'] }}</li>
                @endforeach
            </ol>
        </section>

        <section class="bg-white rounded shadow p-4">
            <h2 class="font-semibold text-green-600">Eager loading: {{ $eager->count() }} query</h2>
            <code class="text-xs block mt-1">Product::with('category')->available()->take(10)->get()</code>
            <ol class="list-decimal ml-5 mt-3 text-xs space-y-1">
                @foreach ($eager as $q)
                    <li>{{ $q['query'] }}</li>
                @endforeach
            </ol>
        </section>
    </div>
</main>
</body>
</html>
