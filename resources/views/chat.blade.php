  <!-- resources/views/chat.blade.php -->
  <!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Live Chat</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/chatbox.css') }}" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  </head>

  <body>
      @include('nav.nav')
      <div id="app" class="appchat">
          <div class="container-fluid">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Create Room</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form action="/gr/chat/create" method="POST">
                                  @csrf
                                  <div class="form-group">
                                      <label for="recipient-name" class="col-form-label">Room Name:</label>
                                      <input type="text" class="form-control" id="recipient-name" name="roomname" placeholder="Enter your room name...">
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Create</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="card max-height">
                          <div class="card-header" ><span class="custom">List Groups</span>
                              <a href="#" class="btn btn-primary" id="create" data-toggle="modal" data-target="#exampleModal">+</a>
                          </div>
                          <div class="card-body">
                              <div id="chatbox">
                                  <ul class="rooms">
                                      @foreach ($listRoom as $room)
                                      <li class="room" name="roomid" id="">
                                          {{-- {{  ($i == $roomName) ? 'active' : '' }} --}}
                                          {{-- <span class="pending"></span> --}}
                                          <div class="media">
                                              <div class="media-left">
                                                  <img src="https://image.flaticon.com/icons/svg/615/615075.svg" alt="" class="media-object">
                                              </div>
                                              <div class="media-body">
                                                  <a href="/gr/chat/{{ $room->id }}">
                                                      <p class="name">{{ $room->room_name }}</p>
                                                  </a>
                                              </div>
                                          </div>
                                      </li>
                                      @endforeach
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="card max-height">
                          <div class="card-header custom-2"> <span class="custom">Live Chat Room {{ $roomName }} </span> </div>
                          <chatgr
                          user-id='{{ $chatkit_id }}'
                          room-id='{{ $roomId }}'
                          :initial-messages='@json($messages)'>
                        </chatgr>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </body>

  </html>
