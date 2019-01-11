<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'sltParent'=>'required',
            'txtProductName'=>'required|unique:products,name',
            'txtCost'=>'required',
            'fImages'=>'required|image'
        ];
    }
    public function messages(){
        return[
            'sltParent.required'=>'Hãy lựa chọn danh mục sản phẩm !',
            'txtProductName.required'=>'Nhập vào tên sản phẩm . ',
            'txtProductName.unique'=>'Tên sản phẩm đã tồn tại .',
            'txtCost.required' => "Hãy nhập vào giá sản phẩm .",
            'fImages.required'=>'Bạn chưa chọn hình ảnh !',
            'fImages.image'=>'Hình ảnh không đúng định dạng .'
        ];
    }
}
