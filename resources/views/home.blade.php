<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
</head>
<body>
    @auth
        <p> you are logged in !</p>
        <form method="POST" action="/logout">
            @csrf
            <button>Logout</button>
        </form>
        <div style="border: 2px solid black;margin: 5px;padding: 10px">
            <h1>Create a New Post</h1>
            <form method="POST" action="/create-post">
                @csrf
                <input  name="title" type="text">
                <textarea name="body" placeholder="body content..."></textarea>
                <button>Save Post</button>
            </form>
        </div>
        
        <div style="border: 2px solid black;margin: 5px;padding: 10px">
            <h2>All Posts</h2>
            @foreach ($posts as $post)
                <div style="background: gray;margin: 10px;padding:10px;">
                    <h3>{{$post['title']}}</h3><span style="color:aqua">By {{$post->users->name}}</span>
                    <p>
                        {{$post['body']}}
                    </p>
                    <a href="/edit-post/{{$post->id}}">edit</a>
                    <form action="/delete-post/{{$post->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
        @else
        <div style="border: 2px solid black;margin: 5px;padding: 10px">
            <h2>Resgister</h2>
            <form action="/register" method="POST">
                @csrf
                <input type="text" placeholder="Name" name="name" >
                <input type="text" placeholder="Email" name="email" >
                <input type="password" placeholder="Password" name="password" >
                <button>Resgister</button>
            </form>
        </div>
        <div style="border: 2px solid black;margin: 5px;padding: 10px">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input type="text" placeholder="Name" name="loginname" >
                <input type="password" placeholder="Password" name="loginpassword" >
                <button>login</button>
            </form>
        </div>
    @endauth
        
</body>
</html>