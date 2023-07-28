<?php

namespace Module\Blog\Requests\Api\File;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Module\Blog\Models\Category;
use Module\Blog\Models\File;
use Module\Blog\Models\Navigation;

class UpdateRequest extends FormRequest
{
    public $category;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->file = File::find($this->route("id"));
        return $this->file ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name'        => ['required', 'string', 'between:2,60'],
            'redirect'    => ['nullable'],
            'size'        => ['nullable'],
            'published'   => ['nullable', 'integer'],
            'path'        => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'sort'        => ['nullable', 'integer'],
        ];
    }

    /**
     * 获取验证错误的自定义属性。
     *
     * @return array
     */
    public function attributes()
    {
        return [

        ];
    }
}
