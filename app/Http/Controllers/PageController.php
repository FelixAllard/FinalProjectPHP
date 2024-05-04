<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\Item;

class PageController extends Controller
{
    public function getCategories(){
        $arryCategories = Category::all();
        return response($arryCategories, 201);
    }

    public function setCategory(Request $request){
        $fields = $request->validate([
            'name'        => 'required|string',
            'description' => 'required|string',
        ]);
        $category = Category::create([
            'name'        => $fields['name'],
            'description' => $fields['description']
        ]);

        return response($category, 201);
    }

    public function setItem(Request $request){
        $fields = $request->validate([
            'name'          => 'required|string'
            ,'description'   => 'required|string'
            ,'price'         => 'required|decimal:2'//there is not validate double
            ,'image'         => 'nullable'
            ,'category_id'   => 'required|integer'
        ]);

        //images processing needs extra steps, in addition you must define a mutator in the Model, as shown in class

       $item = Item::create([
            'name'        => $fields['name']
            ,'description' => $fields['description']
            ,'price'       => $fields['price']
            ,'image'       => $fields['image']
            ,'category_id'  => $fields['category_id']
        ]);

        return response($item, 201);
    }

    public function getItems(){
        $arryItems = Item::all();
        return response($arryItems, 201);
    }

    public function getItem($search){
        $arryItems = Item::where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('description', 'LIKE', '%'.$search.'%')
                        ->get();
        return response($arryItems, 201);
    }

    public function getItemsByCategory($search){
        $categories = Category::where('name', 'LIKE', '%'.$search.'%')->get();
        $items=[];
        if(sizeof($categories)>0){
            $idCat = $categories[0]->id;
            $items = Category::find($idCat)->items;
        }

        foreach ($items as $item) {
            // ...
        }
        return response($items, 201);
    }

    public function getCategoryByItem($search){
        $items = Item::where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('description', 'LIKE', '%'.$search.'%')
                        ->get();
        if(isset($items) && sizeof($items)>0){
            $idItem= $items[0]->id;
            $category = Item::find($idItem)->category;
            return response([$category], 201);
        }
        return response([],201);
    }
}
