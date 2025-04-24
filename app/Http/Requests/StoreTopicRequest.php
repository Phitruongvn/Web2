<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'slug' => 'required|unique:topic',
            'description' => 'nullable',
            'sort_order' => 'required|numeric',
            'status' => 'required|in:1,2'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên chủ đề',
            'name.min' => 'Tên chủ đề phải có ít nhất 3 ký tự',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.unique' => 'Slug này đã tồn tại',
            'sort_order.required' => 'Vui lòng chọn vị trí sắp xếp',
            'sort_order.numeric' => 'Vị trí sắp xếp phải là số',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ'
        ];
    }
}
