@section('title', '学生とのチャット')
<link rel="stylesheet" href="{{ asset('css/st/chat/chat.css') }}">
@extends('layouts.hr.common')
@section('content')

@include('components.parts.page_title', ['title'=> $stNickname])
<div class="interview-reservation-wrapper">
    <a href="{{ route('hr.interview.schedule.form', $id) }}">面接予約</a>
</div>
<div id="chat">
    <div class="line__container" id="scroll">
        <div class="line__contents" id="scroll-inner">
            <div v-for="m in messages">
                <div class="line__content" v-bind:class="{'line__right':m.sender === 1}">
                    <div class="img-wrapper">
                        <img class="item_img" v-if="m.sender === 0" src="{{ asset($stImgPath) }}">
                        <img class="item_img" v-else src="{{ asset($hrImgPath) }}">
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
            @if($spFlag == TRUE)
                <textarea v-model="message" placeholder="メッセージを入力（メッセージ送信・受信後はページの再読み込みをお願いします。）"></textarea>
            @else
                <textarea v-model="message" placeholder="メッセージを入力"></textarea>
            @endif        
        </div>
        <div class="send-button-wrapper">
            <button type="button" @click="send()">
                <img class="item_img" src="{{ asset('img/icon/send.png') }}">
                <span>送信</span>
            </button>
        </div>
    </div>
</div>

@if($spFlag == TRUE)
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
@else
    <script src="{{ asset('js/app.js') }}"></script>
@endif

<script>
    const stId = @json($id);

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
                const url = '/hr/ajax/chat';
                axios.get(url, {
                    params: {
                        id: stId
                    }
                }).then((response) => {
                        this.messages = response.data;
                        this.scroll();
                });
            },
            send() {
                const url = '/hr/ajax/chat';
                const params = { 
                    message: this.message,
                    stId: stId
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
