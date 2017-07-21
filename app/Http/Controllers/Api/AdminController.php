<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Manager\UserManager;
use App\Request\SaveCarRequest;
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
     * @var UserManager
     */
    protected $userManager;

    /**
     * AdminController constructor.
     *
     * @param CarManager $carManager
     * @param UserManager $userManager
     */
    public function __construct(CarManager $carManager, UserManager $userManager)
    {
        $this->carManager = $carManager;
        $this->userManager = $userManager;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $carRequest
     * @return \Illuminate\Http\Response
     */
    public function store(Request $carRequest)
    {
        $user = $this->userManager->findById(1);
        $carRequest = new SaveCarRequest($carRequest->toArray(), $user);

        return $this->carManager->saveCar($carRequest);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userManager->findById(1);
        $car = $this->carManager->findById($id);

        $carRequest = new SaveCarRequest($request->toArray(), $user, $car);

        return $this->carManager->saveCar($carRequest);
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

        return redirect()->route('cars.index');
    }
}
