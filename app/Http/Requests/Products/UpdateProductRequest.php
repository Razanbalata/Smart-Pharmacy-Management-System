<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'sku' => 'required|string|unique:products,sku,' . $this->product->id,

            'barcode' => 'nullable|string|unique:products,barcode' . $this->product->id,

            'description' => 'nullable|string',

            'purchase_price' => 'required|numeric|min:0',

            'selling_price' => 'required|numeric|min:0|gt:purchase_price',

            'stock_quantity' => 'nullable|integer|min:0',

            'minimum_stock' => 'nullable|integer|min:0',

            'expiry_date' => 'nullable|date|after:today',

            'batch_number' => 'nullable|string',

            'status' => 'required|in:active,inactive',

            'category_id' => 'required|exists:categories,id',

            'supplier_id' => 'required|exists:suppliers,id',
        ];
    }
}
