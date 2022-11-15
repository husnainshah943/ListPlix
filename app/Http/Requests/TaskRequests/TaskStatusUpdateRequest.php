<?php

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use phpseclib3\Crypt\EC\BaseCurves\Base;

class TaskStatusUpdateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
            'status' => 'required|string|max:20',
        ];
    }
}
