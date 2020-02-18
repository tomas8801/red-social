@if(Auth::user()->image)
<div class="avatar_container">
<img src="{{route('user.avatar',['filename' => Auth::user()->image])  }}" alt="" class="avatar">
</div>
@endif

