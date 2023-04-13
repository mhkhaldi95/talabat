<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $locale = app()->getLocale() == 'ar'?'ar':'en';
        $date = new \DateTime($this->created_at);
        $formattedDate = $date->format('Y-m-d H:i:s');
        return [
            'id' => $this['id'],
            'notifiable' => $this->notifiable->name,
            'title' => $this['data']['title_'.$locale],
            'body' => $this['data']['body_'.$locale],
            'type' => @$this['data']['type'],
            'read_at' => $this['read_at'],
            'created_at' =>$formattedDate,
        ];
    }
}
