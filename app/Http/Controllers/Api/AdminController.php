<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manager\CarManager;
use App\Entity\Car;

class AdminController extends Controller
{
    /**
     * @var CarManager
     */
    protected $carManager;

    /**
     * AdminController constructor.
     * @param CarManager $carManager
     */
    public function __construct(CarManager $carManager)
    {
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $request->all();

        return $this->carManager->saveCar($result);
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
            'model' => $car->model,
            'registration_number' => $car->registration_number,
            'year' => $car->year,
            'mileage' => $car->mileage,
            'price' => $car->price,
            'user_id' => $car->user_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $request->all();

        return $this->carManager->saveCar($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->carManager->deleteCar($id);
    }
}
