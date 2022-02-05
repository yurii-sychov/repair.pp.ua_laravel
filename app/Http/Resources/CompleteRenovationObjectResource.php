<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompleteRenovationObjectResource extends JsonResource
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
			'id' => $this->id,
			'subdivision' => $this->subdivision->name,
			'name' => $this->name,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'created_by' => $this->created_user->email,
			'updated_by' => $this->updated_user->email
		];
	}
}
