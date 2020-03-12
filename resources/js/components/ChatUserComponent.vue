<template>
    <div v-if="users" class="chat-body">

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
                                <img v-bind:src="imgFriendVue" class="avatar-img" alt="">
                            </div>

                            <!-- Name -->
                            <div class="media-body align-self-center text-truncate">
                                <h6 class="text-truncate mb-n1">Name Here</h6>
                                <span class="badge badge-dot badge-success d-inline-block d-xl-none mr-1"></span>
                                <small class="text-muted">Online</small>
                            </div>

                        </div>
                    </div>

                    <!-- Chat toolbar -->
                    <div class="col-3 col-xl-6 text-right">
                        <ul class="nav justify-content-end">
                            <li class="nav-item list-inline-item d-none d-xl-block mr-3">
                                <a class="nav-link text-muted px-3" data-toggle="collapse" data-target="#chat-2-search"
                                    href="#" title="Search this chat">
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
                    <input type="text" class="form-control form-control-lg" placeholder="Search this chat"
                        aria-label="Search this chat">

                    <div class="input-group-append">
                        <button class="btn btn-lg btn-ico btn-secondary btn-minimal" type="submit">
                            <i class="fe-search"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Chat: Search -->

        <div id="chatbox" class="chat-content px-lg-8">
            <div class="container-xxl py-6 py-lg-10">
                <div v-for="message in messages" :key="message.id">

                    <!-- Message -->
                    <div style="margin-bottom: 1em;" v-if="message.senderId != getCurrentUser" class="message">
                        <!-- Avatar -->
                        <a class="avatar avatar-sm mr-4 mr-lg-5" href="#" data-chat-sidebar-toggle="#chat-2-info">
                            <img class="avatar-img" v-bind:src="imgFriendVue" alt="">
                        </a>

                        <!-- Message: body -->
                        <div class="message-body">

                            <!-- Message: row -->
                            <div class="message-row">
                                <div class="d-flex align-items-center">

                                    <!-- Message: content -->
                                    <div class="message-content bg-light">
                                        <h6 class="mb-2">{{ findSender(message.senderId).name }}</h6>
                                        <div>{{ message.text }}</div>

                                        <div class="mt-1">
                                            <small class="opacity-65">{{ formatTime(message.timestamp) }}</small>
                                        </div>
                                    </div>
                                    <!-- Message: content -->

                                    <!-- Message: dropdown -->
                                    <div class="dropdown">
                                        <a class="text-muted opacity-60 ml-3" href="#" data-target="#naruto"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fe-more-vertical"></i>
                                        </a>

                                        <div id="naruto" class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                Edit <span class="ml-auto fe-edit-3"></span>
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
                    <div style="margin-bottom: 1em;" v-else class="message message-right">
                        <!-- Avatar -->
                        <div class="avatar avatar-sm ml-4 ml-lg-5 d-none d-lg-block">
                            <img class="avatar-img" v-bind:src="imgSenderVue" alt="">
                        </div>

                        <!-- Message: body -->
                        <div class="message-body">

                            <!-- Message: row -->
                            <div class="message-row">
                                <div class="d-flex align-items-center justify-content-end">

                                    <!-- Message: dropdown -->
                                    <div class="dropdown">
                                        <a class="text-muted opacity-60 mr-3" href="#" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fe-more-vertical"></i>
                                        </a>

                                        <div class="dropdown-menu">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                Edit <span class="ml-auto fe-edit-3"></span>
                                            </a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                Delete <span class="ml-auto fe-trash-2"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Message: dropdown -->

                                    <!-- Message: content -->
                                    <div class="message-content bg-primary text-white">
                                        <div>{{ message.text }}</div>

                                        <div class="mt-1">
                                            <small class="opacity-65">{{ formatTime(message.timestamp) }}</small>
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
                </div>

                <div id="typing"></div>
            </div>

            <!-- Scroll to end -->
            <div class="end-of-chat"></div>
        </div>

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

                <div id="chat-id-2-form" data-emoji-form="">
                    <div class="form-row align-items-center">
                        <div class="col">
                            <div class="input-group">

                                <!-- input -->
                                <input id="chat-id-2-input" type="text" class="form-control bg-transparent border-0"
                                    placeholder="Type your message..." rows="1" data-emoji-input="" data-autosize="true"
                                    v-on:keyup="isTypingIn" @keyup.enter="sendMessage" v-model="message" autofocus>

                                <!-- Emoji button -->
                                <div class="input-group-append">
                                    <button class="btn btn-ico btn-secondary btn-minimal bg-transparent border-0"
                                        type="button" data-emoji-btn="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-smile injected-svg">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Upload button -->
                                <div class="input-group-append">
                                    <button id="chat-upload-btn-2"
                                        class="btn btn-ico btn-secondary btn-minimal bg-transparent border-0 dropzone-button-js"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-paperclip injected-svg">
                                            <path
                                                d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                                            </path>
                                        </svg> </button>
                                </div>

                            </div>

                        </div>

                        <!-- Submit button -->
                        <div class="col-auto">
                            <button class="btn btn-ico btn-primary rounded-circle" @click="sendMessage">
                                <span class="fe-send"></span>
                            </button>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- Chat: Footer -->
    </div>
