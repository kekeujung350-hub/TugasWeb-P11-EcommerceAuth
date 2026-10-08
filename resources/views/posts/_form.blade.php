@csrf
<div>
    <x-input-label for="title" value="Judul" />
    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title ?? '')" required />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<div class="mt-4">
    <x-input-label for="body" value="Isi" />
    <textarea id="body" name="body" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('body', $post->body ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('body')" class="mt-2" />
</div>
<div class="mt-4 flex gap-3">
    <x-primary-button>Simpan</x-primary-button>
    <a href="{{ route('posts.index') }}" class="px-4 py-2 text-sm text-gray-600">Batal</a>
</div>
