@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pub_image">
                <div class="card-header">Inicio</div>
                @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
                @endif
                @foreach($images as $image)
                    @include('includes.image', ['image' => $image])
                @endforeach
            </div>
            <div class="pagination">
                {{$images->links()}}
            </div> 
        </div>
    </div>
</div>
@endsection
