@extends('layouts.st.common')
<link rel="stylesheet" href="{{ asset('css/st/interview/schedule/form_complete.css') }}">

@section('content')

<div id="app" class="container">
    @include('components.parts.page_title', ['title'=>'決済情報の登録・変更'])
    <div class="row">
        <div class="offset-sm-3 col-sm-6">
            <div class="card mb-4">
                <div class="card-body bg-light">
                    <div v-if="!isSubscribed">
                        <div class="form-group">
                            <select class="form-control" v-model="plan">
                                <option v-for="(value,key) in planOptions" :value="key" v-text="value"></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="cardHolderName" placeholder="名義人（半角ローマ字）">
                        </div>
                        <div class="form-group">
                            <div id="new-card" class="bg-white"></div>
                        </div>
                        <div class="form-group text-right">
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-secret="{{ $intent->client_secret }}"
                                @click="subscribe">
                                課金する
                            </button>
                        </div>
                    </div>
                    <div v-else-if="isSubscribed">
                        <div v-if="isCancelled">
                            キャンセル済みです。（終了：<span v-text="details.end_date"></span>）
                            <button class="btn btn-info" type="button" @click="resume">元に戻す</button>
                        </div>
                        <!-- 課金中 -->
                        <div v-else>
                            <div class="mb-3">サブスクリプション登録中です。</div>
                            <div class="form-group">
                                課金中のプラン： <span v-text="details.plan"></span>
                            </div>
                            <hr>
                            <div class="form-group">
                                <input type="text" class="form-control" v-model="cardHolderName" placeholder="名義人（半角ローマ字）">
                            </div>
                            <div class="form-group">
                                カード情報（下４桁）： <span v-text="details.card_last_four"></span>
                            </div>
                            <div class="form-group">
                                <div id="update-card" class="bg-white"></div><br>
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-secret="{{ $intent->client_secret }}"
                                    @click="updateCard">
                                    クレジットカードを変更する
                                </button>
                            </div>
                            <hr>
                            <button class="btn btn-warning" type="button" @click="cancel">サブスクリプション登録をやめる</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container form-wrapper" style="margin-top: 100px;">
      @include('components.parts.button.form.complete_button', ['upperRoute' => '/', 'upperText'=>'トップページに戻る', 'underRoute' => 'mypage', 'underText' => 'マイページに戻る', 'var' => ''])
</div>

@endsection
