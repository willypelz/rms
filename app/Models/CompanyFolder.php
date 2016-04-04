<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyFolder extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company_folders';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name','date_added'];

    public $timestamps = false;

    public function getMyFolders($user_id)
    {
        return $this->where('user_id',$user_id)->get()->toArray();
    }


}
