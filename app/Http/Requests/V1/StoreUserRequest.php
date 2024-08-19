<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ["required"],
            'other' => ["required"],
            'username' => ["required", Rule::unique("users", "username")],
            'image' => ["nullable"],
            'email' => ["required", "email", Rule::unique("users", "email")],
            'type' => ["required"],
            'address' => ["required"],
            'number' => ["required"],
            'language' => ["required"],
            'emailVerifiedAt' => ["nullable"],
            'password' => ["required", "min:6"],
            'rememberToken' => ["nullable"],
        ];
    }

    // This helps us to change the name of the columns in json to match the ones in the database
    protected function prepareForValidation()
    {
        $this->merge([
            "email_verified_at" => $this->emailVerifiedAt,
            "remember_token" => $this->rememberToken,
        ]);
    }
}
