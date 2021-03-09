<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$post->slug}}</title>
    <link rel="stylesheet" href="{{asset('assets/css/post.css')}}">
</head>
<body>

    <div class="post-container">
        <div>
            <a href="/"><button class="blog-button">Blog</button></a>
            <a href="/painel"><button class="dashboard-button">Dashboard</button></a>
        </div>
        <div class="post-item">
            <div class="post-title">
                <h1>{!!$post->title!!}</h1>
            </div>
            <div class="post-body">
                <p>{!!$post->body!!}</p>
            </div>
        </div>
    </div>

</body>


</html>

