 <!-- File: resources/views/welcome.blade.php -->
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Live Chat</title>
     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!-- Styles -->
     <style>
         html,
         body {
             background-color: #fff;
             color: #636b6f;
             font-family: 'Nunito', sans-serif;
             font-weight: 200;
             height: 100vh;
             margin: 0;
         }

         .full-height {
             height: 80vh;
         }

         .flex-center {
             align-items: center;
             display: flex;
             justify-content: center;
         }

         .position-ref {
             position: relative;
         }

         .top-right {
             position: absolute;
             right: 10px;
             top: 18px;
         }

         .content {
             text-align: center;
         }

         .title {
             font-size: 84px;
         }

         .m-b-md {
             margin-bottom: 30px;
         }

         li.dropdown{
             position: relative;
         }
         .dropdown ul{
             position: absolute;
             margin: 0;
             padding: 0;
             width: 100%;
             transform-origin: top;
             transform: perspective(1000px) rotateX(-90deg);
             transition: 0.5s;
         }
         .dropdown ul.active{
            transform: perspective(1000px) rotateX(0);
         }
         .dropdown ul li{
             list-style: none;
         }
         .dropdown ul li form{
             display: block;
             padding: 10px;
         }
     </style>
 </head>

 <body>
    <ul class="nav flex-center position-ref full-height ">
        <div class="top-right links">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-primary" value="logout">
            </form>
        </div>
        <li class="nav-item">
            <a class="nav-link active" href="{{ url('fr/'.Auth::user()->id_pusher) }}">
                <h2>Chat With Friends</h2>
            </a>
        </li>
        <li>
            <h3 style="color: #3490dc">|</h3>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="{{ url('gr/chat/1') }}">
                <h2>Chat With Our Groups</h2>
            </a>
        </li>
    </ul>
 </body>

 </html>
