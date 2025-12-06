<?php

namespace App\Http\Requests\Admin\notifications;
use App\Http\Requests\BaseRequest\BaseRequest;
class notificationsUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'title' => 'sometimes|required|string|max:255',
            'message' => 'sometimes|required|string',
            'is_read' => 'sometimes|required|integer',
        ];
    }
}
