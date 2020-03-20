<template>
    <div class="chat-body" @click="selected = undefined" >

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
                                <small class="text-muted" @click="scrollToEnd">{{ countMemberVue }} members</small>
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
            <div v-for="(message, index) in messages" :key="message.id" class="container-xxl py-6">

                <!-- Message -->
                <div v-if="message.senderId != getcurrentUser" class="message">
                    <!-- Avatar -->
                    <a class="avatar avatar-sm mr-4 mr-lg-5" href="#" data-chat-sidebar-toggle="#chat-1-user-profile">
                        <img class="avatar-img" :src="findAvt(message.senderId)" alt="">
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
                                    <img v-if="message.image" style="width: 100%" :src="message.image" height="200">
                                    <div class="mt-1">
                                        <small class="opacity-65">{{ formatTime(message.timestamp) }}</small>
                                    </div>
                                </div>
                                <!-- Message: content -->

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
                        <img class="avatar-img" :src="findAvt(message.senderId)" alt="">
                    </div>

                    <!-- Message: body -->
                    <div class="message-body">

                        <!-- Message: row -->
                        <div class="message-row">
                            <div class="d-flex align-items-center justify-content-end">

                                <!-- Message: dropdown -->
                                <div class="dropdown">
                                    <a class="text-muted opacity-60 mr-3" href="#" data-toggle="dropdown" @click="selected = index">
                                        <i class="fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu" x-placement="bottom-start" :class="{show:index == selected}">
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            Edit <span class="ml-auto fe-edit-3"></span>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            Share <span class="ml-auto fe-share-2"></span>
                                        </a>
                                        <button class="dropdown-item d-flex align-items-center" @click="deleteMessage(index, message.id)">
                                            Delete <span class="ml-auto fe-trash-2"></span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Message: dropdown -->

                                <!-- Message: content -->
                                <div style="max-width: 45%" class="message-content bg-primary text-white">
                                    <div style="word-wrap:break-word;">{{ message.text }}</div>
                                    <img v-if="message.image" style="width: 100%" :src="message.image" height="200">
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

                <div id="chat-id-1-form">
                    <div class="form-row align-items-center">
                        <div class="col">
                            <div class="input-group">

                                <!-- Textarea -->
                                <input id="chat-id-1-input" class="form-control bg-transparent border-0"
                                    placeholder="Type your message..." v-on:keyup="isTypingIn" type="text"
                                    v-model="message" @keyup.enter="sendMessage" rows="1"
                                    data-autosize="true" autofocus>

                                <!-- Emoji button -->
                                <div class="input-group-append" style="position: relative">
                                     <VEmojiPicker style="position: absolute; bottom: 50px; right: -137px;"
                                    v-show="showDialog"
                                    labelSearch="Search"
                                    @select="onSelectEmoji"
                                    />
                                    <button class="btn btn-ico btn-secondary btn-minimal bg-transparent border-0"
                                        type="button" @click="toogleDialogEmoji">
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
    import VEmojiPicker from "v-emoji-picker";
    export default {
        components: {
            VEmojiPicker
        },
        props: {
            roomId: String,
            userId: String,
            initialMessages: Array,
            imgRoom: String,
            roomName: String,
            avatar: Array,
            countMember: String,
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
                roomNameVue: this.roomName,
                showDialog: false,
                selected: undefined,
                avatarVue: this.avatar,
                countMemberVue: this.countMember,
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
                        console.log(this.currentUser);
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
                            // chat
                            var test = document.getElementById("typing")
                            test.innerHTML = `<img style="height: 30px" src="https://thumbs.gfycat.com/WavyViciousIrishdraughthorse-size_restricted.gif" alt="">`
                        },
                        onUserStoppedTyping: user => {
                            console.log(`User ${user.name} stopped typing`)
                            //unchat
                            var test = document.getElementById("typing")
                            test.innerHTML = ''
                        },
                        onMessageDeleted: message => {

                            var deleteMessID = message;
                            this.messages.map(function(messages){
                                if (messages.id == deleteMessID ){
                                    return [
                                        messages.text = 'Message Have been Deleted.',
                                        messages.image = '',
                                    ];
                                }
                            });
                            // console.log('Hook Delete Here');
                        },
                        onMessage: async message => {
                            // console.log(this.userId);
                            // console.log(this.users.length);

                            // CHECK IMAGE
                            if (message['parts'][1]) {
                                await this.messages.push({
                                    id: message.id,
                                    senderId: message.senderId,
                                    text: message['parts'][0]['payload']['content'],
                                    image: message['parts'][1]['payload']['url'],
                                    timestamp: message.createdAt,
                                })
                                this.image = null;
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
            findAvt(senderid){
                // console.log(this.users);
                var atv = this.users.find(element => element.id == senderid);
                // console.log( atv.avatar );
                return atv.avatar;
            },
            // SEND IMAGE
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
            // EMOJI
            toogleDialogEmoji() {
                this.showDialog = !this.showDialog;
            },
            onSelectEmoji(emoji) {
                this.message += emoji.data;
            },
            // IS TYPING
            isTypingIn() {
                if (this.message.length > 0) {
                    this.currentUser.isTypingIn({ roomId: this.roomId })
                        .then(() => {
                            console.log('notificate typing Success!')
                        })
                        .catch(err => {
                            console.log(`Error sending typing indicator: ${err}`)
                        })
                }
            },
            deleteMessage(index, messageid){
                // console.log(this.users);
                // console.log('function delete here');
                this.selected = undefined
                //TODO call api delete id
                axios.post(`${process.env.MIX_APP_URL}/api/delmessage`, {
                    user: this.userId,
                    currentRoom: this.roomId,
                    messageid : messageid,
                    isAttachment: this.messages[index].image,
                })
                .then(message  => {
                       this.messages[index].text = 'Message Have been Deleted.';
                       this.messages[index].image = '';
                })
                // console.log(this.messages[index].imgage);

                // console.log(this.messages[index].id); // id message
                // console.log(index) // KEY

            },
            getUsers() {
                axios.get(`${process.env.MIX_APP_URL}/api/users`)
                    .then(res => {
                        this.users = res['data']['body']
                        console.log(res);
                    });
            },
            sendMessage() {
                console.log('sent here 1');
                // check attachment first
                var isAttachment = false;

                var mess = this.message;
                this.message = "";

                // check image isset
                if (this.image) {
                    console.log('sent here 2');

                    isAttachment = true;

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
                }else{
                    if (mess.trim() === '') {
                        console.log('sent here 3- without text');

                        return;
                    }
                    console.log('sent here 4');
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
                }
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
