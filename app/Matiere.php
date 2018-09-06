<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Note;
use Khill\Lavacharts\Lavacharts;

class Matiere extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matieres';

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
    protected $fillable = ['nom'];

    /**
     * Get the notes of the "matieres".
     */
    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function getNote($idEleve) {

    	$idMatiere = $this->attributes['id'];
        $notes = Note::where( [
            ['idMatiere', $idMatiere],
            ['idEleve', $idEleve],
        ])->get();

        return $notes;
    }

    public function moy($idEleve) {

        $idMatiere = $this->attributes['id'];
        $notes = Note::where( [
            ['idMatiere', $idMatiere],
            ['idEleve', $idEleve],
        ])->get();

        $avg= $notes->pluck('note');
        if(array_sum($avg->toArray()) == 0)
            return 0;
        else
            return round(array_sum($avg->toArray())/count($avg->toArray()), 2);
    }

}
