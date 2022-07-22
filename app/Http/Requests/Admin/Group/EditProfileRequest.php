<?php

namespace App\Http\Requests\Admin\Group;

use App\Models\Group;
use App\Rules\Hankaku;
use App\Rules\HankakuDash;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
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
            'group_name'            => ['required', 'string', new HankakuDash, 'between:3,16', Rule::unique('groups')->ignore($this->id)],
            'name'                  => ['required', 'string', 'max:50'],
            'phone_number'          => ['required', 'string', new PhoneNumber],
            'password'              => ['nullable', 'string', new Hankaku, 'min:8', 'confirmed'],
            'password_confirmation' => ['nullable', 'string', new Hankaku, 'min:8'],
        ];
    }

    /**
     *  バリデーション項目名定義
     * @return array
     */
    public function attributes()
    {
        return [
            'group_name'   => 'グループID',
            'name'         => 'グループ名',
            'phone_number' => '電話番号（グループ）',
        ];
    }
}