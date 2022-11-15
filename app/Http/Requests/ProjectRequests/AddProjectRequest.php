<?php

namespace App\Http\Requests\ProjectRequests;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class AddProjectRequest extends BaseRequest
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
            'project_title' => 'required|string|max:80|unique:project_details',
            'project_description' => 'required|string|max:120',
            'user_id' => 'required|integer',
        ];
    }

}
