<?php

namespace App\Models;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token'
    ];

    /**
     * Add this method to the Role model
     * public function users()
     * {
     *    return $this->belongsToMany(User::class)->withTimestamps();
     * }
     */

    /**
     * When creating a user, assign a default role ('user') after creating it 
     * $user->roles()->attach(Role::where('name', 'user')->first());
     */

    /**
     * Associate a user with a role, using the pivot table
     * @return App\Models\Role
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Check if the user has a role and is authorized to perform an action
     * @param String $role OR @param Array $roles
     * @return Boolean
     */
    public function authorizeRoles($roles)
    {
        if (!$this->hasAnyRole($roles)) {
            throw new AuthorizationException('This action is unauthorized.', 403);
        };
        return true;
    }

    /**
     *  Check if the user has an associated role
     *  @param String role OR @param Array roles
     *  @return Boolean
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    /**
     *  Check if the user has the assigned role
     * @param String role
     * @return Boolean
     */
    public function hasRole(String $role)
    {

        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
