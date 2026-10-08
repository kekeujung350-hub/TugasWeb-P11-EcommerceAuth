<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Admin</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach (['Users' => $users, 'Produk' => $products, 'Order' => $orders, 'Post' => $posts] as $label => $count)
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold">{{ $count }}</p>
                    <p class="text-sm text-gray-500">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
