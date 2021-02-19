<?php

namespace App\Models;

use App\Models\Quizz;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['question','quizz_id'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function quizz()
    {
        return $this->hasOne(Quizz::class,'id','quizz_id');
    }
    public function storeQuestion($data)        
    {
        return Question::create([
            'question'=>$data['question'],
            'quizz_id'=>$data['quizz_id']

        ]);
    }
    public function getQuestion()
    {
        return Question::latest()
                        ->with("quizz")
                        ->paginate(2);


                    }
                   

}
