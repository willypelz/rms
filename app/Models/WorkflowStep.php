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

class WorkflowStep extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'name',
        'rank',
        'description',
        'workflow_id',
        'requires_approval',
        'is_approved',
        'visible_to_applicant',
        'message_template',
    ];

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}