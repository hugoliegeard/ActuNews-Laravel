<?php


namespace App\Http\Controllers;


class ContactController extends Controller
{
    /**
     * Permet d'afficher la page contact
     */
    public function contact()
    {
        return view('contact.contact');
    }
}
