<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    //
    protected $fillable = [
  'event_name',
  'speaker_name',
  'event_description',
  'datetimepicker',
  'active',
        // add all other fields
  ];

  protected $table = 'events';
}
