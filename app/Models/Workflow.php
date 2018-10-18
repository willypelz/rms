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

}