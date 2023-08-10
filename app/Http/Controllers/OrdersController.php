<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\OrderProduct;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ordersPerPage = 10;
            $orders = Orders::with('products')
                ->with(['user' => function($q) {
                    $q->select('id', 'first_name', 'last_name', 'email', 'phone_number', 'image');
                }])
                ->with(['address' => function($q) {
                    $q->select('id', 'address');
                }])
                ->orderBy('created_at', 'desc')
                ->simplePaginate($ordersPerPage);
            
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
    public function store(OrderStoreRequest $request)
    {
        try {
            DB::transaction(function() use ($request) {
                $order = new Orders();
                $order->delivery_date = $request->get('delivery_date');
                $order->payment_method = $request->get('payment_method');
                $order->payment_type = $request->get('payment_type');
                $order->amount = $request->get('amount');
                $order->user_id = $request->get('user_id');
                $order->address_id = $request->get('address_id');
    
                $order->save();
    
                $products = $request->get('products');
                foreach ($products as $product) {
                    OrderProduct::create([
                        'qty' => $product['qty'],
                        'unit_price' => $product['unit_price'],
                        'discount' => $product['discount'],
                        'product_id' => $product['product_id'],
                        'order_id' => $order['id'],
                    ]);
                }
            });

            return response()->json('New order created', 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in OrdersController.store',
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
