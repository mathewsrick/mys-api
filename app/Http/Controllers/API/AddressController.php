<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        try {
            $address = Address::where('user_id', $id)->get();

            return response()->json($address, 200);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in AddressController.index',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request, $id)
    {
        try {
            $address = null;

            DB::transaction(function() use ($request, $id, &$address) {
                $user = User::findOrFail($id); // if not exist try catch will fire
                
                $is_default = $request->default?? false;

                if($is_default) {
                    Address::where('user_id', $user->id)
                        ->where('default', true)
                        ->update(['default' => false]);
                }

                $address = Address::create([
                    'address' => $request->address,
                    'user_id' => $user->id,
                    'default' => $is_default
                ]);
            });

            return Response()->json($address, 200);
        } catch(\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in the address registration'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($user_id, $address_id)
    {
        try {
            //check if the address id is valid
            DB::transaction(function() use ($user_id, $address_id) {

                Address::where('user_id', $user_id)
                        ->where('default', true)
                        ->update(['default' => false]);
                
                
                Address::where('user_id', $user_id)->where('id', $address_id)->update(['default' => true]);
            });

            return response()->json('ok', 200);
        } catch(\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in the registration'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $address_id)
    {
        try {
            $addr = Address::where('user_id', $user_id)->where('id', $address_id)->firstOrFail();

            if($addr->default) {
                return response()->json(['warning' => 'No puede eliminar la dirección por defecto'], 403);
            }

            $addr->delete();

            return response()->json('ok', 200);
        } catch(\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AddressController.delete()'
            ]);
        }
    }
}
