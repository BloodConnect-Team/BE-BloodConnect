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
            'BDRS' => $this->bdrs_nama,
            'Kota' => $this->bdrs_kota,
            'Lat' => $this->bdrs_lat,
            'Lng' => $this->bdrs_lng,
            'User' => $this->name,
            'UserGoldar' => $this->goldar,
            'Created' => date('d F Y', strtotime($this->requests_waktu))
        ];
    }
}
