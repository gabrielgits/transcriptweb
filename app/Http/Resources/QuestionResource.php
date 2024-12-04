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
    public function toArray($request): array
    {
        $answers = \App\Models\Answer::where('question_id', $this->id)->get();
        return [
            'id' => $this->id,
            'question' => $this->question,
            'correctLine' => $this->correct_line,
            'answerId' => $this->answer_id,
            'createdAt' => $this->created_at, 
            'examId' => $this->exam_id,
            'answers' => AnswerResource::collection($answers),
        ];
    }
}
