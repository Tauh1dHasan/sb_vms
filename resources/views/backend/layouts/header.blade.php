<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <title>Dashboard</title>

    <link rel="icon" type="image/x-icon" href="{{asset('backend/assets/img/favicon.ico')}}"/>
    <script src="{{asset('backend/assets/js/loader.js')}}"></script>

    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">

    @include('backend.partials.css')

</head>
<body class="dashboard-analytics admin-header">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('backend.partials.sidebar')
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="">

                    <div class="" style="margin-top: 10px;"> 
                        <div class="">

                            <div class="header-container">
                                <header class="header navbar navbar-expand-sm">                                    
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                                            <div class="bt-menu-trigger">
                                                <span></span>
                                            </div>
                                        </a>
                                        <div class="page-header">
                                            <div class="page-title">
                                                <h3>Dashboard</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="navbar-item flex-row navbar-dropdown search-ul">
                                        {{-- <li class="nav-item align-self-center search-animated">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            <form class="form-inline search-full form-inline search" role="search">
                                                <div class="search-bar">
                                                    <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                                                </div>
                                            </form>
                                        </li> --}}
                                        <!-- <li class="nav-item dropdown language-dropdown more-dropdown">
                                            <div class="dropdown  custom-dropdown-icon">
                                                <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/img/ca.png" class="flag-width" alt="flag">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                                                    <a class="dropdown-item" data-img-value="de" data-value="German" href="javascript:void(0);"><img src="assets/img/de.png" class="flag-width" alt="flag"> German</a>
                                                    <a class="dropdown-item" data-img-value="jp" data-value="Japanese" href="javascript:void(0);"><img src="assets/img/jp.png" class="flag-width" alt="flag"> Japanese</a>
                                                    <a class="dropdown-item" data-img-value="fr" data-value="French" href="javascript:void(0);"><img src="assets/img/fr.png" class="flag-width" alt="flag"> French</a>
                                                    <a class="dropdown-item" data-img-value="ca" data-value="English" href="javascript:void(0);"><img src="assets/img/ca.png" class="flag-width" alt="flag"> English</a>
                                                </div>
                                            </div>
                                        </li> -->
                                        
                                        <li class="nav-item dropdown notification-dropdown">
                                            <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="badge badge-success"></span>
                                            </a>
                                            <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                                                <div class="notification-scroll">
                        
                                                    <div class="dropdown-item">
                                                        <div class="media server-log">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg>
                                                            <div class="media-body">
                                                                <div class="data-info">
                                                                    <h6 class="">Server Rebooted</h6>
                                                                    <p class="">45 min ago</p>
                                                                </div>
                        
                                                                <div class="icon-status">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                    <div class="dropdown-item">
                                                        <div class="media ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                                            <div class="media-body">
                                                                <div class="data-info">
                                                                    <h6 class="">Licence Expiring Soon</h6>
                                                                    <p class="">8 hrs ago</p>
                                                                </div>
                        
                                                                <div class="icon-status">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                    <div class="dropdown-item">
                                                        <div class="media file-upload">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                            <div class="media-body">
                                                                <div class="data-info">
                                                                    <h6 class="">Kelly Portfolio.pdf</h6>
                                                                    <p class="">670 kb</p>
                                                                </div>
                        
                                                                <div class="icon-status">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li class="nav-item dropdown message-dropdown">
                                            <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg><span class="badge badge-primary"></span>
                                            </a>
                                            <div class="dropdown-menu position-absolute" aria-labelledby="messageDropdown">
                                                <div class="">
                                                    <a class="dropdown-item">
                                                        <div class="">
                        
                                                            <div class="media">
                                                                <div class="user-img">
                                                                    <div class="avatar avatar-xl">
                                                                        <span class="avatar-title rounded-circle">KY</span>
                                                                    </div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="">
                                                                        <h5 class="usr-name">Kara Young</h5>
                                                                        <p class="msg-title">ACCOUNT UPDATE</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                        
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item">
                                                        <div class="">
                                                            <div class="media">
                                                                <div class="user-img">
                                                                    <div class="avatar avatar-xl">
                                                                        <span class="avatar-title rounded-circle">DA</span>
                                                                    </div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="">
                                                                        <h5 class="usr-name">Daisy Anderson</h5>
                                                                        <p class="msg-title">ACCOUNT UPDATE</p>
                                                                    </div>
                                                                </div>
                                                            </div>                                    
                                                        </div>
                                                    </a>
                                                    <a class="dropdown-item">
                                                        <div class="">
                        
                                                            <div class="media">
                                                                <div class="user-img">
                                                                    <div class="avatar avatar-xl">
                                                                        <span class="avatar-title rounded-circle">OG</span>
                                                                    </div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="">
                                                                        <h5 class="usr-name">Oscar Garner</h5>
                                                                        <p class="msg-title">ACCOUNT UPDATE</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                        
                                        <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                                            <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{asset('backend/assets/img/profile-7.jpg')}}" alt="admin-profile" class="img-fluid">
                                            </a>
                                            <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                                                
                                                <div class="dropdown-item">
                                                    <a href="{{route('visitor.profile')}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span> Profile</span>
                                                    </a>
                                                </div>

                                                <div class="dropdown-item">
                                                    <a href="apps_mailbox.html">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> <span> Inbox</span>
                                                    </a>
                                                </div>
                                                
                                                <div class="dropdown-item">
                                                    <a href="{{route('frontend.user_logout')}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </header>
                            </div>
