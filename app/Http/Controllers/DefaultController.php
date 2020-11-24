<?php


namespace App\Http\Controllers;


class DefaultController extends Controller
{

    /**
     * Action / Fonction => Page
     * Permet d'afficher la page d'Accueil
     */
    public function home()
    {
        return view('default.home');
    }

    /**
     * Permet d'afficher les articles d'une catégorie
     */
    public function category($alias)
    {
        return view('default.category');
    }

    /**
     * Permet d'afficher un article
     */
    public function post($id, $alias, $category)
    {
        return view('default.post');
    }

}
