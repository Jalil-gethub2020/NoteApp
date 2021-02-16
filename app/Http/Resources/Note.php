<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Note extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [ //we send only elements we want to send/show to the user (in this case element from DB: Noteapp ->  table: notes) <=> return parent::toArray($request)
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'content' => $this->content,
            //'is_complete' => $this->is_complete,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'), //'created_at' and 'updated_at' we can send them or not depending if we want to show them to the user or not !!
        ];
    }
}
