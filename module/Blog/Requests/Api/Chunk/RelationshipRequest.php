<?php

namespace Module\Blog\Requests\Api\Chunk;

use Illuminate\Foundation\Http\FormRequest;

class RelationshipRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'chunk_id' => ['required', 'integer'],
            'relationship_type'=>['required'],
            'relationship_id'=>['required']
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
            'chunk_id' => __('message.chunk.name'),

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
