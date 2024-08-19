<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('update');
        // return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method == "PUT") {
            return [
                'firstname' => ["required"],
                'other' => ["required"],
                'image' => ["nullable"],
                'username' => ["required", Rule::unique("users", "email")],
                'type' => ["required"],
                'address' => ["required"],
                'number' => ["required"],
                'language' => ["required"],
                'emailVerifiedAt' => ["nullable"],
                'password' => ["required"],
                'rememberToken' => ["nullable"],
            ];
        } else {
            return [
                'firstname' => ["sometimes","required"],
                'other' => ["sometimes","required"],
                'image' => ["sometimes","nullable"],
                'username' => ["sometimes", "required", Rule::unique("users", "email")],
                'type' => ["sometimes","required"],
                'address' => ["sometimes","required"],
                'number' => ["sometimes","required"],
                'language' => ["sometimes","required"],
                'emailVerifiedAt' => ["sometimes","required"],
                'password' => ["sometimes","required"],
                'rememberToken' => ["sometimes","required"],
            ];
        }

    }

    // This helps us to change the name of the columns in json to match the ones in the database
    protected function prepareForValidation()
    {
        if ($this->emailVerifiedAt) {
            $this->merge([
                "email_verified_at" => $this->emailVerifiedAt,
            ]);
        }

        if ($this->rememberToken) {
            $this->merge([
                "remember_token" => $this->rememberToken,
            ]);
        }
    }
}
