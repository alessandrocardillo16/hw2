<header>
    <div class="large large-header">
        <div class="sitebar-container">
            <a class="dnd-logo" href="{{ url('home') }}">
                <img src="{{ asset('assets/images/logo-178.png') }}" alt="">
            </a>
            <div class="site-interactions-groups">
                <div class="site-interactions-group site-interactions-group-search">
                    <div class="site-interactions-search">
                        <form class="search-form" action="">
                            <div class="search-logo">
                                <img class="search-button" src="{{ asset('assets/icons/search-grey.png') }}" alt="">
                            </div>
                            <input class="search-input" type="text" placeholder="Search Everything..." value="{{ $query ?? '' }}">
                        </form>
                    </div>
                </div>
                <div class="site-interactions-group site-interactions-group-social">
                    <div class="site-interactions-social">
                        <ul class="social-network-list">
                            <li class="social-network-item social-network-item-discord">
                                <a class="social-network-anchor" href="">
                                    <img class="social-network-logo" src="{{ asset('assets/icons/social_network/discord.png') }}" alt="">
                                </a>
                            </li>
                            <li class="social-network-item social-network-item-instagram">
                                <a class="social-network-anchor" href="">
                                    <img class="social-network-logo" src="{{ asset('assets/icons/social_network/instagram.png') }}" alt="">
                                </a>
                            </li>
                            <li class="social-network-item social-network-item-facebook">
                                <a class="social-network-anchor" href="">
                                    <img class="social-network-logo" src="{{ asset('assets/icons/social_network/facebook.png') }}" alt="">
                                </a>
                            </li>
                            <li class="social-network-item social-network-item-twitch">
                                <a class="social-network-anchor" href="">
                                    <img class="social-network-logo" src="{{ asset('assets/icons/social_network/twitch.png') }}" alt="">
                                </a>
                            </li>
                            <li class="social-network-item social-network-item-x">
                                <a class="social-network-anchor" href="">
                                    <img class="social-network-logo" src="{{ asset('assets/icons/social_network/x.png') }}" alt="">
                                </a>
                            </li>
                            <li class="social-network-item social-network-item-youtube">
                                <a class="social-network-anchor" href="">
                                    <img class="social-network-logo" src="{{ asset('assets/icons/social_network/youtube.png') }}" alt="">
                                </a>
                            </li>
                            <li class="social-network-item social-network-item-tiktok">
                                <a class="social-network-anchor" href="">
                                    <img class="social-network-logo" src="{{ asset('assets/icons/social_network/tiktok.png') }}" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="site-interactions-group site-interactions-group-user">
                    <div class="site-interactions-user">
                        <div class="user-interactions-quick">
                            <ul class="user-interactions-list">
                                <li class="user-interactions-item">
                                    <img class="user-interactions-logo" src="{{ asset('assets/icons/ddb-icon-changelog.png') }}" alt="">
                                </li>
                                <li class="user-interactions-item">
                                    <img class="user-interactions-logo" src="{{ asset('assets/icons/bell.png') }}" alt="">
                                </li>
                                <li class="user-interactions-item">
                                    <img class="user-interactions-logo" src="{{ asset('assets/icons/comments.png') }}" alt="">
                                </li>
                            </ul>
                        </div>
                        @if(isset($user))
                        <div class="user-interactions-profile">
                            <div class="user-profile-previw">
                                <img class="profile-picture" src="{{ $user['avatar'] ?? url('assets/images/default-avatar.jpg') }}" alt="">
                                <span class="nickname">
                                    {{ $user->name .' '. $user->surname ?? 'User' }}
                                </span>
                                <span class="hidden user-flag"></span>
                            </div>
                            <div class="profile-dropdown">
                                <ul class="profile-dropdown-list">
                                    <li class="profile-dropdown-item">
                                        <a href="{{ url('profile') }}">My Profile</a>
                                    </li>
                                    <li class="profile-dropdown-item">
                                        <a href="">Settings</a>
                                    </li>
                                    <li class="profile-dropdown-item">
                                        <a href="{{ url('logout') }}">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @else
                        <div class="user-interactions-login">
                            <a class="contained-button" href="{{ url('login') }}"> Sign In</a>
                            <a class="contained-button contained-button-red" href="{{ url('register') }}"> Sign Up</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="narrow-header">
        <div class="narrow-header-container">
            <a class="dnd-logo" href="{{ url('home') }}">
                <img src="{{ asset('assets/images/logo-178.png') }}" alt="">
            </a>
        </div>
        <div class="interactions-compact">
            <button class="search-button">
                <img class="search-button-image" src="{{ asset('assets/icons/search-grey.png') }}" alt="">
            </button>
            <div class="hidden dropdown-search" id="dropdown-search">
                <form class="search-form" action="">
                    <input class="search-input" type="text" placeholder="Search Everything..." value="{{ $query ?? '' }}">
                </form>
            </div>
            <button class="burger-menu">
                <img class="burger-menu-image" src="{{ asset('assets/icons/sort.png') }}" alt="">
            </button>
            <div class=" interactions site-interactions-user">
            @if(isset($user))
                        <div class="user-interactions-profile">
                            <a class="user-profile-previw" href="{{ url('profile') }}">
                                <img class="profile-picture" src="{{ $user['avatar'] ?? url('assets/images/default-avatar.jpg') }}" alt="">
                            </a>
                        </div>
                        @else
                        <div class="user-interactions-login">
                            <a class="contained-button" href="{{ url('login') }}"> Sign In</a>
                            <a class="contained-button contained-button-red" href="{{ url('register') }}"> Sign Up</a>
                        </div>
                        @endif
            </div>
        </div>
    </div>
