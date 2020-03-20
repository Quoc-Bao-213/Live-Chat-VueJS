@php
     $section = explode('/', Request::path());
    //
    $grclass = "";
    $frclass = "";

    if ( $section[0] == 'group'){
        $grclass = 'show active';
    }else{
        $frclass = 'show active';
    }
@endphp

<div class="sidebar">
    <div class="tab-content h-100" role="tablist">
        {{-- Create Group --}}
        <div class="tab-pane fade h-100" id="tab-content-create-chat" role="tabpanel">
            <div class="d-flex flex-column h-100">

                <div class="hide-scrollbar">
                    <div class="container-fluid py-6">

                        <!-- Title -->
                        <h2 class="font-bold mb-6">Create Group</h2>
                        <!-- Title -->

                        <!-- Search -->
                        <form class="mb-6">
                            <div class="input-group">
                                <input class="form-control form-control-lg" placeholder="Search for messages or users..." aria-label="Search for messages or users..." type="text">
                                <div class="input-group-append">
                                    <button class="btn btn-lg btn-ico btn-secondary btn-minimal" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Search -->

                        <!-- Tabs -->
                        <ul class="nav nav-tabs nav-justified mb-6" role="tablist">
                            <li class="nav-item">
                                <a href="#create-group-details" class="nav-link active" data-toggle="tab" role="tab" aria-selected="true">Details</a>
                            </li>
                        </ul>
                        <!-- Tabs -->

                        <!-- Create chat -->
                        <div class="tab-content" role="tablist">

                            <!-- Chat details -->
                            <div id="create-group-details" class="tab-pane fade show active" role="tabpanel">
                                <form action="{{ route('createroom') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="small">Photo</label>
                                        <div class="position-relative text-center bg-secondary rounded p-6">
                                            <div class="avatar bg-primary text-white mb-5">
                                                <i class="icon-md fe-image"></i>
                                            </div>

                                            <p class="small text-muted mb-0">You can upload jpg, gif or png
                                                files. <br> Max file size 3mb. <br> </p>
                                            <input id="upload-chat-photo" class="d-none" name="uploadimg" accept="image/*" type="button">
                                            <label class="stretched-label mb-0" for="upload-chat-photo"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="small" for="new-chat-title">Name</label>
                                        <input class="form-control form-control-lg" name="roomname" id="new-chat-title" placeholder="Group Name" type="text">
                                    </div>

                                    {{-- Comming Soon --}}
                                    <div class="form-group">
                                        <label class="small" for="new-chat-topic">Topic (optional) (Comming Soon)</label>
                                        <input disabled class="form-control form-control-lg" name="new-chat-topic" id="new-chat-topic" placeholder="Group Topic" type="text">
                                    </div>

                                    <div class="form-group mb-0">
                                        <label class="small" for="new-chat-description">Description (Comming Soon)</label>
                                        <textarea disabled class="form-control form-control-lg" name="new-chat-description" id="new-chat-description" rows="6" placeholder="Group Description"></textarea>
                                    </div>
                                    {{-- Comming Soon --}}

                                    <!-- Button -->
                                    <div class="form-group mb-0" style="margin-top: 1%;">
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Create Group</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- Create chat -->

                    </div>
                </div>
            </div>
        </div>

        {{-- Chat Friend --}}
        <div class="tab-pane fade h-100 {{ $frclass }}" id="tab-content-dialogs" role="tabpanel">
            <div class="d-flex flex-column h-100">

                <div class="hide-scrollbar">
                    <div class="container-fluid py-6">

                        <!-- Title -->
                        <h2 class="font-bold mb-6">Chat Friends</h2>
                        <!-- Title -->

                        <!-- Search -->
                        <form class="mb-6">
                            <div class="input-group">
                                <input class="form-control form-control-lg" placeholder="Search for messages or users..." aria-label="Search for messages or users..." type="text">
                                <div class="input-group-append">
                                    <button class="btn btn-lg btn-ico btn-secondary btn-minimal" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Search -->

                        <!-- Chats -->
                        <nav class="nav d-block list-discussions-js mb-n6">
                            @foreach($listFriends as $friend)
                                @if ($friend->id_pusher != Auth::user()->id_pusher )
                                <!-- Chat link -->
                                <a class="text-reset nav-link p-0 mb-6" href="/friends/{{ $friend->id_pusher }}">
                                    <div class="card card-active-listener">
                                        <div class="card-body">

                                            <div class="media">

                                                <div class="avatar mr-5">
                                                    <img class="avatar-img" src="{{ $friend->avatar }}" alt="Bootstrap Themes">
                                                </div>

                                                <div class="media-body overflow-hidden">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <h6 class="text-truncate mb-0 mr-auto">{{ $friend->name }}</h6>
                                                        <p class="small text-muted text-nowrap ml-4">10:42 am</p>
                                                    </div>
                                                    <div class="text-truncate">Anna Bridges: Hey, Dude!</div>
                                                </div>
                                            </div>

                                        </div>


                                        {{-- <div class="badge badge-circle badge-primary badge-border-light badge-top-right">
                                            <span>3</span>
                                        </div> --}}

                                    </div>
                                </a>
                                <!-- Chat link -->
                                @endif
                            @endforeach

                        </nav>
                        <!-- Chats -->

                    </div>
                </div>

            </div>
        </div>

        {{-- Chat Group --}}
        <div class="tab-pane fade h-100 {{ $grclass }}" id="tab-content-group" role="tabpanel">
            <div class="d-flex flex-column h-100">

                <div class="hide-scrollbar">
                    <div class="container-fluid py-6">

                        <!-- Title -->
                        <h2 class="font-bold mb-6">Chat Group</h2>
                        <!-- Title -->

                        <!-- Search -->
                        <form class="mb-6">
                            <div class="input-group">
                                <input class="form-control form-control-lg" placeholder="Search for messages or users..." aria-label="Search for messages or users..." type="text">
                                <div class="input-group-append">
                                    <button class="btn btn-lg btn-ico btn-secondary btn-minimal" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Search -->

                        <!-- Chats -->
                        <nav class="nav d-block list-discussions-js mb-n6">
                            @foreach($listRooms as $room)
                                <!-- Chat link -->
                                <a class="text-reset nav-link p-0 mb-6" href="/group/{{ $room->id }}">
                                    <div class="card card-active-listener">
                                        <div class="card-body">

                                            <div class="media">

                                                <div class="avatar mr-5">
                                                    <img class="avatar-img" src="{{ asset($room->avatar_room) }}" alt="Bootstrap Themes">
                                                </div>

                                                <div class="media-body overflow-hidden">
                                                    <div class="d-flex align-items-center mb-1">
                                                        <h6 class="text-truncate mb-0 mr-auto">{{ $room->room_name }}</h6>
                                                        <p class="small text-muted text-nowrap ml-4">10:42 am</p>
                                                    </div>
                                                    <div class="text-truncate">Anna Bridges: Hey, Dude!</div>
                                                </div>
                                            </div>

                                        </div>


                                        {{-- <div class="badge badge-circle badge-primary badge-border-light badge-top-right">
                                            <span>3</span>
                                        </div> --}}

                                    </div>
                                </a>
                                <!-- Chat link -->
                            @endforeach

                        </nav>
                        <!-- Chats -->

                    </div>
                </div>

            </div>
        </div>

        {{-- My Profile --}}
        <div class="tab-pane fade h-100" id="tab-content-user" role="tabpanel">
            <div class="d-flex flex-column h-100">

                <div class="hide-scrollbar">
                    <div class="container-fluid py-6">

                        <!-- Title -->
                        <h2 class="font-bold mb-6">My Profile</h2>
                        <!-- Title -->

                        <!-- Search -->
                        <form class="mb-6">
                            <div class="input-group">
                                <input class="form-control form-control-lg" placeholder="Search for messages or users..." aria-label="Search for messages or users..." type="text">
                                <div class="input-group-append">
                                    <button class="btn btn-lg btn-ico btn-secondary btn-minimal" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- Search -->

                        <!-- Card -->
                        <div class="card mb-6">
                            <div class="card-body">
                                <div class="text-center py-6">
                                    <!-- Photo -->
                                    <div class="avatar avatar-xl mb-5">
                                        <img class="avatar-img" src="{{ Auth::user()->avatar }}" alt="">
                                    </div>

                                    <h5>{{ Auth::user()->name }}</h5>
                                    <p class="text-muted">Bootstrap is an open source toolkit for developing web
                                        with HTML.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card -->

                        <!-- Card -->
                        <div class="card mb-6">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 py-6">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <p class="small text-muted mb-0">Country</p>
                                                <p>Warsaw, Poland</p>
                                            </div>
                                            <i class="text-muted icon-sm fe-globe"></i>
                                        </div>
                                    </li>

                                    <li class="list-group-item px-0 py-6">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <p class="small text-muted mb-0">Phone</p>
                                                <p>+39 02 87 21 43 19</p>
                                            </div>
                                            <i class="text-muted icon-sm fe-mic"></i>
                                        </div>
                                    </li>

                                    <li class="list-group-item px-0 py-6">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <p class="small text-muted mb-0">Email</p>
                                                <p>{{ Auth::user()->email }}</p>
                                            </div>
                                            <i class="text-muted icon-sm fe-mail"></i>
                                        </div>
                                    </li>

                                    <li class="list-group-item px-0 py-6">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <p class="small text-muted mb-0">Create</p>
                                                <p>{{ Auth::user()->created_at }}</p>
                                            </div>
                                            <i class="text-muted icon-sm fe-clock"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Card -->

                        <!-- Card -->
                        <div class="card mb-6">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 py-6">
                                        <a href="#" class="media text-muted">
                                            <div class="media-body align-self-center">
                                                Twitter
                                            </div>
                                            <i class="icon-sm fe-twitter"></i>
                                        </a>
                                    </li>

                                    <li class="list-group-item px-0 py-6">
                                        <a href="https://www.facebook.com/QuocBao.2103" class="media text-muted">
                                            <div class="media-body align-self-center">
                                                Facebook
                                            </div>
                                            <i class="icon-sm fe-facebook"></i>
                                        </a>
                                    </li>

                                    <li class="list-group-item px-0 py-6">
                                        <a href="https://github.com/Quoc-Bao-213" class="media text-muted">
                                            <div class="media-body align-self-center">
                                                Github
                                            </div>
                                            <i class="icon-sm fe-github"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Card -->

                        <div class="form-row">
                            <div class="col">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <!-- Button -->
                                    <button type="submit" class="btn btn-lg btn-block btn-basic d-flex align-items-center">
                                        Logout
                                        <span class="fe-log-out ml-auto"></span>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
