<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;

class UserGenericResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request){
        return [
                'path' => $this->path ? $this->path : '',
                'status_code', 
                'status' => 'success'
                ];
    }
}