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
    protected $table = 'user_folder_contents';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['item_type', 'item_id', 'folder_id','date_added'];

    public $timestamps = false;

    public function getMyFolders($user_id)
    {
        return $this->where('user_id',$user_id)->get()->toArray();
    }


}
