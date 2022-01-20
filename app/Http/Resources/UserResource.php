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
        $school     = $this->whenLoaded('school');
        $member     = $this->whenLoaded('member');
        $merchant   = $this->whenLoaded('merchant');

        return [
            'id'            => $this->id,
            'token'         => $this->when($this->token, $this->token),
            'name'          => $this->name,
            'username'      => $this->username,
            'email'         => $this->email,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'school'        => SchoolResource::make($this->when($school, $school)),
            'member'        => MemberResource::make($this->when($member, $member)),
            'merchant'      => MerchantResource::make($this->when($merchant, $merchant)),
        ];
    }
}
