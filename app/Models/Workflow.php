<?php
/**
 * Description
 *
 * @package     seamlesshiring.vcom
 * @category    Source
 * @author      Michael Akanji <matscode@gmail.com>
 * @date        2018-09-26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Interfaces\EloquentRelationshipTypes;
class Workflow extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'company_id'
    ];

    protected $dates = ['deleted_at'];

    public function workflowSteps()
    {
        return $this->hasMany(WorkflowStep::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * duplicates a record with correcponding relationships
     * @param string field_duplicate_tag The name of the field to tag a duplicate
     * @return Illuminate\Database\Eloquent\Model\Workflow
     */
    public function duplicate(string $field_duplicate_tag){
        $relation_types = [EloquentRelationshipTypes::HAS_MANY];
        $relation_method_names = [EloquentRelationshipTypes::HAS_MANY => ["workflowSteps", "jobs"]];
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
     * @return Illuminate\Database\Eloquent\Model\Workflow
     */
    public function duplicateHasMany(Workflow $new, array $relation_method_names){
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

}