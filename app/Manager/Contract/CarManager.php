<?php

namespace App\Manager\Contract;


use App\Entity\Car;
use App\Request\Contract\SaveCarRequest;
use Illuminate\Support\Collection;

interface CarManager
{
    /**
     * Find all Cars
     *
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * Find Car by ID
     *
     * @param int $id
     * @return Car|null
     */
    public function findById(int $id);

    /**
     * Find Cars that belongs only to active users
     *
     * @return Collection
     */
    public function findCarsFromActiveUsers(): Collection;

    /**
     * Create or Update Car
     *
     * @param SaveCarRequest $request
     * @return Car
     */
    public function saveCar(SaveCarRequest $request): Car;

    /**
     * Delete Car by ID
     *
     * @param int $carId
     * @return void
     */
    public function deleteCar(int $carId);
}