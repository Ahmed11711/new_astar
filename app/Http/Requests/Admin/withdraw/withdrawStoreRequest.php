<?php

namespace App\Http\Requests\Admin\withdraw;
use App\Http\Requests\BaseRequest\BaseRequest;
class withdrawStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'iban' => 'nullable|string|max:255',
            'software' => 'nullable|string|max:255',
            'status' => 'required|in:pending,confirmed,reject',
            'amount' => 'required|numeric',
            'method' => 'required|in:bank,bank_dollar,wallet',
            'note' => 'nullable|string',
            'type_withdraw' => 'required|in:affiliate,profit_ads',
            'address' => 'nullable|string|max:255',
        ];
    }
}
