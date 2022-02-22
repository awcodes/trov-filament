<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('Read Articles');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Article $model)
    {
        return $user->can('Read Articles');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('Create Articles');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Article $model)
    {
        return $user->can('Edit Articles');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Article $model)
    {
        return $user->can('Delete Articles');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Article $model)
    {
        return $user->can('Delete Articles');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Article  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Article $model)
    {
        return $user->can('Delete Articles');
    }
}
