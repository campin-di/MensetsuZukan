<footer>
	<nav class="bottom-sticky-nav">
		<ul>
			<li class="home">
				<a href="{{ url('/') }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/><path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"/></svg>
					<span>ホーム</span>
				</a>
			</li>
			<li class="practice">
				<a href="{{ route('hr.interview.schedule.request') }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>					
					@if(isset($flag) && $flag > 0)
						<div class="circle-wrapper">
							<div class="circle">{{$flag}}</div>
						</div>
					@endif
				<span>面接確認</span>
				</a>
			</li>
			<li class="mypage">
				<a href="{{ route('hr.mypage') }}">
					<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
					<span>マイページ</span>
				</a>
			</li>
			<li class="logout">
				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">					<svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><g fill="none" fill-rule="evenodd"><path d="M18 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8c0-1.1.9-2 2-2h5M15 3h6v6M10 14L20.2 3.8"/></g></svg>				
					<span>ログアウト</span>
				</a>
			</li>
		</ul>
	</nav>
</footer>