<?php

namespace App\Http\Requests\TaskRequests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class AddTaskRequest extends BaseRequest
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
            'title' => 'required|string|max:80',
            'description' => 'required|string|max:120',
            'status' => 'required|string|max:20',
            'project_id' => 'required|integer',
            'user_id' => 'required|integer',
        ];
    }

}
