<header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="{{route('dashboard')}}" class="menu-btn"><i class="icon-bars"> </i></a><a href="{{route('dashboard')}}" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block">
                    <!-- <span>Bootstrap </span> -->
                    <strong class="text-primary">Dashboard</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
               
                <!-- Languages dropdown    -->
                <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"> <i class="fa fa-user"></i> Profile</span></a>
                  <ul aria-labelledby="languages" class="dropdown-menu">
                    <li><a rel="nofollow" href="{{route('user.profile')}}" class="dropdown-item"> <i class="fa fa-user"></i><span>Profile</span></a></li>
                    <li><a rel="nofollow" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"class="dropdown-item"><i class="fa fa-sign-out"></i>Logout</span></a></a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                   <!-- Log out-->
                <!-- <li class="nav-item"><a href="login.html" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li> -->
              </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>