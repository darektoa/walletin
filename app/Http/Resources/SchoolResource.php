<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
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
            'code'          => $this->code,
            'created_at'    => $this->created_at,
            'members'       => MemberResource::collection($this->whenLoaded('members')),
            'merchants'     => MerchantResource::collection($this->whenLoaded('merchants')),
        ];
    }
}
