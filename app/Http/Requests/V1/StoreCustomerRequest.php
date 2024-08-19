<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');
        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "userId" => ["required", Rule::unique("customers", "user_id")],
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
    }

    // This helps us to change the name of the columns in json to match the ones in the database
    protected function prepareForValidation()
    {
        $this->merge([
            "user_id" => $this->userId,
            "health_issues" => $this->healthIssues,
            "blood_group" => $this->bloodGroup,
            "user_lang" => $this->userLang,
            "postal_code" => $this->postalCode,
            "plan_exp" => $this->planExp,
        ]);
    }
}