</header>
<nav class="large navbar">
    <div class="navbar-container">
        <li>
            <div class="flex-row">    
                <div class="navbar-button"> Collections <img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt=""></div>
            </div>
            <div class="navbar-hover-container">
                <div class="container">
                    <div class="dropdown-cards-container collections-cards-container"></div>
                    <div class="dropdown-list-container"></div>
                </div>
            </div>
        </li>
        <li>
            <div class="flex-row">    
                <div class="navbar-button"> Game Rules <img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt=""></div>
            </div>
            <div class="navbar-hover-container">
                <div class="container">    
                    <div class="dropdown-cards-container rules-cards-container"></div>
                    <div class="dropdown-cards-container rules-column-container"></div>
                </div>
            </div>
        </li>
        <li>
            <div class="flex-row">    
                <div class="navbar-button"> Sources <img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt=""></div>
            </div>
            <div class="navbar-hover-container">
                <div class="sources-container container"> 
                    <h5 class="sources-title">Featured Books</h5>
                    <ul class="sources-list"></ul>   
                </div>
            </div>
        </li>
        <li>
            <div class="flex-row">    
                <div class="navbar-button"> Tools <img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt=""></div>
            </div>
            <div class="navbar-hover-container">
                <div class="dropdown-cards-container tools-cards-container"></div>
            </div>
        </li>
        <li>
            <div class="flex-row">    
                <div class="navbar-button"> Media <img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt=""></div>
            </div>
            <div class="navbar-hover-container">
                <div class="dropdown-cards-container media-cards-container"></div>
            </div>
        </li>
        <li>
            <div class="navbar-button"> Learn to Play </div>
        </li>
        <li>
            <div class="navbar-button"> Subscribe </div>
        </li>
        <li>
            <div class="navbar-button"> Marketplace </div>
        </li>
    </div>
</nav>
<div class="search-results"></div>
<div class="modal">
    <div class="not-sidebar"></div>
    <div class="sidebar">
        <ul>
            <li>
                <button class="dropdown-btn"><img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt="">Collections</button>
                <div id="collections-dropdown" class="dropdown-content"></div>
            </li>
            <li>
                <button class="dropdown-btn"><img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt="">Game Rules</button>
                <div id="game-rules-dropdown" class="dropdown-content"></div>
            </li>
            <li>
                <button class="dropdown-btn"><img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt="">Sources</button>
                <div id="sources-dropdown" class="dropdown-content"></div>
            </li>
            <li>
                <button class="dropdown-btn"><img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt="">Tools</button>
                <div id="tools-dropdown" class="dropdown-content"></div>
            </li>
            <li>
                <button class="dropdown-btn"><img class="caret-down" src="{{ asset('assets/icons/caret-down-white-icon.png') }}" alt="">Media</button>
                <div id="media-dropdown" class="dropdown-content"></div>
            </li>
            <li><a href="#">Forums</a></li>
            <li><a href="#">New Player Guide</a></li>
            <li><a href="#">Subscribe</a></li>
            <li><a href="#">Redeem A Key</a></li>
            <li><a href="#">Marketplace</a></li>
            @if(isset($user))
            <li class = "logout"><a href="{{ url('logout') }}"> Logout</a></li>
            @endif
        </ul>
        
    </div>
</div>