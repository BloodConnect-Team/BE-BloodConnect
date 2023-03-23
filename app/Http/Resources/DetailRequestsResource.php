<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailRequestsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            'id' => $this->id,
            'Pasien' => $this->requests_pasien,
            'JenisDonor' => $this->requests_jenis,
            'Rs' => $this->rs_nama,
            'Created' => $this->requests_waktu
        ];
    }
}
