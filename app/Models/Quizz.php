<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use Illuminate\Http\Client\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quizz extends Model
{
    use HasFactory;

    protected $fillable=['name','desc','minutes'];

    public function questions()
    {
        return $this->hasMany(Question::class);
 

    }
    public function users()
    {
      return $this->belongsToMany(User::class,'quizz_users','quizz_id','user_id');
    }
    public function createQuizz($data)
        {
          return  Quizz::create($data);
        }
        public function attemptQuizz()
    {
        $attemptquizz=[];
        $authuser=auth()->user()->id;
      $resultuser=Result::where('user_id',$authuser)->get();
      foreach($resultuser as $user ){
        array_push($attemptquizz,$user->quizz_id);
      }
      return $attemptquizz;

      } 
}
