<?php

namespace Module\Blog\Requests\Api\Chunk;

use Illuminate\Foundation\Http\FormRequest;
use Module\Blog\Models\Chunk;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->chunk = Chunk::find($this->route("id"));
        return $this->chunk ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => ['required', 'string',  'between:1,60'],
            'sort' => ['nullable', 'integer'],
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
            'name' => __('message.chunk.name'),
            'type' => __('message.chunk.type'),
            'sort' => __('message.chunk.sort'),
        ];
    }


    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}