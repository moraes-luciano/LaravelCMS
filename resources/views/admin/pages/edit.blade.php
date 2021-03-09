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

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea.bodyfield',
            language: 'pt_BR',
            height:300,
            menubar:false,
            plugins:['link','table','image','autoresize','lists'],
            toolbar:['undo redo | styleselect | bold italic underline backcolor | fontsizeselect |alignleft aligncenter alignright alignjustify | table | link image | bullist numlist'],
            content_css:[
                '{{asset('assets/css/home.css')}}',
            ],
            images_upload_url:'{{route('imageupload')}}',
            images_upload_credentials:true,
            convert_urls:false,
            entity_encoding: 'raw',

            style_formats: [
                { title: "Texto"},
                { title: "Title", block: "h1" },
                { title: "Paragraph", block: "p" },
                { title: "Media & Texto"},
                {
                    title: 'Texto à Esquerda',
                    selector: 'img',
                    styles: {
                        'float': 'left', 
                        'margin': '0 10px 0 10px'
                    }
                },
                {
                    title: 'Texto à Direita',
                    selector: 'img', 
                    styles: {
                        'float': 'right', 
                        'margin': '0 0 10px 10px'
                    }
                }
            ],

            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt 48pt 54pt 62pt 68pt 72pt",
             
        });
    </script>

@endsection
    