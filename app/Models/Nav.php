<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Nav extends Model
{
    //
    protected $fillable = [
        'name', 'url', 'permission_id','pid','created_at','updated_at'
    ];

    public function Permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id','id');
    }

}
