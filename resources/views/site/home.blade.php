<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/content.css')}}">
    <title>Laravel_Blog CMS</title>
</head>
<body>
    <div class="container">
        <div class="container-item">
            <h1>Bem vindo!</h1>
            <h3>Este é um protótipo de blog com CMS integrado.
                <br><br>
                Teste seu painel de recursos!
                <a href= "{{route('login')}}"><button>Login</button></a>
                <a href="{{route('register')}}"><button>Cadastrar</button></a>
            </h3>
        </div>  
    </div>

    <div class="post-container">
        
        @foreach ($posts as $post)
            
            <div class="post-item">
                <a href="/artigo/{{$post->id}}">
                    <div class="post-head">
                        <h1>{{$post->title}}</h1>
                    </div>

                    <div class="post-body">
                        <p>{{$post->body}}</p>
                    </div>
                </a>
            </div>
                
        @endforeach
    
    </div>
    
</body>
</html>
