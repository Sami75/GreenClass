<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matiere;
use App\Note;

class MatiereController extends Controller
{

	//Fonction qui permet la création de matiére.
	public function add(Request $request) {
    	
    		$this->validate($request, [
  			'matiere' => 'required|string',
		]);

 		$nom = $request->matiere;
 		
 		$matiere = Matiere::create(['nom' => $nom]);

   		return back()->with('success', "La matière a bien été créée !");
	}

	//Fonction qui permet l'édition d'une matière.
	public function edit(Request $request, $idMatiere) {

		$this->validate($request, [
			'matiere' => 'required|string',
		]);

		$nom = $request->matiere;

		$matiere = Matiere::find($idMatiere);

		$matiere->update(['nom' => $nom]);

		return back()->with('success', "La matière a bien été editée !");
	}

	//Fonction qui permet la suppression d'une matière
	public function delete($idMatiere) {

		$matiere = Matiere::find($idMatiere);
		$notes = Note::where('idMatiere', '=', $idMatiere)->get();

		foreach($notes as $note) {
			$note->delete();
		}

		$matiere->delete();

		return redirect('/')->with('success', "La matière a bien été supprimée !");

	}
}
