<?php

namespace App\Http\Requests\Employee\Group;

use Illuminate\Foundation\Http\FormRequest;

class JoinRequest extends FormRequest
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
            'group_name' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     *  バリデーション項目名定義
     * @return array
     */
    public function attributes()
    {
        return [
            'group_name' => 'グループID',
        ];
    }
}