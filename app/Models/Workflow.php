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
use App\Traits\CanDuplicate;;
class Workflow extends Model
{
    use SoftDeletes, CanDuplicate;

    protected $fillable = [
        'name',
        'description',
        'company_id'
    ];

    protected $dates = ['deleted_at'];

    /*
    * Has many relationnships partaking in model duplication
    * @var array
    */
    protected  $has_many = ["workflowSteps"];

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

    public function workflowSteps()
    {
        return $this->hasMany(WorkflowStep::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

}