@php
     $section = explode( '/', Request::path() );
    //
    $grclass = "";
    $frclass = "";

    if ($section[0] == 'group'){
        $grclass = 'active';
    }else{
        $frclass = 'active';
    }
@endphp

<div class="navigation navbar navbar-light justify-content-center py-xl-7">

    <!-- Brand -->
    <a href="#" class="d-none d-xl-block mb-6">
        <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 46 46" enable-background="new 0 0 46 46" xml:space="preserve" class="injected-svg mx-auto fill-primary" style="height: 46px;">
            <polygon opacity="0.7" points="45,11 36,11 35.5,1 "></polygon>
            <polygon points="35.5,1 25.4,14.1 39,21 "></polygon>
            <polygon opacity="0.4" points="17,9.8 39,21 17,26 "></polygon>
            <polygon opacity="0.7" points="2,12 17,26 17,9.8 "></polygon>
            <polygon opacity="0.7" points="17,26 39,21 28,36 "></polygon>
            <polygon points="28,36 4.5,44 17,26 "></polygon>
            <polygon points="17,26 1,26 10.8,20.1 "></polygon>
        </svg>
    </a>

    <!-- Menu -->
    <ul class="nav navbar-nav flex-row flex-xl-column flex-grow-1 justify-content-between justify-content-xl-center py-3 py-lg-0" role="tablist">

        <!-- Invisible item to center nav vertically -->
        <li class="nav-item d-none d-xl-block invisible flex-xl-grow-1">
            <a class="nav-link position-relative p-0 py-xl-3" href="#" title="">
                <i class="icon-lg fe-x"></i>
            </a>
        </li>

        <!-- Create group -->
        <li class="nav-item">
            <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#tab-content-create-chat" title="Create Group" role="tab">
                <i class="icon-lg fe-edit"></i>
            </a>
        </li>

        <!-- Chats Friend -->
        <li class="nav-item mt-xl-9">
            <a class="nav-link position-relative p-0 py-xl-3 {{ $frclass }}" data-toggle="tab" href="#tab-content-dialogs" title="Chat Friends" role="tab">
                <i class="icon-lg fe-message-square"></i>
            </a>
        </li>

        <!-- Chats Group -->
        <li class="nav-item mt-xl-9">
            <a class="nav-link position-relative p-0 py-xl-3 {{ $grclass }}" data-toggle="tab" href="#tab-content-group" title="Chat Group" role="tab">
                <i class="icon-lg fe-users mr-4" style="margin-left: 13px;"></i>
            </a>
        </li>

        <!-- Profile -->
        <li class="nav-item mt-xl-9" >
            <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#tab-content-user" title="My Profile" role="tab">
                <i class="icon-lg fe-user"></i>
            </a>
        </li>

        <li class="nav-item mt-xl-9 d-none d-xl-block invisible flex-xl-grow-1">
            <a class="nav-link position-relative p-0 py-xl-3" data-toggle="tab" href="#tab-content-demos" title="Demos" role="tab">
                <i class="icon-lg fe-layers"></i>
            </a>
        </li>

        <li class="nav-item mt-xl-9">
            <a class="nav-link position-relative p-0 invisible py-xl-3" href="#" title="Settings">
                <i class="icon-lg fe-settings"></i>
            </a>
        </li>

    </ul>
    <!-- Menu -->

</div>
