<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Interfaces\EloquentRelationshipTypes;
class InterviewNoteTemplates extends Model
{
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

    public function options()
    {
        return $this->hasMany('App\Models\InterviewNoteOptions','interview_template_id','id');
    }

    /**
     * duplicates a record with correcponding relationships
     * @param string field_duplicate_tag The name of the field to tag a duplicate
     * @return App\Models\InterviewNoteTemplates
     */
    public function duplicate(string $field_duplicate_tag){
        $relation_types = [EloquentRelationshipTypes::HAS_MANY];
        $relation_method_names = [EloquentRelationshipTypes::HAS_MANY => ["options"]];
        $new = $this->replicate();
        $new->$field_duplicate_tag = $new->$field_duplicate_tag . " duplicate";
        $new->push();
        $this->relations = [];
        foreach( $relation_types as  $relation_type){
            switch($relation_type){
                case EloquentRelationshipTypes::HAS_MANY:
                    $new = $this->duplicateHasMany($new, $relation_method_names[EloquentRelationshipTypes::HAS_MANY]);
                    break;
            }
        }
        return $new;
    }

    /**
     * Specifc method toduplicate has many relationships
     * @param Illuminate\Database\Eloquent\Model\InterviewNoteTemplates new
     * @param array relation_method_names the relation method name i.e [options]
     * @return App\Models\InterviewNoteTemplates
     */
    public function duplicateHasMany(InterviewNoteTemplates $new, array $relation_method_names){
        $this->load($relation_method_names);
        foreach ($this->relations as $relations_name => $values){
            $copied_values = $values->map(function ($value, $key){
                return $value->replicate();
            });
            $new->{$relations_name}()->saveMany($copied_values);
            $new->refresh();
        }
        return $new;
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
