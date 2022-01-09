<h2 class="section-title">{{ $section_name }}</h2>

<style>
    /* === start:: 各セクションのタイトル部分 =======================*/
    .section-title {
        font-size: 18px;
        font-weight: 600;
        display: flex;
        align-items: center;/* 縦位置の調整 */
        justify-content: left;/* 横位置の調整 */
        margin-bottom: 25px;
    }

    .section-title::before,
    .section-title::after {
        content: '';
        flex-grow: 0.05;/* 少数にする */
    }

    /* 見出しの文字と横棒の間隔を開ける */
    .section-title::before {
        margin-right: 20px;
        width: 20px;
        height: 10px;
        border-radius: 3px;
        background: linear-gradient(to right, #7cc4ff, #9681ff);
    }

    .section-title::after {
        margin-left: 20px;
        width: 40%;
        height: 1px;
        background: #DDD;
    }
    /* === end:: 各セクションのタイトル部分 =======================*/

    @media screen and (min-width: 1024px) {
        .section-title{
            font-size: 22px;
        }

        .section-title::after {
            width: 70%;
        }
    }
</style>