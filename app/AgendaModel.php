<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaModel extends Model
{
    //
    protected $fillable = [
    'session_id',
    'time',
    'topic',
    'info',
    'owner',
    'active'
          // add all other fields
    ];

    protected $table = 'agenda';
}
