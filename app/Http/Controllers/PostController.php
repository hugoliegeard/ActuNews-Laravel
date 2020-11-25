<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

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
}
