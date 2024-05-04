<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ItemsCart; // Import the ItemsCart model

class ShoppingCartController extends Controller
{
    public function getUserShoppingCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->input('username');

        $userId = User::getUserIdByUsername($user);
        if ($userId) {
            // Fetch the shopping cart items for the user
            $shoppingCartItems = ItemsCart::where('user_id', $userId)->get();

            // Transform ItemsCart array into an array of Item objects
            $items = [];
            foreach ($shoppingCartItems as $cartItem) {
                $item = new Item([
                    'name' => $cartItem->name,
                    'quantity' => $cartItem->quantity,
                    'description' => $cartItem->description,
                    'price' => $cartItem->price,
                    // You can add more properties if needed
                ]);
                $items[] = $item;
            }

            // Return the array of Item objects as JSON
            return response()->json($items);
        } else {
            // Handle the case where the user with the provided username is not found
            return response()->json(['error' => 'User not found'], 465);
        }
    }


    public function updateUserShoppingCart(Request $request): \Illuminate\Http\JsonResponse
    {
        error_log("We did call The constructor");
        $username = $request->input('username'); // Correctly fetch username
        error_log($username);
        error_log("We fetched Constructor");
        // Get the user ID by username
        $userId = User::getUserIdByUsername($username);
        error_log("got the user ID!");
        if ($userId != null) {
            error_log("Entered If statement");
            // Clear existing shopping cart
            try {
                ItemsCart::where('user_id', $userId)->delete();
                // Delete operation successful
            } catch (\Exception $e) {
                // Handle the exception (e.g., log the error, return an error response)
                error_log('Error deleting items from shopping cart: ' . $e->getMessage());
            }
            // Add new items to the shopping cart
            foreach ($request->input('items') as $item) {
                error_log("For Each");
                ItemsCart::create([
                    'user_id' => $userId,
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            return response()->json(['message' => 'Shopping cart updated successfully'], 200);
        } else {
            // Handle case when user with given username is not found
            return response()->json(['error' => 'User not found'], 465);
        }
    }

}
