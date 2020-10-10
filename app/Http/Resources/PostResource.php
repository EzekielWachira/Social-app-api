<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'image' =>$this->image,
//            'created_at' => $this->created_at,
            'created_at' => Carbon::parse($this->created_at)->format('d-m-Y h:iA'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y h:iA'),
            'user' => $this->user,
            'comments' => $this->comments,
            'likes' => $this->likes
        ];
    }
}
