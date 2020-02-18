@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar publicacion</div>

                <div class="card-body">
                    <form action="{{ route('image.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="image_id" value="{{$image->id}}"/>
                        <div class="form-group row">
                            <label for="image_path" class="col-md-4 text-md-right">Imagen</label>
                            <div class="col-md-6">
                                @if($image->user->image)
                                <div class="form_avatar">
                                    <img src="{{route('image.file',$image->image_path)}}" alt="">
                                </div> 
                                @endif
                                <input type="file" class="form-control" name="image_path"/>
                                @if($errors->has('image_path'))
                                <div>
                                    {{ $errors->first('image_path')}}
                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 text-md-right">Descripcion</label>
                            <div class="col-md-6" >
                                <textarea class="form-control" name="description">{{$image->description}}</textarea>
                                @if($errors->has('description'))
                                <div>
                                    {{ $errors->first('description')}}
                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Subir" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
