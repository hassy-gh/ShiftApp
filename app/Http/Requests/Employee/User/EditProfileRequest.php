<?php

namespace App\Http\Requests\Employee\User;

use App\Rules\Email;
use App\Rules\Hankaku;
use App\Rules\HankakuDash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_name' => ['required', 'string', new HankakuDash, 'between:3,16', Rule::unique('users')->ignore(Auth::id())],
            'last_name' => ['required', 'string', 'max:20'],
            'first_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', new Email, 'email', 'max:200', Rule::unique('users')->ignore(Auth::id())],
            'password' => ['nullable', 'string', new Hankaku, 'min:8', 'confirmed'],
            'password_confirmation' => [
                'nullable', 'string',
                new Hankaku, 'min:8'
            ],
        ];
    }
}