<ul class="nav flex-center position-ref full-height">
    <li class="nav-item">
       <a class="nav-link active" href="/fr"><h2>Chat With Friends.</h2></a>
    </li>
    <h2>|</h2>
    <li class="nav-item">
        <a class="nav-link" href="/gr"><h2>Chat With Our Groups.</h2></a>
        <form action="{{ url('/gr') }}" method="post">
            @csrf
            <div class="input-group">
                <input type="hidden" name="username" class="form-control"
            placeholder="Enter your username" value="long" required>
                    <input type="hidden"  name='roomid' value="1">

                    <button type="submit" class="btn btn-primary">
                      Join
                    </button>
            </div>
        </form>
    </li>
        @if (Session::has('chatkit_id'))
            <li>
            <div class="top-right links">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    Leave Chat Room
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
         </li>
        @endif
  </ul>
