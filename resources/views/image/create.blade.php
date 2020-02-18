@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear nueva imagen</div>

                <div class="card-body">
                    <form action="{{ route('image.save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="image_path" class="col-md-4 text-md-right">Imagen</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image_path" required>
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
                                <textarea class="form-control" name="description"></textarea>
                                @if($errors->has('description'))
                                <div>
                                    {{ $errors->first('description')}}
                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Subir" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection