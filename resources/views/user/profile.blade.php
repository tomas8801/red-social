@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="data_profile">
                @if($user->image)
                <div class="avatar_container">
                    <img src="{{route('user.avatar',['filename' => $user->image])  }}" alt="" class="avatar">
                </div>
                @endif
                <div class="info-user">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name.' '.$user->surname}}</h2>
                    <span class="date">{{'Se unió: '.FormatTime::LongTimeFilter($user->created_at) }}</span>
                </div>

            </div>

            <div class="my_images">
                @foreach($user->images as $image)
                <div class="image_box">
<!--                    <a class="venobox" href=""><img src="{{ route('image.file', ['filename' => $image->image_path])}}" alt="image alt"/></a>-->
                    <a class="venobox" data-gall="myGallery" href="image01-big.jpg"><img src="{{ route('image.file', ['filename' => $image->image_path])}}" /></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
