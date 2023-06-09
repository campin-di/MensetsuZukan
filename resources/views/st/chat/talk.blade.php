@section('title', '人事とのチャット')
<link rel="stylesheet" href="{{ asset('css/st/chat/chat.css') }}">
@extends('layouts.st.common')
@section('content')
<script src="{{ asset('js/app.js') }}"></script>

@include('components.parts.page_title', ['title'=>$hrNickname])
<div id="chat">
    <div class="line__container" id="scroll">
        <div class="line__contents" id="scroll-inner">
            <div v-for="m in messages">
                <div class="line__content" v-bind:class="{'line__right':m.sender === 0}">
                    <div class="img-wrapper">
                        <img class="item_img" v-if="m.sender === 1" src="{{ asset($hrImgPath) }}">
                        <img class="item_img" v-else src="{{ asset($stImgPath) }}">
                    </div>
                    <div class="line__text">
                        <!-- メッセージ内容 -->
                        <div class="body-wrapper">
                            <div class="body-background">
                                <span style="white-space:pre-wrap;" v-text="m.body" class="body"></span>
                            </div>
                        </div>
                        <!-- 登録された日時 -->
                        <div class="line__date">
                            <span v-text="m.date" class="date"></span>
                            <span v-text="m.time" class="time"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--　▲会話エリア ここまで -->
    </div>
    <div class="line__message-wrapper">
        <div class="line__textarea">
            <textarea v-model="message" placeholder="メッセージを入力（※絵文字を使うと送信できません）"></textarea>
        </div>
        <div class="send-button-wrapper">
            <button type="button" @click="send()">
                <img class="item_img" src="{{ asset('img/icon/send.png') }}">
                <span>送信</span>
            </button>
        </div>
    </div>
</div>

<script>
    const hrId = @json($id);

    new Vue({
        el: '#chat',
        data: {
            message: '',
            messages: []
        },
        mounted: function(){
            this.getMessages();
            
            Echo.channel('chat')
                .listen('MessageCreated', (e) => {
                    this.getMessages(); // 全メッセージを再読込
                });
        },
        methods: {
            getMessages() {
                const url = '/ajax/chat';
                axios.get(url, {
                    params: {
                        id: hrId
                    }
                })
                    .then((response) => {
                        this.messages = response.data;
                        this.scroll();
                    });
            },
            send() {
                const url = '/ajax/chat';
                const params = { 
                    message: this.message,
                    hrId: hrId
                };
                this.message = '';
                axios.post(url, params)
                    .then((response) => {
                    });
            },
            scroll() {
                this.$nextTick(() => {
                    let scrollObj = document.getElementById('scroll');
                    scrollObj.scrollTop = scrollObj.scrollHeight;
                });
            },
            
        },
    });
</script>
@endsection
