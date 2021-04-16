<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/home.css')}}">
    <title>Laravel_Blog CMS</title>
</head>
<body>
    <div class="container">
        <div class="container-item">
           
            @if(Auth::guest())
                
                <div class="menu-guest">
                    <div class="welcome-container">
                        <h1>Bem vindo!</h1>
                        <h3>Este é um protótipo de blog com CMS integrado.</h3> 
                    </div>
                    <h3>Teste seu painel de recursos!</h3>
                    <div class="action-container">
                        <a class="login-button" href= "{{route('login')}}"><button>Login</button></a>
                        <a class="register-button" href="{{route('register')}}"><button>Cadastrar</button></a>
                    </div>
                </div>
 
            @else
                <div class="menu-user">
                    <div class="welcome-container">
                        <h1>Bem vindo, {{$userName}}! </h1> 
                        <h3>Este é um protótipo de blog com CMS integrado.</h3>
                    </div>
                    <div class="action-container">
                        <h3>Siga para seu painel de recursos!</h3>
                        <a class="dashboard-button" href="{{route('admin')}}"><button>Dashboard</button></a>
                    </div>
                   
 
                </div>
                   
            @endif
            
        </div>  
    </div>

    <div class="post-container">
        
        @foreach ($posts as $post)
            
            <div class="post-item">
                <a href="/artigo/{{$post->id}}">
                    <div class="post-head">
                        <h1>{!!$post->title!!}</h1>
                    </div>

                    <div class="post-body">
                        <p>{!!$post->body!!}</p>
                    </div>
                </a>
            </div>
                
        @endforeach
    
    </div>
    {{-- {{ $posts->links('pagination::bootstrap-4') }} --}}

        
    <script src={{asset('assets/js/clamp.js')}}></script>
    <script>
        let cardNumberLines = 3;
        let posts = document.getElementsByClassName("post-body");
        
        for(i=0;i<posts.length;i++){
            
            let checkLineForImg = posts[i].getElementsByTagName("img");
            
            if(checkLineForImg.length !=0){
                let thisLine = posts[i].querySelector('p img').closest('p');
                thisLine.style.display="none";
            }

            let checkEmptyLines = posts[i].querySelectorAll('p');
            for(j=0; j<checkEmptyLines.length;j++){
                if(checkEmptyLines[j].textContent.length<=1){
                    
                    checkEmptyLines[j].style.display='none';
                }
            }
            
            
            $clamp(posts[i], {clamp: 3});
        }
        
    </script>
</body>
</html>
