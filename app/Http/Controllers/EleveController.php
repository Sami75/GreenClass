<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;
use App\Eleve;
use App\Matiere;
use App\Note;
use Khill\Lavacharts\Lavacharts;


class EleveController extends Controller
{
      //Fonction qui permet la création d'élève.
      protected function create(Request $request) {

            $this->validate($request, [
                 'nom' => 'required|string',
                 'prenom' => 'required|string',
                 'dateNaissance' => 'required|date_format:Y/m/d',
                 'sexe' => 'required|string',
                 'tel' => 'required|regex:/[0-9]{10}/',
                 'adresse' => 'required|string',
                 'mail' => 'required|email',
                 'classe' => 'required|string',
           ]);

            $nom = $request->nom;
            $prenom = $request->prenom;
            $dateNaissance = $request->dateNaissance;
            $sexe = $request->sexe;
            $tel = $request->tel;
            $adresse = $request->adresse;
            $mail = $request->mail;
            $classe = $request->classe;


            Eleve::create(['nom' => $nom, 'prenom' => $prenom, 'dateNaissance' => $dateNaissance, 'sexe' => $sexe, 'tel' => $tel, 'adresse' => $adresse, 'mail' => $mail, 'idClass' => $classe]);

            return back()->with('success', "L'élève a bien été crée !");
      }

      //Fonction qui permet d'afficher la page de details de l'élève.
      public function show($id) {

            $eleve = Eleve::find($id);
            $matieres = Matiere::all();
            $classes = Classe::all();

            return view('detailsEleve', compact('eleve', 'matieres', 'classes'));
      }

      //Fonction qui permet de mettre à jour un élève lorsqu'on l'édite.
      public function update(Request $request, $id) {

            $this->validate($request, [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'dateNaissance' => 'required|date_format:Y/m/d',
                'sexe' => 'required|string',
                'tel' => 'required|regex:/[0-9]{10}/',
                'adresse' => 'required|string',
                'mail' => 'required|email',
                'classe' => 'required|string',
          ]);

            $classes=Classe::all();

            $nom = $request->nom;
            $prenom = $request->prenom;
            $dateNaissance = $request->dateNaissance;
            $sexe = $request->sexe;
            $tel = $request->tel;
            $adresse = $request->adresse;
            $mail = $request->mail;
            $classe = $request->classe;


            $eleve = Eleve::find($id);
            $matieres = Matiere::all();


            $eleve->update(['nom' => $nom, 'prenom' => $prenom, 'dateNaissance' => $dateNaissance, 'sexe' => $sexe, 'tel' => $tel, 'adresse' => $adresse, 'mail' => $mail, 'idClass' => $classe]);


            return back()->with('success', "L'élève a bien été modifié !");
      }

      //Fonction qui permet l'affichage d'un graphique qui représente l'évolution des notes.
      public function graph($idEleve, $idMatiere) {

            $data = Note::where( [
                  ['idMatiere', $idMatiere],
                  ['idEleve', $idEleve],
            ])->get();

            $eleve = Eleve::find($idEleve);
            $matiere = Matiere::find($idMatiere);
            $classes = Classe::all();

            $dates = $data->pluck('created_at')->toArray();
            $notes = $data->pluck('note')->toArray();


            $lava = new Lavacharts;

            $evolution = $lava->DataTable();

            $evolution->addDateColumn('Date')
            ->addNumberColumn('Note');

            for($i = 0; $i<count($notes); $i++) {
                  $evolution->addRow([
                        $dates[$i], $notes[$i]
                  ]);
            }

            $chart = $lava->LineChart('Evolution', $evolution, [
                  'title' => 'Evolution des notes de ' .$matiere->nom
            ]);

            return view('graph', compact('lava', 'eleve', 'matiere', 'classes'));
      }

      //Fonction qui permet la suppresion d'un élève.
      public function delete($idEleve) {
      
            $eleve = Eleve::find($idEleve);
            
            $notes = Note::where('idEleve', $idEleve)->get();

            foreach($notes as $note) {

                  $note->delete();
            }
            
            $eleve->delete();

            return redirect('/')->with('success', "L'élève a bien été supprimé!");
      }
}
