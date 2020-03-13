<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
    <title>Messenger - Responsive Bootstrap Application</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Template core CSS -->

    <link href="{{ asset('assets/template.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/template_002.css') }}" rel="stylesheet" media="(prefers-color-scheme: dark)">



</head>
<!-- Head -->

<body>

    <div id="app" class="layout">

        <!-- Navigation -->
        @include('nav.nav')
        <!-- Navigation -->

        <!-- Sidebar -->
        @include('sideBar.sideBar')
        <!-- Sidebar -->

        <!-- Main Content -->
        <div class="main main-visible" data-mobile-height="">

            <!-- Chat -->
            <div id="chat-1" class="chat dropzone-form-js" data-dz-url="some.php">

                <!-- Chat: body -->
                <chatgr user-id='{{ $chatkit_id }}' img-room="{{ $imgRoom }}" img-sender='{{ Auth::user()->avatar }}' room-id='{{ $roomId }}' room-name="{{ $roomName }}"  :initial-messages='@json($messages)'>
                </chatgr>
                <!-- Chat: body -->

            </div>
            <!-- Chat -->

        </div>
        <!-- Main Content -->

        <!-- Active Users: Sidebar -->

        <!-- Active Users: Sidebar -->

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

    <!-- Modal: Invite friends -->
    <div class="modal fade" id="invite-friends" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="media flex-fill">
                        <div class="icon-shape rounded-lg bg-primary text-white mr-5">
                            <i class="fe-users"></i>
                        </div>
                        <div class="media-body align-self-center">
                            <h5 class="modal-title">Invite friends</h5>
                            <p class="small">Invite colleagues, clients and friends.</p>
                        </div>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="invite-email" class="small">Email</label>
                            <input type="text" class="form-control form-control-lg" id="invite-email">
                        </div>

                        <div class="form-group mb-0">
                            <label for="invite-message" class="small">Invitation message</label>
                            <textarea class="form-control form-control-lg" id="invite-message" data-autosize="true"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-block btn-primary d-flex align-items-center">
                        Invite friend
                        <i class="fe-user-plus ml-auto"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal: Invite friends -->

    <!-- Scripts -->
    <script src="{{ asset('assets/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins.js') }}"></script>
    <script src="{{ asset('assets/template.js') }}"></script>
    <!-- Scripts -->

</body>

</html>
