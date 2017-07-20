<?php

namespace App\Request;

use App\Entity\Car;
use App\Entity\User;
use App\Request\Contract\SaveCarRequest as SaveCarRequestContract;

class SaveCarRequest extends AbstractRequest implements SaveCarRequestContract
{
    public function __construct(array $options, User $user, Car $car = null)
    {
        parent::__construct(array_merge([
            'car' => $car,
            'user' => $user
        ], $options));
    }

    /**
     * @return Car
     */
    public function getCar(): Car
    {
        return $this->get('car', new Car());
    }

    /**
     * @return string|null
     */
    public function getColor()
    {
        return $this->get('color');
    }

    /**
     * @return string|null
     */
    public function getModel()
    {
        return $this->get('model');
    }

    /**
     * @return string|null
     */
    public function getRegistrationNumber()
    {
        return $this->get('registration_number');
    }

    /**
     * @return int|null
     */
    public function getYear()
    {
        return $this->get('year');
    }

    /**
     * @return float|null
     */
    public function getMileage()
    {
        return $this->get('mileage');
    }

    /**
     * @return float|null
     */
    public function getPrice()
    {
        return $this->get('price');
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->get('user');
    }
}