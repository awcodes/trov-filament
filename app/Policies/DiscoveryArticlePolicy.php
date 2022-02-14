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
        return $user->hasAnyPermission(['read discovery articles', 'manage discovery articles']);
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
        return $user->hasAnyPermission(['read discovery articles', 'manage discovery articles']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyPermission(['create discovery articles', 'manage discovery articles']);
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
        return $user->hasAnyPermission(['edit discovery articles', 'manage discovery articles']);
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
        return $user->hasAnyPermission(['delete discovery articles', 'manage discovery articles']);
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
        return $user->hasAnyPermission(['delete discovery articles', 'manage discovery articles']);
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
        return $user->hasAnyPermission(['delete discovery articles', 'manage discovery articles']);
    }
}
