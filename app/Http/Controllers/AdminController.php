<?php

namespace Blog\Http\Controllers;

use Blog\Artigo;
use Blog\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $migalhas = json_encode([
            ["nome"=>"Admin","url"=>''],
        ]);

        $contArt = Artigo::count();
        $contUser = User::count();
        $contAutor = User::where('autor','=','S')->count();
        $contAdmin = User::where('admin','=','S')->count();

        return view('admin',compact('migalhas','contArt','contUser','contAutor','contAdmin'));
    }
}
