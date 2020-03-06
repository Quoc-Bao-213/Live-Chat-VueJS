  <!-- resources/js/components/ChatBoxComponent.vue -->

    <template>
      <div class="card-body">
          <!-- here iam: {{ getcurrentUser }} -->
        <div id="chatbox" v-if="users">
            <dl v-for="message in messages" :key="message.id">
                <div v-if="message.senderId == getcurrentUser" class="right-mess">
                    <i> ({{ formatTime(message.timestamp) }}) </i>
                    <dt v-if="message.id"> <strong>{{ findSender(message.senderId).name }}</strong></dt>
                    <dd>{{ message.text }}</dd>
                </div>
                <div v-else class="left-mess">
                    <i> ({{ formatTime(message.timestamp) }}) </i>
                    <dt style="right-mess" v-if="message.id"><strong>{{ findSender(message.senderId).name }}</strong></dt>
                    <dd>{{ message.text }}</dd>
                </div>
            </dl>
        </div>
        <hr>
        <div class="input-group">
            <input v-on:keyup="isTypingIn" type="text" v-model="message" @keyup.enter="sendMessage" class="form-control" placeholder="Type your message..." autofocus>
            <div class="input-group-append">
              <button @click="sendMessage" class="btn btn-primary">Send</button>
            </div>
        </div>
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
        },
        data () {
            // console.log(this.userId);
            return {
                getcurrentUser: this.userId,
                message: '',
                messages: this.initialMessages,
                users: null,
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
                        },
                        onUserStoppedTyping: user => {
                            console.log(`User ${user.name} stopped typing`)
                        },
                        onMessage: async message => {
                           await this.messages.push({
                                id: message.id,
                                senderId: message.senderId,
                                text: message['parts'][0]['payload']['content'],
                                timestamp: message.createdAt
                            })

                            if (message.senderId != this.userId){
                                // sound mess
                                var audio = new Audio('/sound/facebook_sound.mp3'); // path to file
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
                            this.messages.push({
                                text: `${user.name} joined ${this.formatTime(user.created_at)}`
                            })
                        },
                    },
                    messageLimit: 0
                })
            },
            isTypingIn() {
                if (this.message.length > 0){
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
                axios.get(`${process.env.MIX_APP_URL}/fr/api/users`)
                    .then(res => {
                        this.users = res['data']['body']
                        // console.log(res['data']['body']);
                    });
            },
            sendMessage() {
                if (this.message.trim() === '') return;
                var mess = this.message;
                this.message = "";
                axios.post( `${process.env.MIX_APP_URL}/fr/api/message`, {
                    user: this.userId,
                    message: mess,
                    currentRoom: this.roomId,
                })
                .then(message => {
                    this.message = ''
                });
            },
            findSender(senderId){
                // console.log(this.users.find(user => senderId == user.id));

                if (this.users.find(user => senderId == user.id)){
                     return this.users.find(user => senderId == user.id);
                }else{
                    return "";
                }

                //const sender = this.users.find(user => senderId == user.id);

            },
            scrollToEnd() {
                var container = this.$el.querySelector("#chatbox");
                container.scrollTop = (container.scrollHeight+300);
             // console.log(container.scrollHeight+1000);
            },
            formatTime(timestamp) {
               return moment(timestamp).fromNow();
            },
        },
        created () {
            this.getUsers();
            this.connectToChatkit();
        },
    };
    </script>
    <style>

    </style>
