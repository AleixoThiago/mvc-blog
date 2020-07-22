<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Http\Controllers\Controller;
use Blog\Artigo;
use Illuminate\Support\Facades\Auth;

class ArtigosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $migalhas = json_encode([
            ["nome"=>"Admin","url"=>route('admin')],
            ["nome"=>"Lista de Artigos","url"=>""]
        ]);

        $listaDeArtigos = Artigo::listaDeArtigos(5);

        return view('admin.artigos.index',compact('migalhas','listaDeArtigos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        $validacao = \Validator::make($data,[
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required"
        ]);

        if ($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        };

        $data['user_id'] = $user->id;
       
        Artigo::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Artigo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validacao = \Validator::make($data,[
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required"
        ]);

        if ($validacao->fails()){
            return redirect()->back()->withErrors($validacao)->withInput();
        };

        //dd($request->all());
       
        Artigo::find($id)->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Artigo::find($id)->delete();
        return redirect()->back();
    }
}
