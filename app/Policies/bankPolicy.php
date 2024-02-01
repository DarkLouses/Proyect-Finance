<?php

namespace App\Policies;

use App\Models\bank;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class bankPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return void
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param bank $bank
     * @return Response|bool
     */
    public function view(User $user, Bank $bank): Response|bool
    {
        return $user->id === $bank->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param bank $bank
     * @return bool
     */
    public function update(User $user, bank $bank): bool
    {
        return $user->id === $bank->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param bank $bank
     * @return Response|bool
     */
    public function delete(User $user, bank $bank): Response|bool
    {
        return $user->id === $bank->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param bank $bank
     * @return bool
     */
    public function restore(User $user, bank $bank): bool
    {
        return $user->id === $bank->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param bank $bank
     * @return bool
     */
    public function forceDelete(User $user, bank $bank): bool
    {
        return $user->id === $bank->user_id;
    }
}
