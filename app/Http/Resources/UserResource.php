<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'token'         => $this->when($this->token, $this->token),
            'name'          => $this->name,
            'username'      => $this->username,
            'email'         => $this->email,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'school'        => SchoolResource::make($this->whenLoaded('school')),
            'member'        => MemberResource::make($this->whenLoaded('member')),
            'merchant'      => MerchantResource::make($this->whenLoaded('merchant')),
        ];
    }
}
