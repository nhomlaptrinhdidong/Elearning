<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateAccountRequest extends FormRequest
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
            'dia_chi'=>'required',
            'hinh_anh'=>'image|mimes:jpeg,png,jpg,gif,svg',
            'email' =>  ['required',Rule::unique('tai_khoan')->ignore(auth()->user()->email, 'email')],
            'sdt' =>  ['numeric','required',Rule::unique('tai_khoan')->ignore(auth()->user()->sdt, 'sdt')],
            'ngay_sinh'=> 'required|date_format:"d-m-Y"|before:"01/01/2004"'
        ];
    }
    public function messages()
    {
        return [
            'gioi_tinh.in' => 'Please select gender',
            'ho_ten.required' => 'Please enter fullname',
            'dia_chi.required' => 'Please enter address',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter email',
            'email.unique' => 'Email already exists',
            'sdt.required' => 'Please enter phone number',
            'sdt.unique' => 'Phone number already exists',
            'sdt.numeric' => 'Phone number must be number',
            'hinh_anh.image' => 'Avater must be an image.',

            'ngay_sinh.required' => 'Please enter date of birth',
            'ngay_sinh.date_format' => 'Date of birth does not match the format d-m-Y',
            'ngay_sinh.before' => 'Date of birth must be a date before 01/01/2004.',
        ];
    }
}
