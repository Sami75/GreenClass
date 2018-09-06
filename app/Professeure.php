<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professeure extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professeures';

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
    protected $fillable = ['nom', 'prenom', 'dateNaissance', 'sexe', 'tel', 'adresse', 'mail'];

    /**
     * Get students that own the class.
     */
    public function eleves()
    {
        return $this->belongsTo('App\Class', 'idClass');
    }
}
