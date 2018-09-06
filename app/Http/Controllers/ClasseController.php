<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;

class ClasseController extends Controller
{
      /* Cette fonction permet la création de classe */
      protected function create(Request $request) {

            //On vérifie si ce qui a été écris dans le formulaire respect bien les types des champs de la base de donnée.
            $this->validate($request, [ 
               'nom' => 'required|string',
               'filiere' => 'required|string',
               'specialite' => 'required|string',
               'taille' => 'required|numeric',
         ]);

            //On affecte chaque valeur a une variable.
            $nom = $request->nom;
            $filiere = $request->filiere;
            $specialite = $request->specialite;
            $taille = $request->taille;

            //On crée ensuite la classe.
            Classe::create(['nom' => $nom, 'filiere' => $filiere, 'specialite' => $specialite, 'taille' => $taille]);

            //Puis on retourne la page où l'utilisateur se trouve, et on envoie une message qui permettra d'afficher une alerte après la création.
            return back()->with('success', 'La classe à bien été créée !');
	}
}

