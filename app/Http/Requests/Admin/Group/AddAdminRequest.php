<?php

namespace App\Http\Requests\Admin\Group;

use App\Rules\Email;
use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends FormRequest
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
            'email' => ['string', 'required', new Email, 'email'],
            'group_id' => ['required'],
        ];
    }

    /**
     *  バリデーション項目名定義
     * @return array
     */
    public function attributes()
    {
        return [
            'group_id'   => 'グループ',
        ];
    }

    /**
     *  バリデーションメッセージ
     * @return array
     */
    public function messages()
    {
        return [
            'group_id.required'   => ':attributeを選択してください。',
        ];
    }
}