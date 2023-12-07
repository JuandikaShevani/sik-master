<nav class="main-header navbar navbar-expand border-bottom-0 navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown d-none d-sm-inline-block">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user mr-1"></i>
                <i class="fas fa-angle-down ml-1"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-small dropdown-menu-right">
                <a href="{{ route('profile.show') }}" class="dropdown-item">
                    <i class="fas fa-user-circle mr-2"></i> My Account
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout')}}" method="post" id="formLogout">
                    @csrf
                    <a href="#" class="dropdown-item" id="formLogout">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
