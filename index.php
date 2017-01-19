<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Login | Centro de aprendizaje cooperativo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <link href="pa/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="pa/assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="pa/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="pa/assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="pa/assets/css/pages.css" rel="stylesheet" type="text/css">
        <link href="pa/assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="pa/assets/css/responsive.css" rel="stylesheet" type="text/css">
        <link href="pa/assets/css/customStyle.css" rel="stylesheet" type="text/css">

        <script src="pa/assets/js/modernizr.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="body-login">
        <?php require_once 'negocio/login/procesarLogin.php'; ?>
        <img src="pa/media/logoCentroEducacional.jpg" alt="logoInicio"> 
        <div class="wrapper-page" id="login-div">
            <div class="panel panel-color panel-primary panel-pages color-principal">
                <div class="panel-body">
                    <h3 class="text-center m-t-10 text-purple"> Bienvenido, por favor ingrese</h3>
                    <form class="form-horizontal m-t-20" action="index.php" method="POST">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" type="text" id="usuario" name="usuario" placeholder="Nombre de Usuario">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" type="password" id="contrasena" name="contrasena" placeholder="Contrasena">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Recuerdame
                                    </label>
                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <button class="btn  btn-lg w-lg waves-effect waves-light" type="submit">Ingresar</button>
                            </div>
                        </div>                     

                        <div class="form-group m-t-30">
                            <div class="col-sm-7">
                                <a href="recuperarContrasena.php"><i class="fa fa-lock m-r-5"></i> ¿Olvidaste tu contrase&ntilde;a?</a>
                            </div>                            
                        </div>
                    </form>
                    <?php if (isset($error)): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            </div>                        
                        </div>
                    <?php endif; ?>
                </div> 
            </div>
            <footer id="footer-login" class="text-center">
                <p>Centro de aprendizaje cooperativo &copy;-2016</p>
            </footer>
        </div>



        <script>
            var resizefunc = [];
        </script>

        <!-- Main  -->
        <script src="pa/assets/js/jquery.min.js"></script>
        <script src="pa/assets/js/bootstrap.min.js"></script>
        <script src="pa/assets/js/detect.js"></script>
        <script src="pa/assets/js/fastclick.js"></script>
        <script src="pa/assets/js/jquery.slimscroll.js"></script>
        <script src="pa/assets/js/jquery.blockUI.js"></script>
        <script src="pa/assets/js/waves.js"></script>
        <script src="pa/assets/js/wow.min.js"></script>
        <script src="pa/assets/js/jquery.nicescroll.js"></script>
        <script src="pa/assets/js/jquery.scrollTo.min.js"></script>

        <script src="pa/assets/js/jquery.app.js"></script>



    </body>
</html>