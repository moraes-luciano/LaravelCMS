@extends('adminlte::page')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@stop

@section('title','Editar Página')

@section('content_header')

    <h1>Editar Página</h1>
    
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

            <form class="form-horizontal" method="POST" action="{{route('pages.update', ['page'=>$page->id])}}">
                @csrf
                @method('PUT')
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$page->title}}">
                    </div>
                </div>
        
        
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Corpo</label>
                    <div class="col-sm-10">
                        <textarea id="summernote" name="body" class="form-control bodyfield">{{$page->body}}</textarea>
                    </div>
                </div>
                

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Salvar" class="btn btn-success">
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

    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'textarea.bodyfield',
            height:300,
            menubar:false,
            plugins:['link','table','image','autoresize','lists'],
            toolbar:['undo redo | formatselect | bold italic backcolor |alignleft aligncenter alignright alignjustify | table | link image | bullist numlist'],
            content_css:[
                '{{asset('assets/css/content.css')}}',
            ],
            images_upload_url:'{{route('imageupload')}}',
            images_upload_credentials:true,
            convert_urls:false,
            entity_encoding : "raw",
             
        });

    </script> --}}



    
@endsection
    