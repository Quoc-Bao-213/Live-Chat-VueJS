<!-- resources/js/components/ChatBoxComponent.vue -->
<!-- <template>
    <div class="card-body">
        <div id="chatbox" v-if="users">
            <dl v-for="message in messages" :key="message.id">
                <div v-if="message.senderId == getcurrentUser" class="right-mess">
                    <i> ({{ formatTime(message.timestamp) }}) </i>
                    <dt v-if="message.id"> <strong>{{ findSender(message.senderId).name }}</strong></dt>
                    <img  v-if="message.image" :src="message.image" height="200">
                    <br>
                    <dd>{{ message.text }}</dd>
                </div>
                <div v-else class="left-mess">
                    <i> ({{ formatTime(message.timestamp) }}) </i>
                    <dt v-if="message.id"><strong>{{ findSender(message.senderId).name }}</strong></dt>
                    <img :src="message.image" height="200">
                    <br>
                    <dd> {{ message.text }}</dd>
                </div>
            </dl>
        </div>
        <div id="typing"></div>
        <hr>
        <div class="input-group">
            <input v-bind:class="[activeClass]" v-on:keyup="isTypingIn" type="text" v-model="message"
                @keyup.enter="sendMessage" class="form-control" placeholder="Type your message..." autofocus>
            <input type="file" accept="image/*" class="form-control-file" v-on:change="onImageChange" id="uploadimages">
            <div class="input-group-append">
                <button @click="sendMessage" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</template> -->

