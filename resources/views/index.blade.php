<!DOCTYPE html>
<html lang="en">
<!-- Head -->

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
    <title>Messenger - Responsive Bootstrap Application</title>

    <!-- Template core CSS -->

    <link href="{{ asset('assets/template.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/template_002.css') }}" rel="stylesheet" media="(prefers-color-scheme: dark)">

    <script src="https://unpkg.com/vue-emoji-picker/dist/vue-emoji-picker.js"></script>


</head>
<!-- Head -->

<body>

    <div class="layout">

        <!-- Navbar -->
        @include('nav.nav')
        <!-- Navbar -->

        <!-- Sidebar -->
        @include('default.default')
        <!-- Sidebar -->

        <!-- Main Content -->
        @include('sideBar.sideBar')
        <!-- Main Content -->

    </div>
    <!-- Layout -->

    <!-- DropzoneJS: Template -->

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
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="invite-email" class="small">Email</label>
                            <input class="form-control form-control-lg" id="invite-email" type="text">
                        </div>

                        <div class="form-group mb-0">
                            <label for="invite-message" class="small">Invitation message</label>
                            <textarea class="form-control form-control-lg" id="invite-message" data-autosize="true"
                                style="overflow: hidden; overflow-wrap: break-word; resize: none;"></textarea>
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
