<?php require_once '../../../negocio/configuracion/usuarios/procesarIngresarUsuario.php'; ?>

<!--BREADCRUM -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Bienvenido</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#" onclick="cargarInicio()">Centro de aprendizaje</a></li>
            <li >Configuraci&oacute;n</li>
            <li class="active">Ingresar Usuario</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default sombra">
            <div class="panel-heading"><h3 class="panel-title">Ingresar Usuario</h3></div>
            <div class="panel-body">
                <form id="formIngresarUsuario" name="formIngresarUsuario" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Primer Nombre</label>
                        <div class="col-md-5">
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-email">Apellido Paterno</label>
                        <div class="col-md-5">
                            <input type="text" id="apellidoP" name="apellidoP" class="form-control" placeholder="Ingrese Apellido Paterno">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-email">Apellido Materno</label>
                        <div class="col-md-5">
                            <input type="text" id="apellidoM" name="apellidoM" class="form-control" placeholder="Ingrese Apellido Materno">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nombre Usuario</label>
                        <div class="col-md-5">
                            <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control" placeholder="Ingrese nombre de usuario">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contrase&ntilde;a</label>
                        <div class="col-md-5">
                            <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="**********">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Re-Contrase&ntilde;a</label>
                        <div class="col-md-5">
                            <input type="password" id="reContrasena" name="reContrasena" class="form-control" placeholder="**********">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">E-mail</label>
                        <div class="col-md-5">
                            <input type="email" id="email" name="email" class="form-control" placeholder="ejemplo@ejemplo.cl">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Tipo Usuario</label>
                        <div class="col-md-5">
                            <select id="idTipoUsuario" name="idTipoUsuario" class="form-control">
                                <option value="">Seleccione</option>
                                <?php
                                if (isset($tiposUsuarios)):
                                    foreach ($tiposUsuarios as $tu) :
                                        ?>
                                        <option value="<?php echo $tu->getIdTipoUsuario(); ?>"><?php echo $tu->getTipoUsuario(); ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sede</label>
                        <div class="col-md-5">
                            <select id="idSede" name="idSede" class="form-control">
                                <option value="">Seleccione</option>
                                <?php
                                if (isset($sedes)):
                                    foreach ($sedes as $s) :
                                        ?>
                                        <option value="<?php echo $s->getIdSede(); ?>"><?php echo $s->getNombreSede(); ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-5">
                            <button type="submit" id="btnIngresarUsuario" name="btnIngresarUsuario" class="btn color-principal"><i class="fa fa-user">&nbsp;Ingresar Usuario</i></button>
                        </div>
                    </div>
                    <div class="row noDisplay divGifCarga">   
                        <div class="col-md-12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active color-principal" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span class="sr-only">100% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="alert alert-success text-center mensajeExito noDisplay"><label><i class="fa fa-user"></i>&nbsp;Usuario Ingresado Exitosamente</label></div>
                <div class="alert alert-danger text-center mensajeError noDisplay"><label><i class="fa fa-warning"></i>&nbsp;Error, no se ha podido ingresar el Usuario</label></div>
            </div>
        </div>
    </div>
</div>
