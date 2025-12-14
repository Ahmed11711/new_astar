<?php

namespace App\Http\Requests\Global;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class getAccountByTypeRequest extends BaseRequest
{


 public function rules(): array
 {
  return [
   'account_id' => 'required|string|exists:,column'
  ];
 }
}
