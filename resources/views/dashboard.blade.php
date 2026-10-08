<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <p>Halo, <strong>{{ auth()->user()->name }}</strong>!
                   Role Anda: <span class="px-2 py-1 text-xs rounded bg-indigo-100 text-indigo-700">{{ auth()->user()->role }}</span></p>

                <ul class="list-disc ml-5 space-y-1 text-sm">
                    <li><a class="text-indigo-600 hover:underline" href="{{ route('products.index') }}">Lihat produk (publik)</a></li>
                    <li><a class="text-indigo-600 hover:underline" href="{{ route('posts.index') }}">Daftar post (semua user login)</a></li>
                    @can('create', App\Models\Post::class)
                        <li><a class="text-indigo-600 hover:underline" href="{{ route('posts.create') }}">Buat post baru (admin &amp; editor)</a></li>
                    @endcan
                    @if (auth()->user()->isAdmin())
                        <li><a class="text-indigo-600 hover:underline" href="{{ route('admin.dashboard') }}">Panel admin (khusus admin)</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
