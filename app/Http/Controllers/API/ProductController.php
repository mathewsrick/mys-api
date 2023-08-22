<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $productPerPage = 10;
            $product = Product::with('category')->paginate($productPerPage);
            $pageCount = count(Product::all()) / $productPerPage;

            return response()->json([
                'paginate' => $product,
                'page_count' => ceil($pageCount),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ProductController.index',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ProductController.show',
                'error' => $e->getMessage()
            ], 400);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
