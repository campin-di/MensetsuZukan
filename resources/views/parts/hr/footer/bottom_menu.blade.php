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
			@if(Auth::guard('hr')->user()->plan != 'offer')
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
			@else
			<li class="practice">
				<a href="{{ route('hr.offer.search') }}">
					<svg height="100%" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 24 24" width="100%" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Icon"><path d="M6.599,9.75l4.1,-6.151c0.291,-0.436 0.762,-0.719 1.284,-0.771c0.522,-0.052 1.039,0.133 1.41,0.504c0.063,0.064 0.128,0.129 0.195,0.195c1.39,1.39 1.78,3.492 0.982,5.288c-0.089,0.199 -0.176,0.396 -0.26,0.583c-0.034,0.078 -0.027,0.167 0.019,0.238c0.046,0.071 0.125,0.114 0.21,0.114c1.145,-0 2.73,-0 4.044,-0c0.82,-0 1.596,0.365 2.119,0.997c0.522,0.631 0.736,1.463 0.583,2.268c-0.378,1.984 -0.907,4.76 -1.239,6.5c-0.247,1.297 -1.381,2.235 -2.701,2.235l-12.345,0c-0.729,0 -1.429,-0.29 -1.945,-0.805c-0.515,-0.516 -0.805,-1.216 -0.805,-1.945c-0,-1.866 -0,-4.634 0,-6.5c-0,-0.729 0.29,-1.429 0.805,-1.945c0.516,-0.515 1.216,-0.805 1.945,-0.805l1.599,0Zm-0.349,1.5l-1.25,0c-0.332,0 -0.649,0.132 -0.884,0.366c-0.234,0.235 -0.366,0.552 -0.366,0.884c-0,1.866 -0,4.634 -0,6.5c-0,0.332 0.132,0.649 0.366,0.884c0.235,0.234 0.552,0.366 0.884,0.366l1.25,0l-0,-9Zm1.5,9l9.595,-0c0.6,-0 1.116,-0.427 1.228,-1.016c0.331,-1.74 0.86,-4.516 1.238,-6.5c0.07,-0.366 -0.027,-0.744 -0.265,-1.031c-0.237,-0.287 -0.59,-0.453 -0.963,-0.453c-1.314,-0 -2.899,-0 -4.044,0c-0.593,0 -1.145,-0.3 -1.468,-0.796c-0.322,-0.497 -0.372,-1.123 -0.131,-1.665c0.083,-0.187 0.17,-0.384 0.259,-0.583c0.546,-1.229 0.279,-2.667 -0.672,-3.618c-0.066,-0.067 -0.131,-0.132 -0.195,-0.195c-0.053,-0.053 -0.127,-0.08 -0.201,-0.072c-0.075,0.007 -0.142,0.048 -0.184,0.11l-4.197,6.296l-0,9.523Z"/></g></svg>				<span>オファー</span>
				</a>
			</li>
			@endif
			<li class="mypage">
				<a href="{{ route('hr.mypage') }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
					<span>マイページ</span>
				</a>
			</li>
		</ul>
	</nav>
</footer>