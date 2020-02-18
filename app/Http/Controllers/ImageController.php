<?php

namespace App\Http\Controllers;

use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateImageRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class ImageController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view('image.create');
    }

    public function save(Requests\CreateImageRequest $request) {
        $image = new Image();
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $image->user_id = \Auth::user()->id;
        $image->description = $description;
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->save();

        return redirect()->route('home')->with(['message' => 'Imagen subida correctamente']);
    }

    public function getImage($filename) {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function details($id) {
        $image = Image::find($id);
        return view('image.details', compact('image'));
    }

    public function delete($id) {
        $user = \Auth::user();
        $image = Image::find($id);
        $likes = Like::where('image_id', $id)->get();
        $comments = Comment::where('image_id', $id)->get();

        if ($user && $image && $user->id == $image->user_id) {
            //primero borrar comentarios de esa imagen
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            //segundo borrar likes de esa imagen
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            //tercero borrar fichero de la imagen
            Storage::disk('images')->delete($image->image_path);
            
            //cuarto borrar registro de la imagen
            $image->delete();
            $message = array('message' => 'La imagen se elimino correctamente.');
        }else {
            $message = array('message' => 'La imagen no se pudo eliminar.');
        }
        return redirect()->route('home')->with($message);
    }
    
    public function edit($id){
        $user = \Auth::user();
        $image = Image::find($id);
        
        if($user && $image && $image->user->id == $user->id){
            return view('image.edit', compact('image'));
        }else{
            return redirect()->route('home');
        }     
    }
    
    public function update(Requests\UpdateImageRequest $request){
        //recogemos los datos del formulario
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');
        
        //conseguir objeto imagen
        $image = Image::find($image_id);
        $image->description = $description;
        
        //subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        //actualizar registro
        $image->update();
        
        return redirect()->route('image.details', $image_id)
                         ->with(['message' => 'Publicacion actualizada con exito']);
    }

}
