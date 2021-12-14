<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'gioi_tinh'=> 'in:1,2',
            'trang_thai'=> 'in:1,2',
            'loai_tai_khoan_id'=> 'in:2,3',
            'dia_chi'=>'required',
            'ho_ten'=>'required',
            'hinh_anh'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'required|email|unique:App\Models\TaiKhoan,email',
            'sdt' => 'required|numeric|min:9|unique:App\Models\TaiKhoan,sdt',
            'ngay_sinh'=> 'required|date_format:"d/m/Y"|before:"01/01/2004"'

        ];
    }
    public function messages()
    {
        return [
            'gioi_tinh.in' => 'Please select gender',
            'trang_thai.in' => 'Please select status',
            'loai_tai_khoan_id.in' => 'Please select type account',

            'ho_ten.required' => 'Please enter fullname',
            'dia_chi.required' => 'Please enter address',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter email',
            'email.unique' => 'Email already exists',
            'sdt.required' => 'Please enter phone number',
            'sdt.unique' => 'Phone number already exists',
            'sdt.numeric' => 'Phone number must be number',
            'sdt.min' => 'Phone number must be at least min:',
            //'sdt.max' => 'Phone number  not be greater than max:',

            'hinh_anh.required' => 'Please choose avatar',
            'hinh_anh.image' => 'Avater must be an image.',

            'ngay_sinh.required' => 'Please enter date of birth',
            'ngay_sinh.date_format' => 'Date of birth does not match the format d/m/Y',
            'ngay_sinh.before' => 'Date of birth must be a date before 01/01/2004.',




        ];
    }
}
