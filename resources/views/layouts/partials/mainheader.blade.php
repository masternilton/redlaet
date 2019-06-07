


<div id="slide-out" class="side-nav sn-bg-4">


            
        <!-- Sidebar scroll-->



        <!-- Sidebar scroll-->
     


         <ul class="custom-scrollbar">
            <!-- Logo -->
            <li>
                <div class="logo-wrapper waves-light">
                    <a href="/appralet/home"><img src="{{ asset('/assets/img/logo_negativo.png') }}"  style='max-height: 95px;' class="img-fluid flex-center"></a>
                </div>
            </li>
        
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> RELAET<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul class="list-unstyled">
                                <li><a href="{{ url('/') }}">Inicio </a></li>
                             
                            </ul>
                        </div>
                    </li>
                   
            <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg mask-strong"></div>
       
    </div>
    <!--/. Sidebar navigation -->
    <!-- Navbar -->

    <nav class="navbar  navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                 <p><a href='/apprelaet'> <img src="{{ asset('/assets/img/logo_h_negativo.png') }} " style='max-height: 50px;'> </a></p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
             
             
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fa fa-user"></i> {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                 
                    <a class="dropdown-item" href="javascript:void(0);" onclick='verinfo_mi_perfil({{Auth::user()->id}})' ><i class="fa fa-user"> </i> Mi Perfil</a>
                   
                    
                     <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"> </i>Salir</a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                    </div>
                </li>
            </ul>
        </nav>
   
  
    <!-- /.Navbar -->


