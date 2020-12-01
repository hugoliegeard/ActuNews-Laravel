<?php

namespace App\Http\Controllers;

use App\Events\PostEvent;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        return view('post.form', [
            'post' => new Post()
        ]);
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
        $newFilename = $alias . '.' . $extension;

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
        $post->user()->associate(Auth::user());
        $post->save();

        # Emission d'un évènement : PostEvent ---------------------------->
        PostEvent::dispatch($post);

        # Redirection vers l'article ------------------------------------->
        return redirect()->action([DefaultController::class, 'post'], [
            'category' => $category->alias,
            'alias' => $post->alias,
            'id' => $post->id
        ])->with('success', 'Votre article est maintenant en ligne !');

    }

    /**
     * Affiche le formulaire de création d'un article
     */
    public function update($id)
    {
        return view('post.form', [
            'post' => Post::find($id)
        ]);
    }

    /**
     * Traitement des données soumises dans le formulaire ci-dessus
     * @param $id
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function storeUpdate($id, PostRequest $request)
    {
        # Récupération du Post
        $post = Post::find($id);

        # Récupération de la catégorie
        $category = Category::find($request->input('category'));

        # Upload de l'image ------------------------------------->

        # Récupération depuis la request de notre image
        $newFilename = $post->featuredImage;
        $featuredImage = $request->file('featuredImage');
        if (null !== $featuredImage) {
            # On récupère l'extension de l'image (jpg, png, etc...)
            $extension = $featuredImage->extension();

            # Renommer le fichier avec un nouveau nom
            # On renomme l'image en nous basant sur l'alias, sans oublier l'extension à la fin.
            $newFilename = $post->alias . '.' . $extension;

            # On stock notre image dans le dossier "public/posts"
            $featuredImage->storeAs(
                'public/posts', $newFilename
            );

            # TODO : Supprimer l'ancienne image sur le serveur
        }

        # Mise à jour d'un Post ------------------------------------->
        # Dans de la mise à jour d'un post, on ne modifie pas l'alias pour le SEO.

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->featuredImage = $newFilename;
        $post->category()->associate($category);
        $post->save();

        # Redirection vers l'article ------------------------------------->

        return redirect()->action([DefaultController::class, 'post'], [
            'category' => $category->alias,
            'alias' => $post->alias,
            'id' => $post->id
        ])->with('success', 'Votre article a été mis à jour !');

    }

    /**
     * Permet la suppression d'un article
     * @param $id
     * @return   RedirectResponse
     */
    public function delete($id)
    {
        // Récupération de l'article
        $post = Post::find($id);

        // cf : https://laravel.com/docs/8.x/filesystem#deleting-files
        Storage::delete('public/posts/' . $post->featuredImage);

        // Suppression de l'article dans la BDD
        $post->delete();

        // Redirection avec confirmation
        return redirect()->action([AdminController::class, 'postsManagement'])
            ->with('success', 'Votre article a été supprimé !');
    }
}
