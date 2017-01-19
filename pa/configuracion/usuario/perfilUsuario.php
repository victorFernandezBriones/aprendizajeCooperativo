
<?php require_once '../../../negocio/configuracion/usuarios/procesarActualizarPerfil.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="bg-picture text-center" style="background-image:url('media/fondoLogin.png')">
            <div class="bg-picture-overlay"></div>
            <div class="profile-info-name">
                <img src="media/avatar-1.jpg" class="thumb-lg img-circle img-thumbnail" alt="imagen_perfil">
                <h3 class="text-white"><?php echo $sessionUsuario->getNombreUsuario() . " " . $sessionUsuario->getApellidoPUsuario(); ?></h3>
            </div>
        </div>
        <!--/ meta -->
    </div>
</div>
<div class="row user-tabs sombra">
    <div class="col-sm-9 col-lg-6">
        <ul class="nav nav-tabs tabs ">
            <li class="active tab">
                <a id="aPerfil" href="#perfil" data-toggle="tab" aria-expanded="false" class="active"> 
                    <span class="visible-xs"><i class="fa fa-home"></i></span> 
                    <span class="hidden-xs">Sobre mi</span> 
                </a> 
            </li>             
            <li class="tab"> 
                <a id="aConfiguracion" href="#configuracion" data-toggle="tab" aria-expanded="false"> 
                    <span class="visible-xs"><i class="fa fa-cog"></i></span> 
                    <span class="hidden-xs">Configuración</span> 
                </a> 
            </li> 
            <div class="indicator"></div>
        </ul> 
    </div>    
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="tab-content profile-tab-content"> 
            <div class="tab-pane active" id="perfil"> 
                <div class="row">
                    <div class="col-md-4">
                        <!-- Personal-Information -->
                        <div class="panel panel-default panel-fill sombra">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Informaci&oacute;n Personal</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <div class="about-info-p">
                                    <strong>Nombre Completo</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $sessionUsuario->getNombreUsuario() . " " . $sessionUsuario->getApellidoPUsuario() . " " . $sessionUsuario->getApellidoMUsuario(); ?></p>
                                </div>                                
                                <div class="about-info-p">
                                    <strong>Email</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $sessionUsuario->getEmail(); ?></p>
                                </div>
                                <div class="about-info-p m-b-0">
                                    <strong>Sede</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $sede->getNombreSede(); ?></p>
                                </div>
                                <div class="about-info-p m-b-0">
                                    <strong>Perfil</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $tipoUsuario->getTipoUsuario(); ?></p>
                                </div>
                            </div> 
                        </div>
                        <!-- Personal-Information -->

                        <!-- Languages -->
                        <div class="panel panel-default panel-fill sombra">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Idiomas</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <ul>
                                    <li>Ingles</li>
                                    <li>Frances</li>
                                    <li>Arameo</li>
                                </ul>
                            </div> 
                        </div>
                        <!-- Languages -->

                    </div>


                    <div class="col-md-8">                        
                        <!-- Personal-Information -->

                        <div class="panel panel-default panel-fill sombra">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Asistencia</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <div class="m-b-15">
                                    <h5>Asignatura 1<span class="pull-right">60%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary wow animated progress-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-b-15">
                                    <h5>Asignatura 2 <span class="pull-right">90%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-pink wow animated progress-animated" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                            <span class="sr-only">90% Complete</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-b-15">
                                    <h5>Asignatura 3 <span class="pull-right">80%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-purple wow animated progress-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-b-0">
                                    <h5>Asignatura 4 <span class="pull-right">95%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info wow animated progress-animated" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                                            <span class="sr-only">95% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div> 


            <div class="tab-pane" id="configuracion">
                <!-- Personal-Information -->
                <div class="panel panel-default panel-fill sombra">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Editar Perfil</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="formActualizarPerfil" method="POST" role="form">
                                    <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $sessionUsuario->getIdUsuario(); ?>">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" value="<?php echo $sessionUsuario->getNombreUsuario(); ?>" id="nombre" name="nombre" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoP">Apellido Paterno</label>
                                        <input type="text" value="<?php echo $sessionUsuario->getApellidoPUsuario(); ?>" id="apellidoP" name="apellidoP" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoM">Apellido Materno</label>
                                        <input type="text" value="<?php echo $sessionUsuario->getApellidoMUsuario(); ?>" id="apellidoM" name="apellidoM" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" value="<?php echo $sessionUsuario->getEmail(); ?>" id="email" name="email" class="form-control">
                                    </div>                            


                                    <button class="btn color-principal waves-effect waves-light w-md btn-lg blanco" type="submit"><i class="fa fa-refresh"></i>&nbsp;Actualizar</button>
                                </form>
                            </div> 
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Cambiar Contraseña</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="formActualizarContrasena" name="formActualizarContrasena">
                                    <div class="form-group">
                                        <label for="contrasena">Contrase&ntilde;a Antigüa</label>
                                        <input type="password" placeholder="***********" id="contrasenaAntigua" name="contrasenaAntigua" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="contrasena">Contrase&ntilde;a Nueva</label>
                                        <input type="password" placeholder="***********" id="contrasena" name="contrasena" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="reContrasena">Re-Contrase&ntilde;a</label>
                                        <input type="password" placeholder="***********" id="reContrasena" name="reContrasena" class="form-control">
                                    </div>

                                    <button class="btn color-principal waves-effect waves-light w-md btn-lg blanco" type="submit"><i class="fa fa-refresh"></i>&nbsp;Actualizar Contrase&ntilde;a</button>

                                </form>


                            </div>

                        </div>

                    </div>
                    <!-- Personal-Information -->
                </div> 
            </div> 
        </div>
    </div>