<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="shortcut icon" href="../img/ico.png">
    <title>Insertando venta</title>
</head>

<body>
    <?php
    include("../funciones.php");
    $mensaje = "";
    /**
     * Permite insertar una venta en la base de datos, siempre que los datos esten introducidos correctamente
     */
    if (isset($_POST['cr'])) {
        if (!empty($_POST['cod']) && !empty($_POST['ref']) && !empty($_POST['cant']) && !empty($_POST['fecha'])) {
            $codigo = $_POST['cod'];
            $referencia = $_POST['ref'];
            $cantidad = $_POST['cant'];
            if ($cantidad == 0) {
                $cantidad = 1;
            }
            $fecha = $_POST['fecha'];
            $fecha = date('Y-m-d', strtotime(str_replace('-', '/', $fecha)));
            $base = "ventas_comerciales";
            $query = "INSERT INTO ventas(codComercial,refProducto,cantidad,fecha) values('$codigo','$referencia','$cantidad','$fecha')";
            operacionesMySql($query, $base);
            header("Location:insertar_venta.php");
        } else {
            $mensaje =  "<b class='mens_error'>ERROR. No se han introducido todos los datos</b>";
        }
    }

    /**
     * Permite volver al menu de insertar indice
     */
    if (isset($_POST['back'])) {
        header("Location:../insercion.php");
    }
    // //Listado de datos
    $conexion = conectar("ventas_comerciales");
    $query = "select * from ventas";
    $registros = $conexion->query($query) or die($conexion->error);
    ?>
    <div class="contenedor">
        <header onclick="location.href='../index.php';" style="cursor: pointer;">
            <h1 id="inicio">Ventas comerciales</h1>
        </header>
        <!-- Menu de navegacion de botones -->
        <nav>
            <div>
                <table class="botonesMenu">
                    <tr>
                        <td class="botonesMenu">
                            <form action="index.php" method="post">
                                <input class="menu" type="submit" value="Indice">
                            </form>
                        </td>
                        <td class="botonesMenu">
                            <form action="../consulta.php" method="post">
                                <input class="menu" type="submit" value="Consulta de comerciales">
                            </form>
                        </td>
                        <td class="botonesMenu">
                            <form action="../insercion.php" method="post">
                                <input class="menu" type="submit" value="Indice inserción">
                            </form>
                        </td>
                        <td class="botonesMenu">
                            <form action="../modificacion.php" method="post">
                                <input class="menu" type="submit" value="Indice modificar">
                            </form>
                        <td class="botonesMenu">
                            <form action="../eliminacion.php" method="post">
                                <input class="menu" type="submit" value="Indice eliminar">
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </nav>
    </div>
    <h1>Insertando venta<span class="subtitulo"></span></h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table width="50%" border="0" align="center">
            <tr>
                <td class="primera_fila">Codigo vendedor</td>
                <td class="primera_fila">Referencia del producto</td>
                <td class="primera_fila">Cantidad</td>
                <td class="primera_fila">Fecha</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
                <td class="sin">&nbsp;</td>
            </tr>
            <?php
            $row = $registros->fetch();
            while ($row != null) {
            ?>
                <tr>
                    <td><?php echo $row['codComercial']; ?></td>
                    <td><?php echo $row['refProducto']; ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                </tr>
            <?php
                $row = $registros->fetch();
            }
            $conexion = null;
            ?>
            <tr>

                <td>
                    <select name='cod' id='cod'>
                        <?php
                        echo "<option name='ref' value=''>Codigo de vendedor</option>";
                        $conexion = conectar("ventas_comerciales");
                        $query = "select codigo from comerciales";
                        $registros = $conexion->query($query) or die($conexion->error);
                        $row = $registros->fetch();
                        while ($row != null) {
                        ?>
                            <option value="<?php echo $row['codigo']; ?>"><?php echo $row['codigo']; ?></option>
                        <?php

                            $row = $registros->fetch();
                        }
                        $conexion = null;
                        ?>
                    </select>

                </td>
                <td><select name='ref' id='ref'>
                        <?php
                        echo "<option name='ref' value=''>Referencia del producto</option>";
                        $conexion = conectar("ventas_comerciales");
                        $query = "select DISTINCT refProducto from ventas";
                        $registros = $conexion->query($query) or die($conexion->error);
                        $row = $registros->fetch();
                        while ($row != null) {
                        ?>
                            <option value="<?php echo $row['refProducto']; ?>"><?php echo $row['refProducto']; ?></option>
                        <?php

                            $row = $registros->fetch();
                        }
                        $conexion = null;
                        ?>
                    </select>
                </td>
                <td><input type='number' name='cant' size='10' class='centrado' value = 0 min=0></td>
                <td><input type='date' name='fecha' size='10' class='centrado'></td>
                <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
                <td class='bot'><input type='submit' name='back' id='back' value='Volver'></td>
            </tr>
        </table>
        <?php
        //Muestra un mensaje, segun el resultado del insertado del comercial
        if (isset($_POST['cr'])) {
            echo "<br>" . $mensaje;
        } ?>
    </form>
</body>

</html>