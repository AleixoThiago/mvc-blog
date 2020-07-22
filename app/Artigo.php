<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo','descricao','conteudo','data', 'user_id'];

    protected $dates = ['deleted_at'];

    public function users(){
        return $this->belongsTo('Blog\User','user_id');
    }

    public static function listaDeArtigos($paginate){

        // $listaDeArtigos = Artigo::select('id','titulo','descricao','user_id','data')->paginate(10);
        // foreach ($listaDeArtigos as $key => $value){
        //     $value->user_id = User::find($value->user_id)->name;
        //     unset($value->user);
        // }

        // $listaDeArtigos = DB::table('artigos')->join('users','users.id','=','artigos.user_id')->select('artigos.id','artigos.titulo','artigos.descricao','users.name','artigos.data')->whereNull('deleted_at')->paginate(5);

        $user = auth()->user();

        if($user->admin == 'S'){

        $listaDeArtigos = DB::table('artigos')
            ->join('users','users.id','=','artigos.user_id')
            ->select('artigos.id','artigos.titulo','artigos.descricao','users.name','artigos.data')
            ->whereNull('deleted_at')
            ->orderBy('data','DESC')
            ->paginate($paginate);
        }else{
            $listaDeArtigos = DB::table('artigos')
            ->join('users','users.id','=','artigos.user_id')
            ->select('artigos.id','artigos.titulo','artigos.descricao','users.name','artigos.data')
            ->whereNull('deleted_at')
            ->where('artigos.user_id','=',$user->id)
            ->orderBy('data','DESC')
            ->paginate($paginate);
        }
        return $listaDeArtigos;
    }

    public static function listaDeArtigosSite($paginate, $busca = null){

        if ($busca){
            $listaDeArtigosSite = DB::table('artigos')
                                ->join('users','users.id','=','artigos.user_id')
                                ->select('artigos.id','artigos.titulo','artigos.descricao','artigos.conteudo','users.name as autor','artigos.data')
                                ->whereNull('deleted_at')
                                ->whereDate('data','<=',date('Y-m-d'))
                                ->where(function($query) use ($busca){
                                            $query->orWhere('titulo','like','%'.$busca.'%')
                                                ->orWhere('descricao','like','%'.$busca.'%')
                                                ->orWhere('conteudo','like','%'.$busca.'%');
                                        })
                                ->orderBy('data','DESC')
                                ->paginate($paginate);
        }else{

            $listaDeArtigosSite = DB::table('artigos')
                                ->join('users','users.id','=','artigos.user_id')
                                ->select('artigos.id','artigos.titulo','artigos.descricao','artigos.conteudo','users.name as autor','artigos.data')
                                ->whereNull('deleted_at')
                                ->whereDate('data','<=',date('Y-m-d'))
                                ->orderBy('data','DESC')
                                ->paginate($paginate);
        }
        return $listaDeArtigosSite;
    }


}
