<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /** @use HasFactory<\Database\Factories\RolesFactory> */
    use HasFactory;
    protected $table = "roles";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'name',
        'guard_name',
        'created_at',
        'updated_at'
    ];
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'role_has_permissions', 'role_id', 'permission_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'model_has_roles', 'role_id', 'model_id');
    }
    public function hasPermission($permission)
    {
        return $this->permissions()->where('name', $permission)->exists();
    }
    public function hasAnyPermission(array $permissions)
    {
        return $this->permissions()->whereIn('name', $permissions)->exists();
    }
    public function hasAllPermissions(array $permissions)
    {
        return $this->permissions()->whereIn('name', $permissions)->count() === count($permissions);
    }
    public function hasRole($role)
    {
        return $this->users()->where('name', $role)->exists();
    }
    public function hasAnyRole(array $roles)
    {
        return $this->users()->whereIn('name', $roles)->exists();
    }
    public function hasAllRoles(array $roles)
    {
        return $this->users()->whereIn('name', $roles)->count() === count($roles);
    }
}
