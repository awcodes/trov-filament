<?php

namespace App\Policies;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
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
        return $user->hasAnyPermission(['read faqs', 'manage faqs']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Faq $model)
    {
        return $user->hasAnyPermission(['read faqs', 'manage faqs']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyPermission(['create faqs', 'manage faqs']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Faq $model)
    {
        return $user->hasAnyPermission(['edit faqs', 'manage faqs']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Faq $model)
    {
        return $user->hasAnyPermission(['delete faqs', 'manage faqs']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Faq $model)
    {
        return $user->hasAnyPermission(['delete faqs', 'manage faqs']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faq  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Faq $model)
    {
        return $user->hasAnyPermission(['delete faqs', 'manage faqs']);
    }
}
