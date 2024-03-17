<body>
      <!-- Preloader Start Here -->
      <div id="preloader"></div>
      <!-- Preloader End Here -->
      <div id="wrapper" class="wrapper bg-ash">
      <!-- Header Menu Area Start Here -->
      <div class="navbar navbar-expand-md header-menu-one bg-light">
         <div class="nav-bar-header-one">
            <div class="header-logo">
               <a href="{{ route('admin.dashboard') }}">
               <img src="{{ asset('admin/images/logo.png') }}" alt="logo">
               </a>
            </div>
            <div class="toggle-button sidebar-toggle">
               <button type="button" class="item-link">
               <span class="btn-icon-wrap">
               <span></span>
               <span></span>
               <span></span>
               </span>
               </button>
            </div>
         </div>
         <div class="d-md-none mobile-nav-bar">
            <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
            <i class="far fa-arrow-alt-circle-down"></i>
            </button>
            <button type="button" class="navbar-toggler sidebar-toggle-mobile">
            <i class="fas fa-bars"></i>
            </button>
         </div>
         <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
            <ul class="navbar-nav">
               <li class="navbar-item header-search-bar">
                  <div class="input-group stylish-input-group">
                     <input type="text" class="form-control" placeholder="Search">
                  </div>
               </li>
            </ul>
            <ul class="navbar-nav">
               <li class="navbar-item dropdown header-admin">
                  <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                     aria-expanded="false">
                     <div class="admin-title">
                        <h5 class="item-title">John doe</h5>
                        <span>Admin</span>
                     </div>
                     <div class="admin-img">
                        <img src="{{ asset('admin/images/admin.jpg') }}" alt="Admin">
                     </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                     <div class="item-content">
                        <ul class="settings-list">
                           <li><a href="{{ route('profile.show') }}"><i class="flaticon-gear-loading"></i>Account details</a></li>
                           <li><a href="{{ route('admin-signout') }}">
                              <i class="flaticon-turn-off"></i>Log Out</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
      <!-- Header Menu Area End Here -->
      <!-- Page Area Start Here -->
      <div class="dashboard-page-one">
      <!-- Sidebar Area Start Here -->
      <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
         <div class="mobile-sidebar-header d-md-none">
            <div class="header-logo">
               <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('admin/images/logo.png') }}" alt="logo"></a>
            </div>
         </div>
         <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">
               <li class="nav-item sidebar-nav-item">
                  <a href="{{ route('admin.dashboard') }}" class="nav-link"><img src="{{ asset('admin/images/dash.png') }}" style="width:20px;"/><span> Dashboard</span></a>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><img src="{{ asset('admin/images/person.png') }}" style="width:20px;"/><span> User Profile<i class="fa fa-caret-down"></i></span></a>
                  <ul class="nav sub-group-menu">
                     <li class="nav-item">
                        <a href="{{ route('profile.show') }}" class="nav-link"><i class="fa fa-ellipsis-h"></i>Profile</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="{{ route('admin-signout') }}" class="nav-link"><img src="{{ asset('admin/images/logout.png') }}" style="width:20px;"/> <span>Log out</span></a>
               </li>
            </ul>
         </div>
      </div>
      <!-- Sidebar Area End Here -->