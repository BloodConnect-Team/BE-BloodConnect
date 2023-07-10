<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id_news,
            'Image' => $this->image,
            'Title' => $this->title,
            'Content' => strip_tags($this->content),
            'Author' => $this->name,
            'date' => date('d F Y', strtotime($this->news_created))
        ];    
    }
}
