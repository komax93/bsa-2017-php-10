<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Manager\CarManager;
use App\Entity\Car;

class CarsController extends Controller
{
    /**
     * @var CarManager
     */
    protected $carManager;

    /**
     * CarsController constructor.
     *
     * @param CarManager $carManager
     */
    public function __construct(CarManager $carManager)
    {
        $this->middleware('auth:api');

        $this->carManager = $carManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cars = $this->carManager->findAll();

        return response()->json(

            $cars->map(function (Car $car) {
                return [
                    'id' => $car->id,
                    'color' => $car->color,
                    'model' => $car->model,
                    'registration_number' => $car->registration_number,
                    'year' => $car->year,
                    'mileage' => $car->mileage,
                    'price' => $car->price,
                    'user_id' => $car->user_id
                ];
            })

        );
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $car = $this->carManager->findById($id);

        if(is_null($car)) {
            return response()->json(['error' => 'car not found'], 404);
        }

        return response()->json([
            'id' => $car->id,
            'color' => $car->color,
            'model' => $car->model,
            'registration_number' => $car->registration_number,
            'year' => $car->year,
            'mileage' => $car->mileage,
            'price' => $car->price,
            'user_id' => $car->user_id
        ]);
    }
}