<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\food_request;
use App\Http\Resources\FoodResource;
use App\Models\Food;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return response()->json($foods);
    }

    public function create(food_request $request)
    {
        $validateRequest = $request->validated();
        $food = Food::create($validateRequest);
        return ResponseHelper::respond(201, 'Food created successfully', new FoodResource($food, 'create'));
    }

    public function findById(int $id)
    {
        $food = Food::find($id);
        if ($food) {
            return ResponseHelper::respond(200, 'Food found', new FoodResource($food, 'findbyid'));
        } else {
            return ResponseHelper::respond(404, 'Food not found');
        }
    }
}
