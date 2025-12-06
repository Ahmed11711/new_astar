<?php

namespace App\Http\Requests\Admin\withdraw;
use App\Http\Requests\BaseRequest\BaseRequest;
class withdrawUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'name' => 'nullable|sometimes|string|max:255',
            'phone' => 'nullable|sometimes|string|max:255',
            'email' => 'nullable|sometimes|string|max:255',
            'country' => 'nullable|sometimes|string|max:255',
            'bank_name' => 'nullable|sometimes|string|max:255',
            'iban' => 'nullable|sometimes|string|max:255',
            'software' => 'nullable|sometimes|string|max:255',
            'status' => 'sometimes|required|in:pending,confirmed,reject',
            'amount' => 'sometimes|required|numeric',
            'method' => 'sometimes|required|in:bank,bank_dollar,wallet',
            'note' => 'nullable|sometimes|string',
            'type_withdraw' => 'sometimes|required|in:affiliate,profit_ads',
            'address' => 'nullable|sometimes|string|max:255',
        ];
    }

    public function messages(): array
{
    return [
        'status.required' =>
            'Please select a status.',
        'status.in' =>
            'The selected status is invalid. Allowed values: pending, confirmed, reject.',
    ];
}

}
