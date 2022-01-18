<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'amount'        => $this->amount,
            'status'        => StatusResource::make($this),
            'type'          => TypeResource::make($this),
            'detail'        => $this->detail,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'sender'        => UserResource::make($this->whenLoaded('sender')),
            'receiver'      => UserResource::make($this->whenLoaded('receiver')),
            'school'        => SchoolResource::make($this->whenLoaded('school')),
        ];
    }
}
