<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matiere;
use App\Note;
use App\Eleve;
use App\Classe;


class NoteController extends Controller
{
      //Fonction qui permet l'ajout de notes.
	public function add(Request $request, $idEleve) {

            $notes = $request->note;
      	$idMatieres = $request->id;
            $classes = Classe::all();
      	
            $eleve = Eleve::find($idEleve);
      	$matieres = Matiere::all();
      	$array = array_combine($idMatieres, $notes);

            $i = 0;
      	
            foreach($array as $idMatiere => $note) {
                  if($note != "") {
                        Note::create(['idEleve' => $idEleve, 'idMatiere' => $idMatiere, 'note' => $note]);
                        $i++;
                  }
      	}

            if($i > 1 )
                  return back()->with('success', 'Les notes ont bien été ajoutées!');
            else
                  return back()->with('success', 'La note a bien été ajoutée!');
	}

      //Fonction qui permet l'édition de notes
      public function edit(Request $request, $idEleve, $idNote) {

            $editedNote = $request->note;

            $note = Note::find($idNote);
            
            foreach($editedNote as $eN) {
                  $note->update(['note' => $eN]);
            }
   
            $classes = Classe::all();
            $eleve = Eleve::find($idEleve);
            $matieres = Matiere::all();

            return back()->with('success', 'La note a bien été modifiée!');
   
      }

      //Fonction qui permet la suppresion de notes.
      public function delete($idEleve, $idNote) {

            $delete = Note::where('id', '=', $idNote)->delete();


            $eleve = Eleve::find($idEleve);
            $classes = Classe::all();
            $matieres = Matiere::all();

            return back()->with('success', 'La note a bien été supprimée!');
      }
}
