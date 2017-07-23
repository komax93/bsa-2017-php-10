<?php

namespace App\Manager;

use App\Entity\Car;
use App\Manager\Contract\CarManager as CarManagerContract;
use App\Request\Contract\SaveCarRequest;
use Illuminate\Support\Collection;

class CarManager implements CarManagerContract
{
    /**
     * Find all Cars
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return Car::all();
    }

    /**
     * Find Car by ID
     *
     * @param int $id
     * @return Car|null
     */
    public function findById(int $id)
    {
        return Car::find($id);
    }

    /**
     * Find Cars that belongs only to active users
     *
     * @return Collection
     */
    public function findCarsFromActiveUsers(): Collection
    {
        return Car::whereHas('user', function ($query) {
            $query->where('is_active', true);
        })->get();
    }

    /**
     * Create or Update Car
     *
     * @param SaveCarRequest $request
     * @return Car
     */
    public function saveCar(SaveCarRequest $request): Car
    {
        $car = $request->getCar();
        $car->color = $request->getColor();
        $car->model = $request->getModel();
        $car->registration_number = $request->getRegistrationNumber();
        $car->year = $request->getYear();
        $car->mileage = $request->getMileage();
        $car->price = $request->getPrice();
        $car->user_id = $request->getUser()->id;
        $car->save();

        return $car;
    }

    /**
     * Delete Car by ID
     *
     * @param int $carId
     * @return void
     */
    public function deleteCar(int $carId)
    {
        $car = Car::findOrFail($carId);
        $car->delete();
    }

    /**
     * This method return Car model
     *
     * @return Car
     */
    public function getCarModel()
    {
        return new Car();
    }
}