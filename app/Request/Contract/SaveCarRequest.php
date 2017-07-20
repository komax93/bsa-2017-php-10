<?php

namespace App\Request\Contract;

use App\Entity\Car;
use App\Entity\User;

interface SaveCarRequest
{
    /**
     * @return Car
     */
    public function getCar(): Car;

    /**
     * @return string|null
     */
    public function getColor();

    /**
     * @return string|null
     */
    public function getModel();

    /**
     * @return string|null
     */
    public function getRegistrationNumber();

    /**
     * @return int|null
     */
    public function getYear();

    /**
     * @return float|null
     */
    public function getMileage();

    /**
     * @return float|null
     */
    public function getPrice();

    /**
     * @return User
     */
    public function getUser(): User;
}