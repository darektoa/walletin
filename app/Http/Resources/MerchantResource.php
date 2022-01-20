<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
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
            'description'   => $this->description,
            'status'        => StatusResource::make($this),
            'created_at'    => $this->created_at,
            'school'        => SchoolResource::make($this->whenLoaded('school')),
            'products'      => MerchantProductResource::make($this->whenLoaded('products')),
        ];
    }
}
