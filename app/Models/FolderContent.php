<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FolderContent extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company_folders_cvs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_folder_id', 'cv_id'];

    // public $timestamps = false;

    public function getMyFolders($user_id)
    {
        return $this->where('user_id',$user_id)->get()->toArray();
    }


}
