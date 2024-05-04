<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Models\Item;
use \Illuminate\Http\JsonResponse;

class ItemController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Create a new item with the validated data
        $item = Item::create($validatedData);

        // Return a JSON response with the created item and a 201 status code
        return response()->json($item, 201);
    }
    public function index(): JsonResponse
    {
        // Retrieve all items from the database
        $items = Item::all();

        // Return a JSON response with the items
        return response()->json($items, 200);
    }
    public function searchItems(Request $request) {
        $query = $request->input('query');
        $items = Item::where('name', 'like', '%' . $query . '%')->get();
        return response()->json($items);
    }

}
