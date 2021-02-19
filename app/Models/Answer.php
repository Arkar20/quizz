<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    protected $fillable=['question_id','answer','is_correct'];

    public function question()
    {
        return  $this->belongsTo(Question::class);
    }
    public function storeAnswer($data,$question)
    {
        foreach($data['options'] as $key=>$option){
                $is_correct=false;
            if($data['correct_answer']==$key){
                $is_correct=true;
               
            }
            Answer::create([
                'question_id'=>$question->id,
                'answer'=>$option,
                'is_correct'=>$is_correct
            ]);
        }
    }

    public function updateAnswer($data,$question)
    {
        $this->deleteAnswer($data->id);
        $this->storeAnswer($data,$question);
    }
 public function deleteAnswer($id)
 {
     return Answer::where('question_id',$id)->delete();
 }
}
