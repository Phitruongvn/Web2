<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
           
            'content' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price_buy' => 'required|numeric',
            'price_sale' => 'required|numeric',
            'qty' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc',
            'thumbnail.required' => 'Vui lòng chọn một hình ảnh',
            'thumbnail.image' => 'Tệp tải lên phải là hình ảnh',
            'thumbnail.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, webp',
            'slug.required' => 'Slug là bắt buộc',
            'slug.unique' => 'Slug đã tồn tại',
            'content.required' => 'Nội dung là bắt buộc',
            'category_id.required' => 'Danh mục là bắt buộc',
            'brand_id.required' => 'Thương hiệu là bắt buộc',
            'price_buy.required' => 'Giá mua là bắt buộc',
            'price_buy.numeric' => 'Giá mua phải là số',
            'price_sale.required' => 'Giá bán là bắt buộc',
            'price_sale.numeric' => 'Giá bán phải là số',
            'qty.required' => 'Số lượng là bắt buộc',
            'qty.numeric' => 'Số lượng phải là số'
        ];
    }
}
