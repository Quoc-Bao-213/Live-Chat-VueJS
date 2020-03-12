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
        },
        data() {
            return {
                activeClass: '',
                getcurrentUser: this.userId,
                message: '',
                messages: this.initialMessages,
                users: null,
                image: '',
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
                            test.innerHTML = `<span>${user.name} Typing...</span>`
                        },
                        onUserStoppedTyping: user => {
                            console.log(`User ${user.name} stopped typing`)
                            //un chat
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
                                console.log('dax xoa hinh');
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
                                var audio = new Audio('/sound/facebook_sound.mp3');
                                audio.play();
                                //
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'center-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    onOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })
                                Toast.fire({
                                    icon: 'success',
                                    title: 'You have a Message!'
                                })
                            }
                            await this.scrollToEnd();
                        },
                        onUserJoined: async user => {
                            await this.getUsers()
                            if(this.userId != this.currentUser)
                            {
                                this.messages.push({
                                    text: `${user.name} joined ${this.formatTime(user.created_at)}`
                                })
                            }
                        },
                    },
                    messageLimit: 10
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
                    this.activeClass = "active";
                    return;
                }
                var mess = this.message;
                this.message = "";
                // check image isset
                if (this.image) {
                    isAttachment = true;
                }
                axios.post( `${process.env.MIX_APP_URL}/api/message`, {
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
            scrollToEnd() {
                var container = this.$el.querySelector("#chatbox");
                container.scrollTop = (container.scrollHeight);
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

    </script>
