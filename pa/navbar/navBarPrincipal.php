<!-- LOGO -->
<div class="topbar-left">
    <div class="text-center logo-container">
        <a href="inicio.php" class="logo"><img id="logo-nav" src="media/logoCentroEducacional.jpg" alt="logo" class="foto-logo"></a>
    </div> 
</div>
<!-- BOTON COLLAPSE PARA MOVILES Y PANTALLAS PEQUEÑAS-->
<div class="navbar navbar-default color-principal" role="navigation">
    <div class="container">
        <div class="">
            <div class="pull-left">
                <button type="button" class="button-menu-mobile open-left">
                    <i class="fa fa-bars"></i>
                </button>
                <span class="clearfix"></span>
            </div>                           

            <ul class="nav navbar-nav navbar-right pull-right">
                <li class="dropdown hidden-xs">
                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg">
                        <li class="text-center notifi-title blanco">Notificaciones</li>
                        <li class="list-group">
                            <!-- list item-->
                            <a href="javascript:void(0);" class="list-group-item">
                                <div class="media">
                                    <div class="media-left">
                                        <em class="fa fa-user-plus fa-2x text-info"></em>
                                    </div>
                                    <div class="media-body clearfix">
                                        <div class="media-heading negro">Nuevos Usuarios</div>
                                        <p class="m-0">
                                            <small>Tienes 10 nuevos mensajes</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- list item-->
                            <a href="javascript:void(0);" class="list-group-item">
                                <div class="media">
                                    <div class="media-left">
                                        <em class="fa fa-diamond fa-2x text-primary"></em>
                                    </div>
                                    <div class="media-body clearfix">
                                        <div class="media-heading negro">Nuevas Configuraciones</div>
                                        <p class="m-0">
                                            <small>Hay nuevas actualizaciones disponibles</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- list item-->
                            <a href="javascript:void(0);" class="list-group-item">
                                <div class="media">
                                    <div class="media-left">
                                        <em class="fa fa-bell-o fa-2x text-danger"></em>
                                    </div>
                                    <div class="media-body clearfix">
                                        <div class="media-heading negro">Actualizaciones</div>
                                        <p class="m-0">
                                            <small>Hay
                                                <span class="text-primary">2</span> nuevas actualización</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <!-- ULTIMO list item -->
                            <a href="javascript:void(0);" class="list-group-item">
                                <small>Ver todas las actualizaciones</small>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="hidden-xs">
                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="fa fa-expand"></i></a>
                </li>

                <li class="dropdown">
                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-user"></i> </a>
                    <ul class="dropdown-menu">
                        <li><a href="#perfil" onclick="cargarPerfilUsuario()"><i class="fa fa-user"></i> Perfil</a></li>                                                        
                        <li><a href="logout.php"><i class="fa fa-power-off"></i> Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>