<template>
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
                            <div class="avatar avatar-sm d-none d-xl-inline-block mr-5">
                                <img v-bind:src="imgRoomVue" class="avatar-img" alt="">
                            </div>

                            <div class="media-body align-self-center text-truncate">
                                <h6 class="text-truncate mb-n1">{{ roomNameVue }}</h6>
                                <!-- Comming Soon -->
                                <small class="text-muted">35 members</small>
                                <small class="text-muted mx-2"> • </small>
                                <!-- Comming Soon -->
                                <small class="text-muted">HTML, CSS, and Javascript Help</small>
                            </div>
                        </div>
                    </div>

                    <!-- Chat toolbar -->
                    <!--<div class="col-3 col-xl-6 text-right">
                        <ul class="nav justify-content-end">
                            <li class="nav-item list-inline-item d-none d-xl-block mr-5">
                                <a class="nav-link text-muted px-3" data-toggle="collapse" data-target="#chat-1-search"
                                    href="#" title="Search this chat">
                                    <i class="icon-md fe-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>-->

                </div><!-- .row -->

            </div>
        </div>
        <!-- Chat: Header -->

        <!-- Chat: Search -->
        <!--<div class="collapse border-bottom px-lg-8" id="chat-1-search">
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
        </div> -->
        <!-- Chat: Search -->

        <!-- Chat: Content-->
        <div id="chatbox" v-if="users" class="chat-content px-lg-8">
            <div v-for="message in messages" :key="message.id" class="container-xxl py-6">

                <!-- Message -->
                <div v-if="message.senderId != getcurrentUser" class="message">
                    <!-- Avatar -->
                    <a class="avatar avatar-sm mr-4 mr-lg-5" href="#" data-chat-sidebar-toggle="#chat-1-user-profile">
                        <img class="avatar-img" src="https://i.picsum.photos/id/500/200/200.jpg" alt="">
                    </a>

                    <!-- Message: body -->
                    <div class="message-body">

                        <!-- Message: row -->
                        <div class="message-row">
                            <div class="d-flex align-items-center">

                                <!-- Message: content -->
                                <div style="max-width: 45%" class="message-content bg-light">
                                    <h6 class="mb-2">{{ findSender(message.senderId).name }}</h6>
                                    <div style="word-wrap:break-word;">{{ message.text }}</div>
                                    <img v-if="message.image" :src="message.image" height="200">
                                    <div class="mt-1">
                                        <small class="opacity-65">{{ formatTime(message.timestamp) }}</small>
                                    </div>
                                </div>
                                <!-- Message: content -->

                                <!-- Message: dropdown -->
                                <div class="dropdown">
                                    <a class="text-muted opacity-60 ml-3" href="#" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
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
                <div v-else class="message message-right">
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
                                    <div style="word-wrap:break-word;">{{ message.text }}</div>
                                    <img v-if="message.image" :src="message.image" height="200">
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
            <!-- Scroll to end -->
            <div class="end-of-chat"></div>
        </div>
        <!-- Chat: Content -->




        <!-- Chat: Footer -->
        <div class="chat-footer border-top py-4 py-lg-6 px-lg-8">
            <div class="container-xxl">

                <div id="chat-id-1-form" data-emoji-form>
                    <div class="form-row align-items-center">
                        <div class="col">
                            <div class="input-group">

                                <!-- Textarea -->
                                <input id="chat-id-1-input" class="form-control bg-transparent border-0"
                                    placeholder="Type your message..." v-on:keyup="isTypingIn" type="text"
                                    v-model="message" @keyup.enter="sendMessage" rows="1" data-emoji-input
                                    data-autosize="true" autofocus>

                                <!-- Emoji button -->
                                <div class="input-group-append">
                                    <button class="btn btn-ico btn-secondary btn-minimal bg-transparent border-0"
                                        type="button" data-emoji-btn>
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
                                    <!-- <input type="file" accept="image/*" class="form-control-file"
                                        v-on:change="onImageChange" id="uploadimages"> -->
                                    <span class="btn btn-file bg-transparent dropzone-button-js">
                                        <i style="font-size: 20px; padding-top: 1px; color: rgb(182, 182, 182); display: block;" class="fe-paperclip"></i> <input type="file" v-on:change="onImageChange" accept="image/*">
                                    </span>
                                    <!-- <button id="chat-upload-btn-1"
                                        class="btn btn-ico btn-secondary btn-minimal bg-transparent border-0 dropzone-button-js"
                                        type="button" accept="image/*" v-on:change="onImageChange">
                                        <i class="fe-paperclip"></i>
                                    </button> -->
                                </div>

                            </div>

                        </div>

                        <!-- Submit button -->
                        <div class="col-auto">
                            <button @click="sendMessage" class="btn btn-ico btn-primary rounded-circle">
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
            imgRoom: String,
            imgSender: String,
            roomName: String,
        },
        data() {
            return {
                activeClass: '',
                getcurrentUser: this.userId,
                message: '',
                messages: this.initialMessages,
                users: null,
                image: '',
                imgRoomVue: this.imgRoom,
                imgSenderVue: this.imgSender,
                roomNameVue: this.roomName,
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

                            // check image
                            if (message['parts'][1]) {
                                await this.messages.push({
                                    id: message.id,
                                    senderId: message.senderId,
                                    text: message['parts'][0]['payload']['content'],
                                    image: message['parts'][1]['payload']['url'],
                                    timestamp: message.createdAt,
                                })
                                this.image = null;
                                // console.log('dax xoa hinh');
                            }
                            else {
                                await this.messages.push({
                                    id: message.id,
                                    senderId: message.senderId,
                                    text: message['parts'][0]['payload']['content'],
                                    image: '',
                                    timestamp: message.createdAt
                                })
                            }

                            if (message.senderId != this.userId) {
                                // sound mess
                                // var audio = new Audio('/sound/facebook_sound.mp3');
                                // audio.play();
                                //
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
                            if (this.userId != this.currentUser) {
                                this.messages.push({
                                    text: `${user.name} joined ${this.formatTime(user.created_at)}`
                                })
                            }
                        },
                    },
                    messageLimit: 0
                })
            },
            // send image
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                console.log('ok');
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
                console.log(this.image);
            },
            // typing
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
                        // console.log(res['data']['body']);
                    });
            },
            sendMessage() {
                var isAttachment = false;

                if (this.message.trim() === '') {
                    // check when nothing type on input then set active input color red
                    this.activeClass = "btn-danger";
                    return;
                }

                var mess = this.message;
                this.message = "";

                // check image isset
                if (this.image) {
                    isAttachment = true;
                }

                axios.post(`${process.env.MIX_APP_URL}/api/message`, {
                    user: this.userId,
                    message: mess,
                    currentRoom: this.roomId,
                    isAttachment: isAttachment,
                    image: this.image
                })
                    .then(message => {
                        this.message = ''
                    })
            },
            findSender(senderId) {
                // console.log(this.users.find(user => senderId == user.id));
                if (this.users.find(user => senderId == user.id)) {
                    return this.users.find(user => senderId == user.id);
                } else {
                    return "";
                }
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

<style scoped>
    .btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    cursor: inherit;
    display: block;
}
/* span i:hover{
    color: #7f808c;
} */
</style>
