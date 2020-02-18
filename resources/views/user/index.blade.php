@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card-header">Lista de usuarios</div>
                    <form action="{{route('user.index')}}" method="GET" id="buscador">
                    <input type="text" id="search">
                    <input type="submit" value="Buscar">
                </form>
                <div class="card-body">
                    @foreach($users as $user)
                    <div class="data_profile">
                        @if($user->image)
                        <div class="avatar_container">
                            <img src="{{route('user.avatar',['filename' => $user->image])  }}" alt="" class="avatar">
                        </div>
                        @endif
                        <div class="info-user">
                            <h1>{{'@'.$user->nick}}</h1>
                            <h2>{{$user->name.' '.$user->surname}}</h2>
                            <span class="date">{{'Se unió: '.FormatTime::LongTimeFilter($user->created_at) }}</span><br>
                            <a class="btn btn-success btn-sm" href="{{route('profile', $user->id)}}">Ver perfil</a>
                            
                        </div>

                    </div>
                    <hr>
                    @endforeach
                </div>
            <div class="pagination ">
                {{$users->links()}}
            </div> 
        </div>
    </div>
</div>
@endsection
