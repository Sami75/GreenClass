<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Matiere;

class Note extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'note';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idEleve', 'idMatiere', 'note'];

    /**
     * Get the "matiere" that owns the note.
     */
    public function matiere()
    {
        return $this->belongsTo('App\Matiere', 'idMatiere');
    }

    /**
     * Get students that own the note.
     */
    public function eleves()
    {
        return $this->belongsTo('App\Eleve', 'idEleve');
    }

    public function getMatiere() {

    	$idMatiere = $this->attributes['idMatiere'];

        return Matiere::find($idMatiere);
    }
}
