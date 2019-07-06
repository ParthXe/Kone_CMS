<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
    //
  protected $fillable = [
    'question', 'optionA', 'optionB','optionC','optionD','active'
   ];

   protected $table = 'feedback';
}
