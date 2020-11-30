<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Fonction de test d'insertion dans la base.
     */
    public function testInsertion()
    {
        // Création d'un nouveau User
        $user = new User();
        $user->firstname = 'John';
        $user->lastname = 'DOE';
        $user->email = 'john.doe@email.com';
        $user->password = 'john.doe';
        $user->save();

        // Création d'une Catégorie
        $category = new Category();
        $category->name = 'Politique';
        $category->alias = 'politique';
        $category->save();

        // Création d'un Post
        $post = new Post();
        $post->title = "Lorem Ipsum Dolor";
        $post->alias = "lorem-ipsum-dolor";
        $post->content = "Lorem Ipsum Dolor";
        $post->featuredImage = "default.jpg";
        $post->category()->associate($category);
        $post->user()->associate($user);
        $post->save();

        return "Article enregistré !";

    }

    /**
     * Affiche le formulaire de création d'un article
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Traitement des données soumises dans le formulaire ci-dessus
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request)
    {
        # Récupération de la catégorie
        $category = Category::find($request->input('category'));

        # Génération de l'Alias
        $alias = Str::slug($request->input('title'));

        # Upload de l'image ------------------------------------->

        # Récupération depuis la request de notre image
        $featuredImage = $request->file('featuredImage');

        # On récupère l'extension de l'image (jpg, png, etc...)
        $extension = $featuredImage->extension();

        # Renommer le fichier avec un nouveau nom
        # On renomme l'image en nous basant sur l'alias, sans oublier l'extension à la fin.
        $newFilename = $alias .'.'.$extension;

        # On stock notre image dans le dossier "public/posts"
        $featuredImage->storeAs(
                'public/posts', $newFilename
        );

        # Création d'un Post ------------------------------------->

        $post = new Post();
        $post->title = $request->input('title');
        $post->alias = $alias;
        $post->content = $request->input('content');
        $post->featuredImage = $newFilename;
        $post->category()->associate($category);
        $post->user()->associate(User::find(1)); # TODO Remplacer par l'utilisateur connecté.
        $post->save();

        # Redirection vers l'article ------------------------------------->

        return redirect()->action([DefaultController::class, 'post'], [
            'category' => $category->alias,
            'alias' => $post->alias,
            'id' => $post->id
        ])->with('success', 'Votre article est maintenant en ligne !');

    }
}
