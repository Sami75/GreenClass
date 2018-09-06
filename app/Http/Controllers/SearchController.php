<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eleve;
use App\Classe;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;


class SearchController extends Controller
{
      //Fonction qui permet d'effectuer la recherche d'élève ainsi que l'affichage des graphiques (représentation des sexes, ages, classes)
      public function search(Request $request) {
            $search = $request->search;
            $classes = Classe::all();

            $ages = \Lava::DataTable(); 

            $ages->addNumberColumn('Age')
            ->addNumberColumn("Nombre d'élève");

            $classe = \Lava::DataTable();

            $classe->addStringColumn('Nom')
            ->addNumberColumn("Nombre d'élève");

            $sexe = \Lava::DataTable();

            $sexe->addStringColumn('Sexe')
            ->addNumberColumn("Nombre d'élève");

            if($search != "") {
                  $eleves = Eleve::where('nom', 'LIKE', '%' .$search. '%')
                  ->orWhere('prenom', 'LIKE', '%' .$search. '%')
                  ->get();                
            }

            $elevesM = 0; $elevesF = 0;

            foreach($eleves as $eleve) {
                  if($eleve->sexe == 'Masculin') {
                        $age[] = Carbon::parse($eleve->dateNaissance)->age;
                        $idClasse[] = $eleve->idClass;
                        $elevesM++;
                  }

                  else {
                        $idClasse[] = $eleve->idClass;
                        $age[] = Carbon::parse($eleve->dateNaissance)->age;
                        $elevesF++;
                  }
            }

            if(isset($age) && isset($idClasse)) {
                  $countedAge = array_count_values($age);
                  $countedClasse = array_count_values($idClasse);

                  foreach($countedAge as $key => $cA) {
                        $ages->addRow([$key, $cA]);
                  }   

                  foreach($countedClasse as $i => $c) {
                        if(isset($countedClasse[$i])) {
                              foreach($classes as $cl) {
                                    if($cl->id == $i)
                                          $classe->addRow([$cl->nom, $countedClasse[$i]]);
                              }
                        }
                  }
             }
    
            if(count($eleves) > 0) {

                  $sexe->addRow(['Masculin', $elevesM])
                  ->addRow(['Féminin', $elevesF]);

                  $piechart = \Lava::PieChart('Sexe', $sexe, [
                        'title' => 'Représentation des sexes'
                  ]);

                  $columnChart = \Lava::ColumnChart('Age', $ages, [
                        'title' => 'Représentation des ages'
                  ]);

                  $barChart = \Lava::BarChart('Classe', $classe, [
                        'title' => 'Représentation des classes'
                  ]);

                  return view('search', compact('eleves', 'classes', 'piechart', 'columnChart', 'barChart'))->withDetails($eleves)->withQuery($search);
            }

            return view('search', compact('eleves', 'classes'))->withMessage("Aucun élève n'a été trouvé ! Veuillez renouveller votre recherche.");
      }
}
