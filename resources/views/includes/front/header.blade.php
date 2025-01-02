<header class="site-header">
        <div class="container d-flex align-items-center">
            <div class="col-lg-2 brand-logo">
                <a href="http://192.168.9.32:19620/">
                <img src="{{ asset(config('settings.', 'uploads/logos/header_log.png')) }}" alt="Logo">
                </a>
            </div>
            <div class="col-lg-7">
                <nav class="main-menu">
                    <ul class="main-navigation"> 
                    <?php foreach ($navigation as $navItem): ?>
                        <li>
                            <a href="<?php echo app('url')->to($navItem->slug); ?>">
                                <?php echo $navItem->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 right-menu d-flex align-items-center justify-content-end">
                @auth
                    <a class="user-btn" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="svg-wrapper">
                            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                            </svg>
                        </span>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                @else

                    <a href="{{ route('login') }}" class="user-btn">Login
                        <span class="svg-wrapper">
                            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                            </svg>
                        </span>
                    </a>
                    <a href="{{ route('register') }}" class="user-btn">Sign up
                        <span class="svg-wrapper">
                            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.787 6.02812C16.071 5.73644 16.071 5.26355 15.787 4.97187L11.1586 0.218756C10.8746 -0.0729186 10.4142 -0.0729186 10.1301 0.218756C9.84612 0.510433 9.84612 0.983328 10.1301 1.27501L14.2442 5.49999L10.1301 9.72502C9.84612 10.0167 9.84612 10.4895 10.1301 10.7813C10.4142 11.0729 10.8746 11.0729 11.1586 10.7813L15.787 6.02812ZM0 6.24687H15.2727V4.75311H0V6.24687Z" fill="currentColor"/>
                            </svg>
                        </span>
                    </a>

                @endauth
            </div>
        </div>
    </header>
    <main>


    