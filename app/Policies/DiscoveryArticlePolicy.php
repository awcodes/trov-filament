<?php

namespace App\Policies;

use App\Models\DiscoveryArticle;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscoveryArticlePolicy
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
        return $user->can('Read Discovery Center');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DiscoveryArticle  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DiscoveryArticle $model)
    {
        return $user->can('Read Discovery Center');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('Create Discovery Center');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DiscoveryArticle  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DiscoveryArticle $model)
    {
        return $user->can('Edit Discovery Center');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DiscoveryArticle  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DiscoveryArticle $model)
    {
        return $user->can('Delete Discovery Center');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DiscoveryArticle  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DiscoveryArticle $model)
    {
        return $user->can('Delete Discovery Center');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DiscoveryArticle  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DiscoveryArticle $model)
    {
        return $user->can('Delete Discovery Center');
    }
}
