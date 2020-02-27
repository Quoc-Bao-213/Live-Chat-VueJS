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
         <li class="nav-item">
             <a class="nav-link active" href="{{ url('/fr/login') }}">
                 <h2>Chat With Friends</h2>
             </a>
         </li>
         <li>
             <h3 style="color: #3490dc">|</h3>
         </li>
         <li class="nav-item dropdown">
             <a class="nav-link" href="javascript:void(0)">
                 <h2>Chat With Our Groups</h2>
             </a>
             <ul>
                <li>
                    <form action="{{ url('/') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="username" class="form-control" placeholder="Enter your username" value="QuocBao" required>

                            <button type="submit" class="btn btn-primary">
                                Join
                            </button>
                        </div>
                    </form>
                </li>
             </ul>
         </li>
     </ul>
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script type="text/javascript">
     $(document).ready(function(){
        $('.dropdown a').click(function(){
            $('.dropdown ul').toggleClass('active')
        })
     });
    </script>
 </body>

 </html>
