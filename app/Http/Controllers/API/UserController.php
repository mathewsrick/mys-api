<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Object
    {
        try {
            $user = User::with(['directory' => function($q) {
                $q->where('default', true);
            }])->where('id', $id)->firstOrFail();

            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in UserController.show',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);

            // if($request->hasFile('image')) {
            //     (new ImageService)->updateImage($user, $request, '/images/users/', 'update');
            // }

            $user->phone_number = $request->phone_number;
            // $user->last_name = $request->last_name;
            // $user->location = $request->location;
            // $user->description = $request->description;

            $user->save();

            return response()->json(['User details update'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in UserController.update',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
