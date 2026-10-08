<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Hanya admin & editor yang boleh membuat post
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    // Admin: semua post. Editor: hanya post miliknya. User biasa: tidak boleh.
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin() || ($user->isEditor() && $post->user_id === $user->id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->isAdmin() || ($user->isEditor() && $post->user_id === $user->id);
    }
}
