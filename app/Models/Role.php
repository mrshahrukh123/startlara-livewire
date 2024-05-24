<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;
    /**
     * getPermissionIdsAttribute
     *
     * @return array
     */
    public function getPermissionIdsAttribute():array
    {
        return $this->permissions()->pluck('permission_id')->toArray();
    }
}
