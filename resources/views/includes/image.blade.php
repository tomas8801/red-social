<div class="card-body">
    <div class="data_user">
        @if($image->user['image'])
        <div class="avatar_container">
            <img src="{{route('user.avatar',['filename' => $image->user['image']])  }}" alt="" class="avatar">
        </div>
        @endif
        <a href="{{route('profile', ['id'=>$image->user['id']])}}">
            <strong>{{ $image->user['name'].' '.$image->user['surname'] }}</strong>
            <span class="nick">{{' | @'.$image->user['nick']}}</span>
        </a>
    </div>
    <div class="image_box">
        <img src="{{ route('image.file', ['filename' => $image->image_path])}}" alt="">
    </div>
    <div class="likes">

        <!-- Comprobar si el usuario le dio like a la imagen -->
                        <?php $user_like = false;?>
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
    <div class="description">
        {{ $image->description }}
    </div>
    <a href="{{route('image.details', ['id'=>$image->id])}}">Comentarios ({{count($image->comments)}})</a>
</div>