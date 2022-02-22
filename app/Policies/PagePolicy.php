<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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
        return $user->can('Read Pages');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Page $model)
    {
        return $user->can('Read Pages');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('Create Pages');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Page $model)
    {
        return $user->can('Edit Pages');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Page $model)
    {
        return $user->can('Delete Pages');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Page $model)
    {
        return $user->can('Delete Pages');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Page  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Page $model)
    {
        return $user->can('Delete Pages');
    }
}
