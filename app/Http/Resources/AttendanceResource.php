<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'studentId' => $this->student_id,
            'student' => new StudentResource($this->student),
            'classeId' => $this->classe_id,
            'classe' => new ClasseResource($this->classe),
        ];
    }
}
