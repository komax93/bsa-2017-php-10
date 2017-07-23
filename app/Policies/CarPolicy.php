<?php

namespace App\Policies;

use App\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * View policy
     *
     * @param User $user
     * @return User
     */
    public function view(User $user)
    {
        return $user-is_admin;
    }

    /**
     * Create policy
     *
     * @param User $user
     * @return User
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Store policy
     *
     * @param User $user
     * @return User
     */
    public function store(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Show policy
     *
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Edit policy
     *
     * @param User $user
     * @return User
     */
    public function edit(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Update policy
     *
     * @param User $user
     * @return User
     */
    public function update(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Delete policy
     *
     * @param User $user
     * @return User
     */
    public function delete(User $user)
    {
        return $user->is_admin;
    }
}