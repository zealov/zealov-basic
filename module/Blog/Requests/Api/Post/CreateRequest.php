<?php

namespace Module\Blog\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name'        => ['required', 'string', 'between:1,200'],
            'sub_name'    => ['nullable', 'string', 'between:1,300'],
            'author'      => ['nullable', 'string', 'between:1,100'],
            'from'        => ['nullable', 'string', 'between:1,100'],
            'view'        => ['nullable', 'integer'],
            'thumbnail'   => ['nullable', 'string', 'between:1,200'],
            'image_path'  => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'content'     => ['nullable', 'string'],
            'sort'        => ['nullable', 'integer'],
            'redirect'    => ['nullable', 'string', 'between:1,300'],
            'published'   => ['nullable', 'integer'],
            'pinned'      => ['nullable', 'integer'],
            'categories'  => ['nullable', 'array'],
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
            'name'        => __('message.post.name'),
            'sub_name'    => __('message.post.sub_name'),
            'author'      => __('message.post.author'),
            'from'        => __('message.post.from'),
            'view'        => __('message.post.view'),
            'thumbnail'   => __('message.post.thumbnail'),
            'image_path'  => __('message.post.image_path'),
            'description' => __('message.post.description'),
            'sort'        => __('message.post.sort'),
            'redirect'    => __('message.post.redirect'),
            'published'   => __('message.post.published'),
            'pinned'      => __('message.post.pinned'),
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
