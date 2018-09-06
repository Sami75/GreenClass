<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Classe;

class Eleve extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eleves';

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
    protected $fillable = ['nom', 'prenom', 'dateNaissance', 'sexe', 'tel', 'adresse', 'mail', 'idClass'];

    /**
     * Get students that own the class.
     */
    public function eleves()
    {
        return $this->belongsTo('App\Class', 'idClass');
    }

    /**
     * Get notes that own the student.
     */
    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function getAge() {

        return Carbon::parse($this->attributes['dateNaissance'])->age;
    }

    public function getClasse() {

        $idClass = $this->attributes['idClass'];

        return $classe = Classe::find($idClass);

    }
}
