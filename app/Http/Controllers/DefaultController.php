<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;

class DefaultController extends Controller
{

    /**
     * Action / Fonction => Page
     * Permet d'afficher la page d'Accueil
     */
    public function home()
    {
        # Récupérer les données de la page d'accueil
        $posts = Post::all();

        # Transmettre ces données à la vue pour affichage à l'utilisateur
        return view('default.home', [
            'posts' => $posts
        ]);
    }

    /**
     * Permet d'afficher les articles d'une catégorie
     */
    public function category($alias)
    {
        # Récupérer dans la BDD les articles de la catégorie
        $category = Category::where('alias', $alias)->first();
        # dd($category);

        # Transmettre ces données à la vue pour affichage à l'utilisateur
        return view('default.category', [
            'category' => $category
        ]);
    }

    /**
     * Permet d'afficher un article
     */
    public function post($category, $alias, $id)
    {
        # Récupération et Affichage de l'article depuis la BDD
        return view('default.post', [
            'post' => Post::find($id)
        ]);
    }

}
