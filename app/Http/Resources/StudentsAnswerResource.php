<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentsAnswerResource extends JsonResource
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
            'studentId' => $this->student_id,
            'student' => new StudentResource($this->student),
            'answerId' => $this->answer_id,
            'answer' => new AnswerResource($this->answer),
            'questionId' => $this->question_id,
            'question' => new QuestionResource($this->question),
            'testId' => $this->test_id,
            'test' => new TestResource($this->test),
        ];
    }
}
