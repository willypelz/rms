<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormFieldValues extends Model
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

    protected $table = 'form_fields_values';

}
