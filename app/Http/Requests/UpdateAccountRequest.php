<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class UpdateAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user()->id],
            'current_password' => ['required_with:password', 'current_password'],
            'password' => ['sometimes', 'required_with:current_password', Password::defaults(), 'confirmed'],
            'profile_picture' => [
                'nullable',
                File::types(['jpg', 'jpeg', 'png', 'gif'])->max(2048),
            ],
        ];
    }
}
