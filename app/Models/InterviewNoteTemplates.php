<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CanDuplicate;
class InterviewNoteTemplates extends Model
{
    use CanDuplicate;
    //
    public $guarded = [];

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','company_id'];

    // public $timestamps = false;

    protected $table = 'interview_note_templates';

    /**
    * Has many relationnships partaking in model duplication
    * @var array
    */
    protected  $has_many = ["options"];

    /**
    * Duplicate format tag when duplication a model
    * @var string
    */
    protected  $duplicate_format = "duplicate";

    /**
    * Field name in model to which the duplicate format tag is applied to
    * @var string
    */
    protected  $field_duplicate_tag = "name";

    public function options()
    {
        return $this->hasMany('App\Models\InterviewNoteOptions','interview_template_id','id')->orderBy('sort_order','ASC');
    }

   
   /**
     * Method called on app startup
     */
    public static function boot() {
        parent::boot();
        static::deleting(function($template) {
             $template->options()->delete(); //Deleting options relation model
        });
    }

}
