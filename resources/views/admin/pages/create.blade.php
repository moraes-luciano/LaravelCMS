@extends('adminlte::page')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@stop



@section('title','Nova Página')

@section('content_header')

    <h1>Nova Página</h1>
    
@endsection

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                <h5>
                    <i class="icon fas fa-ban"></i>
                    Alerta
                </h5>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
      
        <div class="card-body">

            <form class="form-horizontal" method="POST" action="{{route('pages.store')}}">
                @csrf
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Corpo</label>
                    <div class="col-sm-10">
                        <textarea id="summernote" name="body" class="form-control bodyfield">{{old('body')}}</textarea>
                    </div>
                </div>      
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Criar" class="btn btn-success">
                    </div>
                </div>

            </form>

        </div>

    </div>
    
    @section('js')
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
        <script src={{asset("/assets/js/langs/summernote-pt-BR.js")}}></script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    toolbar: [
                    // [groupName, [list of button]]
                        ['misc',['undo','redo']],
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['insert',['link','picture','table','video']],
                    ],
                    lang: 'pt-BR'
                });
            });
            
        </script>
    @stop
    
@endsection
    