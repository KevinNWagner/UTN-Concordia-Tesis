<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Adm. Colectivos</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/favicon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker3.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/jquery-clockpicker.min.css')}}"/>
     <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}"/>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="home" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="{{asset('img/favicon.ico')}}" /></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin. Colectivos</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-green">- Online -</small>
                  <span class="hidden-xs">  {{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                        <h3 ><font color="white">Chofer</Font><h3>
                      <small></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
          <li class="header"></li>
            <li>
              <a href="/chofer/midia">
                <i class="fa fa-home"></i> <span>Mi Dia</span>             
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-clock-o"></i>
                <span>Rendiciones</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="cartelera"><i class="fa fa-circle-o"></i> Carteleras</a></li>
                <li><a href="cronograma"><i class="fa fa-circle-o"></i> Cronogramas</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Empleados</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="empleado"><i class="fa fa-circle-o"></i> Adminitracion</a></li>
                <li><a href="empleado"><i class="fa fa-circle-o"></i> Choferes</a></li>
                <li><a href="empleado"><i class="fa fa-circle-o"></i> Inspectores</a></li>
                <li><a href="empleado"><i class="fa fa-circle-o"></i> Todos</a></li>
              </ul>
            </li>
            <li>
              <a href="colectivo">
                <i class="fa fa-bus"></i> <span>Colectivos</span>
  
              </a>
            </li>
            <li>
              <a href="rendicion">
                <i class="fa fa-money"></i> <span>Rendiciones</span>
  
              </a>
            </li>
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
            
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema de administración</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
           <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
          <script src="{{asset('js/jquery-clockpicker.min.js')}}"></script>
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015-2020 <a href="www.incanatoit.com">IncanatoIT</a>.</strong> All rights reserved.
      </footer>



    
      <!-- Include Date Range Picker -->
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/locales/bootstrap-datepicker.es.js')}}"></script>

<!-- Include Table -->
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>


<!-- jQuery 2.1.4 -->
   
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    


  </body>
</html>