<!-- Navbar -->
<link rel="stylesheet" href="{{asset('/public/Notification/css/demo.css')}}">
<link rel="stylesheet" href="{{asset('/public/Notification/css/style.css')}}">
<nav class="main-header navbar navbar-expand navbar-orange">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- notifications Dropdown Menu -->
        @if(\Illuminate\Support\Facades\Auth::user()->type === "student")
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell" style="margin-right: 10px ; margin-top: 20px"></i>
                    <span class="badge badge-danger navbar-badge" style="border-radius: 60%; margin-left: 50px">{{\App\Http\Service\NotificationService::getNotificationCount()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{\App\Http\Service\NotificationService::getNotificationCount()}} notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-warning mr-2"></i>{{\App\Http\Service\NotificationService::getDelayNotification()}} Delay Payment Warnings
                        {{--                    <span class="float-right text-muted text-sm">3 mins</span>--}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> {{\App\Http\Service\NotificationService::getAnnouncementNotification()}} Announcements
                        {{--                    <span class="float-right text-muted text-sm">12 hours</span>--}}
                    </a>
                </div>
            </li>
            @endif
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
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>
<!-- /.navbar -->
<style>
    .navbar-orange {
        background-color: #ff7700;
    }
</style>
