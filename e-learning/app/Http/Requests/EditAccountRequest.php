<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditAccountRequest extends FormRequest
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
            'ho_ten' => 'required',
            'gioi_tinh' => 'in:1,2',
            'trang_thai' => 'in:1,2',
            'loai_tai_khoan_id' => 'in:2,3',
            'hinh_anh' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'email' =>  ['required', Rule::unique('tai_khoan')->ignore($this->request->get('vemail'), 'email')],
            'ngay_sinh' => 'required|date_format:"d-m-Y"|before:"01/01/2004"'
        ];
    }
    public function messages()
    {
        return [
            'gioi_tinh.in' => 'Please select gender',
            'trang_thai.in' => 'Please select status',
            'loai_tai_khoan_id.in' => 'Please select type account',
            'ho_ten.required' => 'Please enter fullname',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter email',
            'email.unique' => 'Email already exists',
            'hinh_anh.image' => 'Avater must be an image.',
            'ngay_sinh.required' => 'Please enter date of birth',
            'ngay_sinh.date_format' => 'Date of birth does not match the format d-m-Y',
            'ngay_sinh.before' => 'Date of birth must be a date before 01/01/2004.',
        ];
    }
}
