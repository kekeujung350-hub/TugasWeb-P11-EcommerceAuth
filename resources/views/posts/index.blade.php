<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Post</h2>
            @can('create', App\Models\Post::class)
                <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">+ Post Baru</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            @foreach ($posts as $post)
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-lg">{{ $post->title }}</h3>
                    <p class="text-xs text-gray-500 mb-2">oleh {{ $post->user->name }} ({{ $post->user->role }}) &middot; {{ $post->created_at->diffForHumans() }}</p>
                    <p class="text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($post->body, 200) }}</p>

                    <div class="mt-3 flex gap-3">
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="text-sm text-indigo-600 hover:underline">Edit</a>
                        @endcan
                        @can('delete', $post)
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Hapus post ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm text-red-600 hover:underline">Hapus</button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
