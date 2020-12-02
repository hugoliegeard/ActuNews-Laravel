<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Permet de retourner tous les résultats (articles)
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Permet de créer un nouvel article
     * @param Request $request
     */
    public function store(Request $request)
    {
        # dd( $request->all() ); # Observons notre requête entrante
        return Post::create($request->all());
    }

    /**
     * Retourner l'article via son ID
     * @param Post $post
     * @return Post
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Permet de mettre à jour un article via son ID
     * @param Request $request : Contient les modifications à faire
     * @param Post $post : Contient l'article à modifier
     */
    public function update(Request $request, Post $post)
    {
        # dump( $post );
        # dd( $request->all() ); # Observons notre requête entrante
        return $post->update($request->all()) ? $post : ['status' => false];
    }

    /**
     * Permet de supprimer un article via son ID
     * @param Post $post : Contient l'article à supprimer
     */
    public function destroy(Post $post)
    {
        # dump( $post );
        return $post->delete() ? ['status' => true] : ['status' => false];
    }
}
