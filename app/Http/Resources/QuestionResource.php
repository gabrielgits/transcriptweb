<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'correct_line' => $this->correct_line,
            'answerId' => $this->answer_id,
            'answer' => new AnswerResource($this->answer),
            'examId' => $this->exam_id,
            'exam' => new ExamResource($this->exam),
        ];
    }
}
