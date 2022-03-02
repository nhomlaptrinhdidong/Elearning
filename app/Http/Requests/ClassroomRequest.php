<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
            'ten_lop'=> 'required',
            'tai_khoan_id'=>'required',
            'mau_sac'=>'required',
            'mo_ta'=>'required',
            'banner'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
    public function messages()
    {
        return [
            'ten_lop.required' => 'Please enter class name',
            'tai_khoan_id.required' => 'Please select teacher',
            'mau_sac.required' => 'Please select color',
            'mo_ta.unique' => 'Please enter description',
            'banner.unique' => 'Please select banner',
            'banner.image' => 'Banner must be an image.',
        ];
    }
}
