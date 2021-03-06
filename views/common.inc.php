
<?php

function mostrarCapssaleraPagina($TitolPag) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
        <head>
            <title><?php echo $TitolPag ?></title>
            <meta http-equiv="content-type" content="text/html;charset=utf-8" />
            <link rel="StyleSheet" href="/carretMVC/estils.css"   type="text/css" />
            <script language="javascript" type="text/javascript" src="../assets/js/validador.js"></script>
        </head>
        <body>
            <?php
        }

        function menu($actiu) {
            ?>
            <ul id="menu">
                <li  <?php echo $actiu == 'registre' ? 'id="actiu"' : '' ?>>
                    <?php if (!isset($_SESSION['login'])) { ?>
                        <a href="/carretMVC/views/registre_view.php">Registre</a>
                        <?php
                    } else {
                        echo ($_SESSION['login']);
                    }
                    ?>

                </li>
                <li <?php echo $actiu == 'ingres_producte' ? 'id="actiu"' : '' ?>>
                    <?php if (isset($_SESSION['login'])) { ?>
                        <a href="/carretMVC/views/ingresProducte_view.php">Ingressar Producte</a>   
                    <?php } ?>
                </li>
                <li <?php echo $actiu == 'logejarUsuari' ? 'id="actiu"' : '' ?>>
                    <?php if (!isset($_SESSION['login'])) { ?>
                        <a href="/carretMVC/views/logejarUsuari_view.php">Iniciar Sessio</a>
                        <?php
                    }
                    ?>
                </li>
                <li <?php echo $actiu == 'productes' ? 'id="actiu"' : '' ?> >
                    <a href="/carretMVC/index.php">Productes</a>
                </li>    
                <li<?php echo $actiu == 'logout' ? 'id="actiu"' : '' ?>>
                    <?php if (isset($_SESSION['login'])) { ?>
                        <a href="/carretMVC/controllers/logout_controller.php">Logout</a>
                        <?php
                    }
                    ?>
                </li>

            </ul>
            <?php
        }

        function inputImatges() {
            ?>
            <!-- MAX_FILE_SIZE debe preceder el campo de entrada de archivo -->
            <input type="hidden" name="MAX_FILE_SIZE"  value="300000000"/>
            <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
            <input name="foto" type="file" />
            <!-- <input type="submit" value="Send File" /> -->
            <br>
                <?php
            }

            function mostrarPeuPagina() {
                ?>
        </body></html>
    <?php
}
