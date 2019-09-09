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

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkflowStep extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'slug',
        'order',
        'type',
        'description',
        'workflow_id',
        'requires_approval',
        'is_approved',
        'visible_to_applicant',
        'message_template',
        'is_readonly',
        'message_to_applicant'
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtoupper(str_slug($value));
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    /**
     * Approvals refer to Users to approve a step
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function approvals()
    {
        return $this->belongsToMany(
            User::class,
            'approval_workflow_step',
            'workflow_step_id',
            'user_id'
        );
    }

    public function users()
    {
      return $this->belongsToMany('App\User');
    }
}
