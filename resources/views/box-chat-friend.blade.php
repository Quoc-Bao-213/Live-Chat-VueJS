<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
    <title>Messenger - Responsive Bootstrap Application</title>

    <!-- Template core CSS -->

    <link href="{{ asset('assets/template.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/template_002.css') }}" rel="stylesheet" media="(prefers-color-scheme: dark)">


</head>
<!-- Head -->

<body>

    <div class="layout">

        <!-- Navigation -->
        @include('nav.nav')
        <!-- Navigation -->

        <!-- Sidebar -->
        @include('sideBar.sideBar')
        <!-- Sidebar -->

        <!-- Main Content -->
        <div class="main main-visible" data-mobile-height="">

            <!-- Chat -->
            <div id="chat-2" class="chat dropzone-form-js" data-dz-url="some.php">

                <!-- Chat: body -->
                <div class="chat-body">

                    <!-- Chat: Header -->
                    <div class="chat-header border-bottom py-4 py-lg-6 px-lg-8">
                        <div class="container-xxl">

                            <div class="row align-items-center">

                                <!-- Close chat(mobile) -->
                                <div class="col-3 d-xl-none">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a class="text-muted px-0" href="#" data-chat="open">
                                                <i class="icon-md fe-chevron-left"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Chat photo -->
                                <div class="col-6 col-xl-6">
                                    <div class="media text-center text-xl-left">
                                        <div class="avatar avatar-sm avatar-online d-none d-lg-inline-block mr-5">
                                            <img src="{{ $avatar }}" class="avatar-img" alt="">
                                        </div>

                                        <div class="media-body align-self-center text-truncate">
                                            <h6 class="text-truncate mb-n1">{{ $friendName }}</h6>
                                            <span class="badge badge-dot badge-success d-inline-block d-xl-none mr-1"></span>
                                            <small class="text-muted">Online</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Chat toolbar -->
                                <div class="col-3 col-xl-6 text-right">
                                    <ul class="nav justify-content-end">
                                        <li class="nav-item list-inline-item d-none d-xl-block mr-3">
                                            <a class="nav-link text-muted px-3" data-toggle="collapse" data-target="#chat-2-search" href="#" title="Search this chat">
                                                <i class="icon-md fe-search"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div><!-- .row -->

                        </div>
                    </div>
                    <!-- Chat: Header -->

                    <!-- Chat: Search -->
                    <div class="collapse border-bottom px-lg-8" id="chat-2-search">
                        <div class="container-xxl py-4 py-lg-6">

                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Search this chat" aria-label="Search this chat">

                                <div class="input-group-append">
                                    <button class="btn btn-lg btn-ico btn-secondary btn-minimal" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Chat: Search -->

                    <!-- Chat: Content-->
                    <div class="chat-content px-lg-8">
                        <div class="container-xxl py-6 py-lg-10">

                            <!-- Message -->
                            <div class="message">
                                <!-- Avatar -->
                                <a class="avatar avatar-sm mr-4 mr-lg-5" href="#" data-chat-sidebar-toggle="#chat-2-info">
                                    <img class="avatar-img" src="assets/images/avatars/10.jpg" alt="">
                                </a>

                                <!-- Message: body -->
                                <div class="message-body">

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center">

                                            <!-- Message: content -->
                                            <div class="message-content bg-light">
                                                <h6 class="mb-2">Anna Bridges</h6>
                                                <div>Yeah, I'm going to meet a friend of mine at the department store. I have to buy some presents for my parents.</div>

                                                <div class="mt-1">
                                                    <small class="opacity-65">8 mins ago</small>
                                                </div>
                                            </div>
                                            <!-- Message: content -->

                                            <!-- Message: dropdown -->
                                            <div class="dropdown">
                                                <a class="text-muted opacity-60 ml-3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe-more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Edit <span class="ml-auto fe-edit-3"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Share <span class="ml-auto fe-share-2"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Delete <span class="ml-auto fe-trash-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Message: dropdown -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                </div>
                                <!-- Message: Body -->
                            </div>
                            <!-- Message -->

                            <!-- Message -->
                            <div class="message message-right">
                                <!-- Avatar -->
                                <div class="avatar avatar-sm ml-4 ml-lg-5 d-none d-lg-block">
                                    <img class="avatar-img" src="assets/images/avatars/12.jpg" alt="">
                                </div>

                                <!-- Message: body -->
                                <div class="message-body">

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center justify-content-end">

                                            <!-- Message: dropdown -->
                                            <div class="dropdown">
                                                <a class="text-muted opacity-60 mr-3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe-more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Edit <span class="ml-auto fe-edit-3"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Share <span class="ml-auto fe-share-2"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Delete <span class="ml-auto fe-trash-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Message: dropdown -->

                                            <!-- Message: content -->
                                            <div class="message-content bg-primary text-white">
                                                <div>Yeah, I'm going to meet a friend of mine at the department store. I have to buy some presents for my parents.</div>

                                                <div class="mt-1">
                                                    <small class="opacity-65">8 mins ago</small>
                                                </div>
                                            </div>
                                            <!-- Message: content -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center justify-content-end">

                                            <!-- Message: dropdown -->
                                            <div class="dropdown">
                                                <a class="text-muted opacity-60 mr-3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe-more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Edit <span class="ml-auto fe-edit-3"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Share <span class="ml-auto fe-share-2"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Delete <span class="ml-auto fe-trash-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Message: dropdown -->

                                            <!-- Message: content -->
                                            <div class="message-content bg-primary text-white">
                                                <div class="media">
                                                    <a href="#" class="icon-shape mr-5">
                                                        <i class="fe-paperclip"></i>
                                                    </a>
                                                    <div class="media-body overflow-hidden flex-fill">
                                                        <a href="#" class="d-block text-truncate font-medium text-reset">bootstrap.min.js</a>
                                                        <ul class="list-inline small mb-0">
                                                            <li class="list-inline-item">
                                                                <span class="t">79.2 KB</span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <span class="text-uppercase">js</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Message: content -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                </div>
                                <!-- Message: body -->
                            </div>
                            <!-- Message -->

                            <!-- Divider -->
                            <div class="message-divider my-9 mx-lg-5">
                                <div class="row align-items-center">

                                    <div class="col">
                                        <hr>
                                    </div>

                                    <div class="col-auto">
                                        <small class="text-muted">Today</small>
                                    </div>

                                    <div class="col">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <!-- Divider -->

                            <!-- Message -->
                            <div class="message">
                                <!-- Avatar -->
                                <a class="avatar avatar-sm mr-4 mr-lg-5" href="#" data-chat-sidebar-toggle="#chat-2-info">
                                    <img class="avatar-img" src="assets/images/avatars/10.jpg" alt="">
                                </a>

                                <!-- Message: body -->
                                <div class="message-body">

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center">

                                            <!-- Message: content -->
                                            <div class="message-content bg-light w-100">
                                                <h6 class="mb-2">Anna Bridges shared 3 photos:</h6>
                                                <div class="form-row py-3">
                                                    <div class="col">
                                                        <img class="img-fluid rounded" src="https://themes.2the.me/Boomerang/1.2/assets/images/team/1.jpg" data-action="zoom" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <img class="img-fluid rounded" src="https://themes.2the.me/Boomerang/1.2/assets/images/team/2.jpg" data-action="zoom" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <img class="img-fluid rounded" src="https://themes.2the.me/Boomerang/1.2/assets/images/team/3.jpg" data-action="zoom" alt="">
                                                    </div>
                                                </div>

                                                <div class="mt-1">
                                                    <small class="opacity-65">8 mins ago</small>
                                                </div>
                                            </div>
                                            <!-- Message: content -->

                                            <!-- Message: dropdown -->
                                            <div class="dropdown">
                                                <a class="text-muted opacity-60 ml-3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe-more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Edit <span class="ml-auto fe-edit-3"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Share <span class="ml-auto fe-share-2"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Delete <span class="ml-auto fe-trash-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Message: dropdown -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center">

                                            <!-- Message: content -->
                                            <div class="message-content bg-light">
                                                <div>Yeah, I'm going to meet a friend of mine at the department store. I have to buy some presents for my parents.</div>

                                                <div class="mt-1">
                                                    <small class="opacity-65">8 mins ago</small>
                                                </div>
                                            </div>
                                            <!-- Message: content -->

                                            <!-- Message: dropdown -->
                                            <div class="dropdown">
                                                <a class="text-muted opacity-60 ml-3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe-more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Edit <span class="ml-auto fe-edit-3"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Share <span class="ml-auto fe-share-2"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Delete <span class="ml-auto fe-trash-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Message: dropdown -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                </div>
                                <!-- Message: body -->
                            </div>
                            <!-- Message -->

                            <!-- Message -->
                            <div class="message message-right">
                                <!-- Avatar -->
                                <div class="avatar avatar-sm ml-4 ml-lg-5 d-none d-lg-block">
                                    <img class="avatar-img" src="assets/images/avatars/12.jpg" alt="">
                                </div>

                                <!-- Message: body -->
                                <div class="message-body">

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center justify-content-end">

                                            <!-- Message: dropdown -->
                                            <div class="dropdown">
                                                <a class="text-muted opacity-60 mr-3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe-more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Edit <span class="ml-auto fe-edit-3"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Share <span class="ml-auto fe-share-2"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Delete <span class="ml-auto fe-trash-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Message: dropdown -->

                                            <!-- Message: content -->
                                            <div class="message-content bg-primary text-white">
                                                <div>I'm going to meet a friend of mine at the department store. Yeah, I have to buy some presents for my parents.</div>

                                                <div class="mt-1">
                                                    <small class="opacity-65">8 mins ago</small>
                                                </div>
                                            </div>
                                            <!-- Message: content -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                </div>
                                <!-- Message: body -->
                            </div>
                            <!-- Message -->

                            <!-- Message -->
                            <div class="message">
                                <!-- Avatar -->
                                <a class="avatar avatar-sm mr-4 mr-lg-5" href="#" data-chat-sidebar-toggle="#chat-2-info">
                                    <img class="avatar-img" src="assets/images/avatars/10.jpg" alt="">
                                </a>

                                <!-- Message: body -->
                                <div class="message-body">

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center">

                                            <!-- Message: content -->
                                            <div class="message-content bg-light">
                                                <h6 class="mb-2">Anna Bridges</h6>
                                                <div>I'm going to meet a friend of mine at the department store. Yeah, I have to buy some presents for my parents.</div>

                                                <div class="mt-1">
                                                    <small class="opacity-65">8 mins ago</small>
                                                </div>
                                            </div>
                                            <!-- Message: content -->

                                            <!-- Message: dropdown -->
                                            <div class="dropdown">
                                                <a class="text-muted opacity-60 ml-3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe-more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Edit <span class="ml-auto fe-edit-3"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Share <span class="ml-auto fe-share-2"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Delete <span class="ml-auto fe-trash-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Message: dropdown -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                </div>
                                <!-- Message: body -->
                            </div>
                            <!-- Message -->

                            <!-- Message -->
                            <div class="message message-right">
                                <!-- Avatar -->
                                <div class="avatar avatar-sm ml-4 ml-lg-5 d-none d-lg-block">
                                    <img class="avatar-img" src="assets/images/avatars/12.jpg" alt="">
                                </div>

                                <!-- Message: body -->
                                <div class="message-body">

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center justify-content-end">

                                            <!-- Message: dropdown -->
                                            <div class="dropdown">
                                                <a class="text-muted opacity-60 mr-3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fe-more-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Edit <span class="ml-auto fe-edit-3"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Share <span class="ml-auto fe-share-2"></span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        Delete <span class="ml-auto fe-trash-2"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Message: dropdown -->

                                            <!-- Message: content -->
                                            <div class="message-content bg-primary text-white">
                                                <div>Yeah, I'm going to meet a friend of mine at the department store. I have to buy some presents for my parents.</div>

                                                <div class="mt-1">
                                                    <small class="opacity-65">8 mins ago</small>
                                                </div>
                                            </div>
                                            <!-- Message: content -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                </div>
                                <!-- Message: body -->
                            </div>
                            <!-- Message -->

                            <!-- Message: Typing -->
                            <div class="message">
                                <!-- Avatar -->
                                <a class="avatar avatar-sm mr-4 mr-lg-5" href="#" data-chat-sidebar-toggle="#chat-2-info">
                                    <img class="avatar-img" src="assets/images/avatars/10.jpg" alt="">
                                </a>

                                <!-- Message: body -->
                                <div class="message-body">

                                    <!-- Message: row -->
                                    <div class="message-row">
                                        <div class="d-flex align-items-center">

                                            <!-- Message: content -->
                                            <div class="message-content bg-light">
                                                <div>Anna is typing<span class="typing-dots"><span>.</span><span>.</span><span>.</span></span></div>
                                            </div>
                                            <!-- Message: content -->

                                        </div>
                                    </div>
                                    <!-- Message: row -->

                                </div>
                                <!-- Message: body -->
                            </div>
                            <!-- Message: Typing -->

                        </div>

                        <!-- Scroll to end -->
                        <div class="end-of-chat"></div>
                    </div>
                    <!-- Chat: Content -->

                    <!-- Chat: DropzoneJS container -->
                    <div class="chat-files hide-scrollbar px-lg-8">
                        <div class="container-xxl">
                            <div class="dropzone-previews-js form-row py-4"></div>
                        </div>
                    </div>
                    <!-- Chat: DropzoneJS container -->

                    <!-- Chat: Footer -->
                    <div class="chat-footer border-top py-4 py-lg-6 px-lg-8">
                        <div class="container-xxl">

                            <form id="chat-id-2-form" action="assets/php/upload.php" data-emoji-form="">
                                <div class="form-row align-items-center">
                                    <div class="col">
                                        <div class="input-group">

                                            <!-- Textarea -->
                                            <textarea id="chat-id-2-input" class="form-control bg-transparent border-0" placeholder="Type your message..." rows="1" data-emoji-input="" data-autosize="true"></textarea>

                                            <!-- Emoji button -->
                                            <div class="input-group-append">
                                                <button class="btn btn-ico btn-secondary btn-minimal bg-transparent border-0" type="button" data-emoji-btn="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile injected-svg">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                                        <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                        <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Upload button -->
                                            <div class="input-group-append">
                                                <button id="chat-upload-btn-2" class="btn btn-ico btn-secondary btn-minimal bg-transparent border-0 dropzone-button-js" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip injected-svg">
                                                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                                                    </svg> </button>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- Submit button -->
                                    <div class="col-auto">
                                        <button class="btn btn-ico btn-primary rounded-circle" type="submit">
                                            <span class="fe-send"></span>
                                        </button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                    <!-- Chat: Footer -->
                </div>
                <!-- Chat: body -->

            </div>
            <!-- Chat -->

        </div>
        <!-- Main Content -->

    </div>
    <!-- Layout -->

    <!-- DropzoneJS: Template -->
    <div id="dropzone-template-js">
        <div class="col-lg-4 my-3">
            <div class="card bg-light">
                <div class="card-body p-3">
                    <div class="media align-items-center">

                        <div class="dropzone-file-preview">
                            <div class="avatar avatar rounded bg-secondary text-basic-inverse d-block mr-5">
                                <i class="fe-paperclip"></i>
                            </div>
                        </div>

                        <div class="dropzone-image-preview">
                            <div class="avatar avatar mr-5">
                                <img src="#" class="avatar-img rounded" data-dz-thumbnail="" alt="">
                            </div>
                        </div>

                        <div class="media-body overflow-hidden">
                            <h6 class="text-truncate small mb-0" data-dz-name></h6>
                            <p class="extra-small" data-dz-size></p>
                        </div>

                        <div class="ml-5">
                            <a href="#" class="btn btn-sm btn-link text-decoration-none text-muted" data-dz-remove>
                                <i class="fe-x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- DropzoneJS: Template -->

    <!-- Scripts -->
    <script src="{{ asset('assets/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins.js') }}"></script>
    <script src="{{ asset('assets/template.js') }}"></script>
    <!-- Scripts -->

</body>

</html>
