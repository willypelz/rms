<?php

namespace App\Traits;

use App\Interfaces\EloquentRelationshipTypes;

/**
* Trait that helps duplicate a model
*/
trait CanDuplicate
{

     /**
     * duplicates a record with correcponding relationships
     * @param string field_duplicate_tag The name of the field to tag a duplicate
     * @return Illuminate\Database\Eloquent\Model
     */
    function duplicate(){
        $relation_types = [EloquentRelationshipTypes::HAS_MANY];
        $relation_method_names = [EloquentRelationshipTypes::HAS_MANY => $this->getHasMany()];
        $new = $this->replicate();
        $field_duplicate_tag_dynamic = $this->getDuplicateTag();
        $new->$field_duplicate_tag_dynamic = $this->formatDuplicateTagName($new->$field_duplicate_tag_dynamic);
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
     * Formats field duplicate field names appriopiately
     * @param string $field the field value to format
     * @return Illuminate\Database\Eloquent\Model
     */
    function formatDuplicateTagName(string $field) : string
    {
        $field = $field . " " . $this->getDuplicateFormat() ;
        $interviewNoteTemp = self::where($this->field_duplicate_tag, $field)->first();
        if(!$interviewNoteTemp)
            return $field;
        else
            return self::formatDuplicateTagName($field);
    }

    /**
     * Specifc method toduplicate has many relationships
     * @param Illuminate\Database\Eloquent\Model\InterviewNoteTemplates new
     * @param array relation_method_names the relation method name i.e [options]
     * @return Illuminate\Database\Eloquent\Model
     */
    function duplicateHasMany($new, array $relation_method_names){
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

    /*
    *  The method names on model having hasMany relationship
    *  Override in model i.e protected has_many = [...hasManyRelationshpMethod names];
    */
    public function getHasMany():array
    {
        return isset($this->has_many) ?
            $this->has_many :
            '';
    }
    /*
    *   The literal identifier to append to  duplicates 
    *   Override in model i.e protected duplicate_format = "duplicate"
    */
    public function getDuplicateFormat()
    {
        return isset($this->duplicate_format) ?
            $this->duplicate_format :
            'duplicate';
    }

    /*
    *   The field on model to which an update is required to show its a duplicate
    *   Override in model i.e protected name = "name"
    */
    public function getDuplicateTag()
    {
        return isset($this->field_duplicate_tag) ?
            $this->field_duplicate_tag :
            'name';
    }

}


?>