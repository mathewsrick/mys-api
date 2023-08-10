<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*.qty' => 'required|integer|min:10',
            'products.*.unit_price' => 'required|integer',
            'products.*.discount' => 'required|numeric',
            'products.*.product_id' => 'required|exists:products,id',
            
            'delivery_date' => 'date',
            'payment_method' => 'required|string|in:ON_DELIVERY,ONLINE',
            'payment_type' => 'required|string|in:CASH,TRANSFER,NEQUI',
            'amount' => 'required|numeric',
            'address_id' => 'required|exists:address,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
