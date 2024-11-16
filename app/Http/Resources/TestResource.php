<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
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
            'score' => $this->score,
            'points' => $this->points,
            'examId' => $this->exam_id,
            'exam' => new ExamResource($this->exam),
            'studentId' => $this->student_id,
            'student' => new StudentResource($this->student),
        ];
    }
}
