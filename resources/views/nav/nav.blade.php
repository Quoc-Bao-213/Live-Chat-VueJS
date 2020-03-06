<nav class="navbar  fixed-top navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="">
        <img src="https://image.flaticon.com/icons/svg/1029/1029183.svg" width="40" height="40" alt="">
        {{ Str::upper(Auth::user()->name) }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homepage') }}">Leave Chat Room <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homepage') }}"> ... <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homepage') }}">... <span class="sr-only">(current)</span></a>
            </li>
        </ul>
      </div>
  </nav>
