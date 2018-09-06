<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Classe;
use App\Eleve;
use App\Professeure;

/* Route permettant l'affichage de la page d'accueil */
Route::get('/', function () {
	
	$classes = Classe::all();
    return view('accueil', compact('classes'));

});

/* Route permettant la création de classe */
Route::post('creationClasse', 'ClasseController@create')->name('creationClasse');

/* Route qui permet d'effectuer la recherche et afficher les résultats */
Route::post('search', 'SearchController@search')->name('search');

/* Route permettant l'ajout de note */
Route::post('addNote/{eleve}', 'NoteController@add')->name('addNote');

/* Route permettant la création d'un élève */
Route::post('creationEleve', 'EleveController@create')->name('creationEleve');

/* Route permettant l'affichage des détails de l'élève */
Route::get('detailsEleve/{eleves}', 'EleveController@show')->name('detailsEleve');

/* Route permettant l'édition de l'élève */
Route::post('updateEleve/{eleve}', 'EleveController@update')->name('updateEleve');

/* Route permettant l'affichage de l'évolution du note (graphique) */
Route::get('graph/{eleve}/{matiere}', 'EleveController@graph')->name('graph');

/* Route permettant la suppression d'un élève */
Route::get('deleteEleve/{eleve}', 'EleveController@delete')->name('deleteEleve');

/* Route permettant l'édition des notes */
Route::post('editNote/{eleve}/{note}', 'NoteController@edit')->name('editNote');

/*Route permettant la suppression de note */
Route::get('deleteNote/{eleve}/{note}', 'NoteController@delete')->name('deleteNote');

/* Route permettant l'ajout de matiere */
Route::post('addMatiere', 'MatiereController@add')->name('addMatiere');

/* Route permettant l'édition d'une matiere */
Route::post('editMatiere/{matiere}', 'MatiereController@edit')->name('editMatiere');

/* Route permettant la suppression d'un matiere */
Route::get('deleteMatiere/{matiere}', 'MatiereController@delete')->name('deleteMatiere');

