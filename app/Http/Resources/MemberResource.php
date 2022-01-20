<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            'balance'       => $this->balance,
            'created_at'    => $this->created_at,
            'user'          => UserResource::make($this->whenLoaded('user')),
            'school'        => SchoolResource::make($this->whenLoaded('school')),
            'role'          => MemberRoleResource::make($this->whenLoaded('role')),
        ];
    }
}
