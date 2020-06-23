<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Item;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response([ 'items' => ItemResource::collection($items), 'message' => 'Retrieved successfully'], 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request::all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'bucket_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $response(['error' => $validator->errors(), 'Validation Error']);
        }

        $item = $Item::create($data);

        return $response([ '$item' => new ItemResource($item), 'message' => 'created succesfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $response([ '$item' => new ItemResource($item), 'message' => 'Retrieved succesfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->update($request->all());
        return $response([ '$item' => new ItemResource($item), 'message' => 'Retrieved succesfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response(['message' => 'Deleted']);
    }
}
