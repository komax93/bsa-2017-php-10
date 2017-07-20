<?php

namespace App\Request\Contract;

use App\Entity\User;

interface SaveUserRequest
{
    /**
     * @return string|null
     */
    public function getFirstName();

    /**
     * @return string|null
     */
    public function getLastName();

    /**
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * @return User
     */
    public function getUser(): User;
}