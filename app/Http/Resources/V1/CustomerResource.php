<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "userId" => $this->user_id,
            "age" => $this->age,
            "weight" => $this->weight,
            "height" => $this->height,
            "allergies" => $this->allergies,
            "healthIssues" => $this->health_issues,
            "genotype" => $this->genotype,
            "bloodGroup" => $this->blood_group,
            "userLang" => $this->user_lang,
            "postalCode" => $this->postal_code,
            "plan" => $this->plan,
            "planExp" => $this->plan_exp,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}
