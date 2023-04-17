<?php

namespace Module\Blog\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;
use Module\Blog\Requests\GetListRequest as CommonRequest;
class GetListRequest extends FormRequest
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
        return array_merge((new CommonRequest())->rules(), [
            'offset'=>['nullable', 'integer'],
            'limit'=>['nullable', 'integer'],
            'order'=>['nullable'],
        ]);
    }
}
