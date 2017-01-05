<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoApplicationValues extends Model
{
    //
    public $guarded = [];

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['form_field_id', 'value', 'job_application_id', 'created_at', 'updated_at'];

    // public $timestamps = false;

    protected $table = 'video_application_values';

    public function video_option()
    {
        return $this->hasOne('App\Models\VideoApplicationOptions','id','form_field_id');
    }

}
