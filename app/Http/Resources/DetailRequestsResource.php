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
            'id' => $this->id_requests,
            'Pasien' => $this->requests_pasien,
            'GolonganDarah' => $this->requests_goldar,
            'JenisDonor' => $this->requests_jenis,
            'Kebutuhan' => $this->requests_jumlah,
            'Catatan' => $this->requests_catatan,
            'Rs' => $this->rs_nama,
            'Lat' => $this->rs_lat,
            'Lng' => $this->rs_lng,
            'User' => $this->name,
            'UserGoldar' => $this->goldar,
            'Created' => $this->requests_waktu
        ];
    }
}
