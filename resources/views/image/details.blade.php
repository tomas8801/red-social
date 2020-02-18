@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pub_image">
                <div class="card-body">
                    <div class="data_user">
                        @if($image->user['image'])
                        <div class="avatar_container">
                            <img src="{{route('user.avatar',['filename' => $image->user['image']])  }}" alt="" class="avatar">
                        </div>
                        @endif
                        <strong>{{ $image->user['name'].' '.$image->user['surname'] }}</strong>
                        <span class="nick">{{' | @'.$image->user['nick']}}</span>
                    </div>
                    <div class="image_detail">
                        <img src="{{ route('image.file', ['filename' => $image->image_path])}}" alt="">
                    </div>
                    <div class="likes">

                        <!-- Comprobar si el usuario le dio like a la imagen -->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?>
                        @endif
                        @endforeach

                        @if($user_like)
                        <img src="{{asset('img/heart-red.png')}}" class="btn-dislike" data-id="{{$image->id}}" alt="">
                        @else
                        <img src="{{asset('img/heart-grey.png')}}" class="btn-like" data-id="{{$image->id}}" alt="">
                        @endif
                        <span class="count-likes">{{count($image->likes)}}</span>
                        <span class="date">{{FormatTime::LongTimeFilter($image->created_at) }}</span>
                    </div>
                    @if(Auth::user() && Auth::user()->id == $image->user->id)
                    <div class="actions">
                        <a href="{{route('image.edit', $image->id)}}">Actualizar</a>
                        <!--                        <a href="{{route('image.delete', $image->id)}}">Borrar</a>-->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Eliminar</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿Estas seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Si borras la imagen no podras volver a recuperarla, ¿estas seguro?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
                                        <a href="{{route('image.delete', $image->id)}}" class="btn btn-danger btn-sm">Borrar</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="description">
                        {{ $image->description }}
                    </div>
                    <div class="comments">
                        <a href="#">Comentarios ({{count($image->comments)}})</a>

                        <form action="{{route('comment.save')}}" method="POST">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <p>
                                <textarea name="content" id="" class="form-control {{$errors->has('content') ? 'is-invalid' : '' }}"></textarea>
                                @if($errors->has('content'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </p>
                            <input type="submit" value="Comentar">
                        </form>
                        <hr>
                        @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif


                        @foreach($image->comments as $comment)
                        <div class="comment">             
                            <span class="nick">{{'@'.$comment->user->nick}}</span>
                            <span class="date">{{FormatTime::LongTimeFilter($comment->created_at) }}</span>
                            <a href="{{route('comment.delete', $comment->id )}}">Eliminar</a>
                            <p>{{ $comment->content }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
