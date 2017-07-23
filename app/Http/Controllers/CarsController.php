<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Manager\CarManager;
use App\Manager\UserManager;
use App\Entity\Car;
use App\Request\SaveCarRequest;
use Illuminate\Support\Facades\Gate;

/**
 * Class CarsController
 *
 * @package App\Http\Controllers
 */
class CarsController extends Controller
{
    /**
     * @var CarManager
     */
    private $carManager;

    /**
     * @var UserManager
     */
    protected $userManager;

    /**
     * CarsController constructor.
     *
     * @param CarManager $carManager
     * @param UserManager $userManager
     */
    public function __construct(CarManager $carManager, UserManager $userManager)
    {
        $this->middleware('auth');

        $this->carManager = $carManager;
        $this->userManager = $userManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = $this->carManager->findAll();

        $result = $cars->map(function (Car $car) {
            return [
                'id' => $car->id,
                'model' => $car->model,
                'color' => $car->color,
                'price' => $car->price
            ];
        });

        return view('cars.index')->withCars($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create', $this->carManager->getCarModel())) {
            return redirect('/');
        }

        $users = $this->userManager->findAll();
        return view('cars.create')->withUsers($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarRequest $carRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCarRequest $carRequest)
    {
        if(Gate::denies('store', $this->carManager->getCarModel())) {
            return redirect('/');
        }

        $user = $this->userManager->findById($carRequest->user_id);
        $carRequest = new SaveCarRequest($carRequest->toArray(), $user);
        $this->carManager->saveCar($carRequest);

        return redirect()->route('cars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = $this->carManager->findById($id);

        if(is_null($car)) {
            abort(404);
        }

        $carArray = [
            'id' => $car->id,
            'color' => $car->color,
            'model' => $car->model,
            'registration_number' => $car->registration_number,
            'year' => $car->year,
            'mileage' => $car->mileage,
            'price' => $car->price,
            'user_id' => $car->user_id
        ];

        return view('cars.show')->withCar($carArray);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('edit', $this->carManager->getCarModel())) {
            return redirect('/');
        }

        $car = $this->carManager->findById($id);
        $users = $this->userManager->findAll();

        if(is_null($car)) {
            abort(404);
        }

        $carArray = [
            'id' => $car->id,
            'color' => $car->color,
            'model' => $car->model,
            'registration_number' => $car->registration_number,
            'year' => $car->year,
            'mileage' => $car->mileage,
            'price' => $car->price,
            'user_id' => $car->user_id
        ];

        return view('cars.edit')
            ->withCar($carArray)
            ->withUsers($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCarRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCarRequest $request, $id)
    {
        if(Gate::denies('update', $this->carManager->getCarModel())) {
            return redirect('/');
        }

        $user = $this->userManager->findById($request->user_id);
        $car = $this->carManager->findById($id);

        $carRequest = new SaveCarRequest($request->toArray(), $user, $car);
        $this->carManager->saveCar($carRequest);

        return redirect()->route('cars.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete', $this->carManager->getCarModel())) {
            return redirect('/');
        }

        $this->carManager->deleteCar($id);

        return redirect()->route('cars.index');
    }
}