</template>
<script>

    import axios from 'axios';
    import moment from 'moment';
    import Chatkit from '@pusher/chatkit-client';
    export default {
        props: {
            roomId: String,
            userId: String,
            initialMessages: Array,
            imgFriend: String,
            imgSender: String,
        },
        data() {
            return {
                getCurrentUser: this.userId,
                message: '',
                messages: this.initialMessages,
                users: null,
                imgFriendVue: this.imgFriend,
                imgSenderVue: this.imgSender,
            }
        },
        methods: {
            connectToChatkit() {
                const tokenProvider = new Chatkit.TokenProvider({
                    url: `${process.env.MIX_APP_URL}/api/authenticate`,
                });
                const chatManager = new Chatkit.ChatManager({
                    instanceLocator: process.env.MIX_CHATKIT_INSTANCE_LOCATOR,
                    userId: this.userId,
                    tokenProvider,
                });
                chatManager.connect()
                    .then(user => {
                        this.currentUser = user;
                        this.subscribeToRoom();
                        console.log('Connected Successfully')
                    })
                    .catch(error => {
                        console.log('Error on connection', error)
                    })
            },
            subscribeToRoom() {
                this.currentUser.subscribeToRoomMultipart({
                    roomId: this.roomId,
                    hooks: {
                        onUserStartedTyping: user => {
                            console.log(`User ${user.name} started typing`)
                            /// chat
                            var test = this.$el.querySelector("#typing")
                            test.innerHTML = `<img style="height: 30px" src="https://thumbs.gfycat.com/WavyViciousIrishdraughthorse-size_restricted.gif" alt="">`
                        },
                        onUserStoppedTyping: user => {
                            console.log(`User ${user.name} stopped typing`)
                            //unchat
                            var test = this.$el.querySelector("#typing")
                            test.innerHTML = ''
                        },
                        onMessage: async message => {
                            await this.messages.push({
                                id: message.id,
                                senderId: message.senderId,
                                text: message['parts'][0]['payload']['content'],
                                timestamp: message.createdAt
                            })

                            if (message.senderId != this.userId) {
                                // const Toast = Swal.mixin({
                                //     toast: true,
                                //     position: 'center-end',
                                //     showConfirmButton: false,
                                //     timer: 3000,
                                //     timerProgressBar: true,
                                //     onOpen: (toast) => {
                                //         toast.addEventListener('mouseenter', Swal.stopTimer)
                                //         toast.addEventListener('mouseleave', Swal.resumeTimer)
                                //     }
                                // })
                                // Toast.fire({
                                //     icon: 'success',
                                //     title: 'You have a Message!'
                                // })
                            }

                            await this.scrollToEnd();
                        },
                        onUserJoined: async user => {
                            await this.getUsers()
                            this.messages.push({
                                text: `${user.name} joined ${this.formatTime(user.created_at)}`
                            })
                        },
                    },
                    messageLimit: 0
                })
            },
            isTypingIn() {
                if (this.message.length > 0) {
                    this.currentUser.isTypingIn({ roomId: this.roomId })
                        .then(() => {
                            console.log('Success!')
                        })
                        .catch(err => {
                            console.log(`Error sending typing indicator: ${err}`)
                        })
                }
            },
            getUsers() {
                axios.get(`${process.env.MIX_APP_URL}/api/users`)
                    .then(res => {
                        this.users = res['data']['body']

                    });
            },
            sendMessage() {
                if (this.message.trim() === '') return;
                var mess = this.message;
                this.message = "";
                axios.post(`${process.env.MIX_APP_URL}/api/message`, {
                    user: this.userId,
                    message: mess,
                    currentRoom: this.roomId,
                })
                    .then(message => {
                        this.message = ''
                    });
            },
            findSender(senderId) {
                // console.log(this.users.find(user => senderId == user.id));
                if (this.users.find(user => senderId == user.id)) {
                    return this.users.find(user => senderId == user.id);
                } else {
                    return "";
                }
                //const sender = this.users.find(user => senderId == user.id);
            },
            scrollToEnd: function () {
                var container = this.$el.querySelector("#chatbox");
                container.scrollTop = (container.scrollHeight + 300);
            },
            formatTime(timestamp) {
                return moment(timestamp).fromNow();
            },
        },
        created() {
            this.getUsers();
            this.connectToChatkit();
        },
    };
</script>
