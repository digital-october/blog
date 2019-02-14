<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="{{ route('posts.index') }}"
                       class="nav-link nav-link-page">{{ __('message.fields.posts') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                       class="nav-link nav-link-page">{{ __('message.fields.users') }}</a></li>
                <li class="nav-item">
                    <a href="{{ route('posts.create') }}"
                       class="nav-link nav-link-page">{{ __('message.fields.create_post') }}</a>
                </li>
            </ul>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->present()->fullName }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>

                    </li>
                @endguest
            </ul>
        </div>

        <ul class="navbar-nav ml-auto">
            <li>
                <a class="nav-link" href="/locale/en">
                    <img src="{{ asset('images/icons/usa.png') }}" style="width: 20px;"alt="">
                </a>
            </li>
            <li>
                <a class="nav-link" href="/locale/ru">
                    <img src="{{ asset('images/icons/ru.png') }}" style="width: 22px;"alt="">
                </a>
            </li>
        </ul>

    </div>
</nav>

<br>