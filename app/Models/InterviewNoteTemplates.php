<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

interface EloquentRelationshipTypes{
    const HAS_MANY = "hasMany";
}
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

    public function duplicate(){
        $relation_types = [EloquentRelationshipTypes::HAS_MANY];
        $relation_method_names = [EloquentRelationshipTypes::HAS_MANY => ["options"]];
        //copy attributes
        $new = $this->replicate();
        //save model before you recreate relations (so it has an id)
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

    public function duplicateHasMany($new, $relation_method_names){
        //load relations on EXISTING MODEL
        $this->load(implode(', ',$relation_method_names));
        //re-sync everything
        foreach ($this->relations as $relations_name => $values){
            dd($values);
            $new->{$relations_name}()->update(['id' => null])->saveMany($values);
        }
        return $new;
    }

}
