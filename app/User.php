<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'username',
                            'password',
                            'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function galeria_categorias(){
        return $this->hasMany('\App\Catgaleria');
    }

    public function blog_categorias(){
        return $this->hasMany('\App\Catblog');
    }

    public function catalogo_categorias(){
        return $this->hasMany('\App\Catcatalogo');
    }

    public function permisos(){
        return $this->belongsToMany('App\Permiso');
    }

    /*public function can($nombre){
        return $this->table
    }
*/
    /*public function permisos*/

    public function can($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $can = $this->can($roleName);

                if ($can && !$requireAll) {
                    return true;
                } elseif (!$can && $requireAll) {
                    return false;
                }
            }

            // If we've made it this far and $requireAll is FALSE, then NONE of the roles were found
            // If we've made it this far and $requireAll is TRUE, then ALL of the roles were found.
            // Return the value of $requireAll;
            return $requireAll;
        } else {
            foreach ($this->permisos as $role) {
                if ($role->nombre == $name) {
                    return true;
                }
            }
        }

        return false;
    }



   public function scopeNombre($query,$request,$order){
        return $query->where('username','like','%'.$request['nombre'].'%')->orderBy('updated_at',$order);
      }    
}

