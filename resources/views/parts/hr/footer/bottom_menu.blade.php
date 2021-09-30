<footer>
	<nav class="bottom-sticky-nav">
		<ul>
			<li class="home">
				<a href="{{ url('/') }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/><path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"/></svg>
					<span>ホーム</span>
				</a>
			</li>
			<li class="mypage">
				<a href="{{ route('hr.interview.chat.list') }}">
					<svg fill="none" height="26" viewBox="0 0 27 26" width="27" xmlns="http://www.w3.org/2000/svg"><path d="M22 1H4.89999C2.79999 1 1.10001 2.70815 1.10001 4.81823V17.2778C1.10001 19.3878 2.79999 21.096 4.89999 21.096H14.8C15.2 21.096 15.5 21.1965 15.8 21.4979L19.1 24.8138C19.5 25.2157 20.1 24.9142 20.1 24.4118V22.5027C20.1 21.6989 20.7 21.096 21.5 21.096H22C24.1 21.096 25.8 19.3878 25.8 17.2778V4.81823C25.8 2.70815 24.1 1 22 1Z" stroke="#4F4F4F" stroke-miterlimit="10" stroke-width="2"/><path d="M7.39999 13.56C8.39411 13.56 9.2 12.7503 9.2 11.7514C9.2 10.7525 8.39411 9.94275 7.39999 9.94275C6.40588 9.94275 5.60001 10.7525 5.60001 11.7514C5.60001 12.7503 6.40588 13.56 7.39999 13.56Z" fill="#4F4F4F"/><path d="M13.5 13.56C14.4941 13.56 15.3 12.7503 15.3 11.7514C15.3 10.7525 14.4941 9.94275 13.5 9.94275C12.5059 9.94275 11.7 10.7525 11.7 11.7514C11.7 12.7503 12.5059 13.56 13.5 13.56Z" fill="#4F4F4F"/><path d="M19.5 13.56C20.4941 13.56 21.3 12.7503 21.3 11.7514C21.3 10.7525 20.4941 9.94275 19.5 9.94275C18.5059 9.94275 17.7 10.7525 17.7 11.7514C17.7 12.7503 18.5059 13.56 19.5 13.56Z" fill="#4F4F4F"/></svg>				
					<span>メッセージ</span>
				</a>
			</li>
			<li class="practice">
				<a href="{{ route('hr.interview.request') }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>					
					@if(isset($flag) && $flag > 0)
						<div class="circle-wrapper">
							<div class="circle">{{$flag}}</div>
						</div>
					@endif
				<span>申込確認</span>
				</a>
			</li>
			<li class="mypage">
				<a href="{{ route('hr.mypage') }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
					<span>マイページ</span>
				</a>
			</li>
		</ul>
	</nav>
</footer>