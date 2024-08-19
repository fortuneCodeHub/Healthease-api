<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * This controls the amount of JSON information to pass from the database
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request); to return all the data like that
        return [
            "id" => $this->id,
            "firstname" => $this->firstname,
            "other" => $this->other,
            "username" => $this->username,
            "image" => $this->image,
            "email" => $this->email,
            "type" => $this->type,
            "address" => $this->address,
            "number" => $this->number,
            "language" => $this->language,
            "emailVerifiedAt" => $this->email_verified_at,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}
