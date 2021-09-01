<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ArticlePolicy
 * @package App\Policies
 */
class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given article can be showed by the user.
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function index(User $user, Article $article): bool
    {
        return $user->id === $article->user_id || $user->is_admin;
    }

    /**
     * Determine if the given article can be updated by the user.
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function update(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    /**
     * Determine if the given article can be deleted by the user.
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function delete(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    /**
     * Determine if the given article can be edited by the user.
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function edit(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }
}
