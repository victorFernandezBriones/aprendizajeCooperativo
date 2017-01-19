<div class="sidebar-inner slimscrollleft " >
    <div class="user-details color-adicional">
        <div class="pull-left">
            <img src="media/avatar-1.jpg" alt="" class="thumb-md img-circle">
        </div>
        <div class="user-info">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $sessionUsuario->getNombreUsuario() . " " . $sessionUsuario->getApellidoPUsuario(); ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#MiPerfil" onclick="cargarPerfilUsuario()"><i class="fa fa-user"></i> Perfil<div class="ripple-wrapper"></div></a></li>                                     
                    <li><a href="../index.php"><i class="fa fa-power-off"></i> Salir</a></li>
                </ul>
            </div>

            <p class="text-muted m-0"><?php echo $tipoUsuario->getTipoUsuario(); ?></p>
        </div>
    </div>
    <!--- Divider -->

    <div id="sidebar-menu">
        <ul>
            <li>
                <a href="#inicio" onclick="cargarInicio()" class="waves-effect"><i class="fa fa-home"></i><span> Inicio </span></a>
            </li>
            <li>
                <a href="#calendario" onclick="cargarCalendario()" class="waves-effect"><i class="fa fa-calendar"></i><span> Calendario </span></a>
            </li>

            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-file-text"></i><span> Pedag&oacute;gico </span><span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a>Pauta evaluaci&oacute;n</a></li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-file-text"></i> <span> Psicol&oacute;gico </span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="#evaluacionPsicologica"  onclick="cargarPautaEvaluacionPsicologica()">Pauta evaluaci&oacute;n Psicologica</a></li>
                    <li id="liInformeAlumno"><a href="#informeAlumno" onclick="cargarInformeAlumno()">Informe Alumno</a></li>
                    <li><a href="#informeGrupo"  onclick="cargarInformeGrupo()">Informe Grupo</a></li>
                    <li><a href="#informeMensual"  onclick="">Informe Mensual Alumno</a></li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-pencil"></i><span> Evaluaci&oacute;n </span><span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a>Ejemplo 1</a></li>                   
                </ul>
            </li>

            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-briefcase"></i> <span> Docentes </span> <span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a>Ejemplo 1</a></li>                   
                </ul>
            </li>

            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-users"></i><span> Alumnos </span><span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="#ingresarAlumno" onclick="cargarIngresarAlumno()">Ingresar Alumno</a></li> 
                </ul>
            </li>

            <li class="has_sub">
                <a href="#" class="waves-effect"><i class="fa fa-wrench"></i><span> Mantenedor </span><span class="pull-right"><i class="md md-add"></i></span></a>
                <ul class="list-unstyled">
                    <li><a href="#IngresarUsuario" onclick="cargarIngresarUsuario()">Ingresar Usuario</a></li>
                    <li><a href="#AdministrarUsuarios" onclick="cargarAdministrarUsuario()">Adm. Usuarios</a></li>
                    <li><a href="#AdministrarSedes" onclick="cargarAdministrarSedes()">Adm. Sedes</a></li>
                    <li><a href="#AdministrarCursos" onclick="cargarAdministrarCursos()">Adm. Cursos</a></li>
                    <li><a href="#AdministrarNivelCursos" onclick="cargarAdministrarNivelCursos()">Adm. Nivel Cursos</a></li>
                    <li><a href="#AdministrarAsignaturas" onclick="cargarAdministrarAsignaturas()">Adm. Asignaturas</a></li>
                    <li><a href="#AdministrarEntidades" onclick="cargarAdministrarEntidad()">Adm. Entidades</a></li>
                </ul>
            </li>
            <li>
                <a href="http://192.168.1.10" target="_blank" class="waves-effect"><i class="fa fa-cloud"></i><span> Cloud </span><span class="pull-right"></span></a>                
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>
</div>