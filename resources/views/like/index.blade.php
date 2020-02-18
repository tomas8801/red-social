@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card pub_image">
                <div class="card-header">Mis likes</div>
                @foreach($likes as $like)
                @include('includes.image', ['image' => $like->image])
                @endforeach
            </div>
            <div class="pagination">
                {{$likes->links()}}
            </div> 
        </div>
    </div>
</div>
</div>
@endsection
