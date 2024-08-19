<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('update');

        // return false;
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
                "userId" => ["required"],
                "age" => ["required"],
                "weight" => ["required"],
                "height" => ["required"],
                "allergies" => ["required"],
                "healthIssues" => ["required"],
                "genotype" => ["required"],
                "bloodGroup" => ["required"],
                "userLang" => ["required"],
                "postalCode" => ["required"],
                "plan" => ["required"],
                "planExp" => ["required"],
            ];
        } else {
            // This helps us to validate for a PATCH request
            return [
                "userId" => ["sometimes", "required"],
                "age" => ["sometimes", "required"],
                "weight" => ["sometimes", "required"],
                "height" => ["sometimes", "required"],
                "allergies" => ["sometimes", "required"],
                "healthIssues" => ["sometimes", "required"],
                "genotype" => ["sometimes", "required"],
                "bloodGroup" => ["sometimes", "required"],
                "userLang" => ["sometimes", "required"],
                "postalCode" => ["sometimes", "required"],
                "plan" => ["sometimes", "required"],
                "planExp" => ["sometimes", "required"],
            ];
        }
    }

    // This helps us to change the name of the columns in json to match the ones in the database
    protected function prepareForValidation()
    {
        if ($this->userId) {
            $this->merge([
                "user_id" => $this->userId,
            ]);
        }

        if ($this->healthIssues) {
            $this->merge([
                "health_issues" => $this->healthIssues,
            ]);
        }

        if ($this->bloodGroup) {
            $this->merge([
                "blood_group" => $this->bloodGroup,
            ]);
        }

        if ($this->userLang) {
            $this->merge([
                "user_lang" => $this->userLang,
            ]);
        }

        if ($this->postalCode) {
            $this->merge([
                "postal_code" => $this->postalCode,
            ]);
        }

        if ($this->planExp) {
            $this->merge([
                "plan_exp" => $this->planExp,
            ]);
        }

    }
}
