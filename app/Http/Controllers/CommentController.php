<?php

namespace App\Http\Controllers;
use App\Comment;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function save(CreateCommentRequest $request){
        // almaceno los datos recogidos en el nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id  = \Auth::user()->id;
        $comment->image_id = $request->input('image_id');
        $comment->content  = $request->input('content');
        // guardar en la base de datos
        $comment->save();
        // redireccion
        return redirect()->route('image.details', $comment->image_id)
                         ->with('message','Comentario publicado');
    }
    
    public function delete($id){
        // conseguir datos del usuario logueado
        $user = \Auth::user();
        // conseguir objeto del comentario
        $comment = Comment::find($id);
        // comprobar si soy dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();
            
            return redirect()->route('image.details', $comment->image_id)
                             ->with('message','Comentario eliminado');
        }else{
            return redirect()->route('image.details', $comment->image_id)
                             ->with('message','No se pudo eliminar el comentario');
        }
    }
}
