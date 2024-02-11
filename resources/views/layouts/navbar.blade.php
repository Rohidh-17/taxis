<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                </div>
                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center gap-1">
                        <li class="nav-item dropdown dropdown-app">
                            <div class="dropdown-menu dropdown-menu-end p-0">
                                <div class="app-container p-2 my-2">
                                    <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="header-notifications-list">
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="header-message-list">									
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="user-box dropdown px-3">
                    <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (Auth::user()->image == null)
                            
                            {{-- <img src="{{asset('assets/images/avatars/avatar-2.png')}}" class="user-img" alt="user avatar"> --}}
                        @else
                            <img src="{{ asset('uploads/profile/' . Auth::user()->image) }}"
                            class="user-img" alt="user avatar" alt="no image"></td>
                        @endif
                        <br /><br />
                        <div class="user-info">
                            <p class="user-name mb-0"> <b>Welcome,</b> {{ Auth::user()->name }}</p>
                        </div>
                    </a>
                    
                </div>

                @if (auth()->check() && auth()->guard('web')->check())
                    <a href="/logout">Logout</a>
                @else
                    <a href="/driver/logout">Logout</a>
                @endif
              
            </nav>
        </div>
		</header>
    @endguest
</ul>







