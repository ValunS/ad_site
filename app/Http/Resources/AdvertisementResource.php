<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = $request->query('fields');

        $response = [
            'id' => $this->id,
            'title' => $this->title,
            'main_image' => $this->images[0] ?? null,
            'price' => $this->price,
        ];

        if ($fields && in_array('description', explode(',', $fields))) {
            $response['description'] = $this->description;
        }

        if ($fields && in_array('images', explode(',', $fields))) {
            $response['images'] = $this->images;
        }
        return $response;
    }
}