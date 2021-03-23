 <!-- Side Navbar -->
 <nav class="side-navbar">
   <div class="side-navbar-wrapper">
     <!-- Sidebar Header    -->
     <div class="sidenav-header d-flex align-items-center justify-content-center">
       <!-- User Info-->
       <div class="sidenav-header-inner text-center"><img src="{{asset(Auth::user()->image ?? '/img/avatar-7.jpg')}}" alt="person" class="img-fluid rounded-circle">
         <h2 class="h5">{{Auth::user()->name ?? ''}}</h2><span>Web Developer</span>
       </div>
       <!-- Small Brand information, appears on minimized sidebar-->
       <div class="sidenav-header-logo"><a href="{{route('dashboard')}}" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
     </div>
     <!-- Sidebar Navigation Menus-->
     <div class="main-menu">
       <h5 class="sidenav-heading">Main</h5>
       <ul id="side-main-menu" class="side-menu list-unstyled">
         <li><a href="{{route('dashboard')}}"> <i class="icon-home"></i>Home</a></li>
         <li><a href="{{route('processing.expense')}}"> <i class="icon-picture"></i>Pendding Expanse</a></li>
         <li><a href="{{route('approve.expense')}}"> <i class="icon-picture"></i>Approved Expanse</a></li>

         <li><a href="{{route('payment.expense')}}"> <i class="icon-picture"></i>Payments</a></li>

         <li><a href="{{route('category')}}"> <i class="icon-picture"></i>Category</a></li>
         <li><a href="{{route('subcategory')}}"> <i class="icon-screen"></i>SubCategory</a></li>
         <li><a href="{{route('employee')}}"> <i class="icon-user"></i>Employee</a></li>
         <li><a href="{{route('project')}}"> <i class="icon-form"></i>Project</a></li>
         <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>Note Sheet </a>
           <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
             <li><a href="{{route('note.sheet')}}">Note Sheet</a></li>
             <li><a href="{{route('note.sheet.create')}}">Create Note Sheet</a></li>
           </ul>
         </li>
         <li><a href="#income" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Income </a>
           <ul id="income" class="collapse list-unstyled ">
             <li><a href="{{route('income')}}">Income</a></li>
             <li><a href="{{route('income.create')}}">Create Income</a></li>
           </ul>
         </li>

         <li><a href="{{route('admin-user')}}"> <i class="fa fa-user"></i>User Managment</a></li>
         <!-- <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page</a></li> -->
         <li> <a href="#"> <i class="icon-mail"></i>Demo
             <div class="badge badge-warning">6 New</div></a></li>
       </ul>
     </div>
     <!-- <div class="admin-menu">
          <h5 class="sidenav-heading">Second menu</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            <li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>
            <li> <a href="#"> <i class="icon-flask"> </i>Demo
            <div class="badge badge-info">Special</div></a></li>
            <li> <a href=""> <i class="icon-flask"> </i>Demo</a></li>
            <li> <a href=""> <i class="icon-picture"> </i>Demo</a></li>
          </ul>
        </div> -->
   </div>
 </nav>