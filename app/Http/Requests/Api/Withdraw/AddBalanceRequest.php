<?php

namespace App\Http\Requests\Api\Withdraw;

use App\Http\Requests\BaseRequest\BaseRequest;

class AddBalanceRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:1'],
            'type_balance' => ['required', 'in:affiliate_balance,balance'],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        $balanceTypes = implode(', ', ['affiliate_balance', 'balance']);

        return [
            'amount.required' => 'Please enter the amount.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be greater than 0.',

            'type_balance.required' => 'Please select a balance type.',
            'type_balance.in' =>
                "The selected balance type is invalid. Allowed values: {$balanceTypes}.",
        ];
    }
}
