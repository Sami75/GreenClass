<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom', 'filiere', 'specialite', 'taille'];

    /**
     * Get students that own the class.
     */
    public function eleves()
    {
        return $this->hasMany('App\Eleve');
    }
}
