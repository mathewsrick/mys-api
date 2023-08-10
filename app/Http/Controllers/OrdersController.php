<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ordersPerPage = 10;
            $orders = Orders::with('user')->orderBy('created_at', 'desc')->simplePaginate($ordersPerPage);
            $pageCount = count(Orders::all()) / $ordersPerPage;

            return response()->json([
                'paginate' => $orders,
                'page_count' =>ceil($pageCount),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in OrderController.order',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $post = new Orders();

            $post->title = $request->get('title');
            $post->location = $request->get('location');
            $post->description = $request->get('description');

            $post->save();

            return response()->json('New post created', 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in PostController.store',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
