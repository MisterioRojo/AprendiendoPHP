<?php

function seeTableAficiones(){
    global $conexion;
    $query= "SELECT * FROM aficiones";
    $resultado = $conexion->query($query);
    if($resultado){
        $resultado->setFetchMode(PDO::FETCH_ASSOC);
        $tabla = $resultado->fetchAll();
    }
    else{
        $tabla = [];
        $tabla = "<tr><td colspan = '5'>No members in databse</td></tr>";
    }
    return $tabla;
}

function seeTableAmigosAficiones(){
    global $conexion;
    $query= "SELECT * FROM aficionesamigos";
    $resultado = $conexion->query($query);
    if($resultado){
        $resultado->setFetchMode(PDO::FETCH_ASSOC);
        $tabla = $resultado->fetchAll();
    }
    else{
        $tabla = [];
        $tabla = "<tr><td colspan = '5'>No members in databse</td></tr>";
    }
    return $tabla;
}

function seeTableAmigos(){
    global $conexion;
    $query= "SELECT * FROM tb_amigos";
    $resultado = $conexion->query($query);
    if($resultado){
        $resultado->setFetchMode(PDO::FETCH_ASSOC);
        $tabla = $resultado->fetchAll();
    }
    else{
        $tabla = [];
        $tabla = "<tr><td colspan = '5'>No members in databse</td></tr>";
    }
    return $tabla;
}
//Escribir CSV en BD Controlador
function operacionesCSV_BDAficiones($id, $nombre)
{
    global $conexion;
    $sql = "select * from aficiones where idAficion = '$id'";

    $resultado = $conexion->query($sql);
    try {
        if ($resultado->fetch()) {
            $sql = "UPDATE aficiones SET nombreAficion='$nombre' WHERE idAficion = $id";
        } else {
            $sql = "INSERT INTO aficiones (idAficion, nombreAficion) VALUES ($id, '$nombre')";
        }
        $conexion->exec($sql);
        unset($con);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

//Escribir CSV en BD Controlador
function operacionesCSV_BDAficionesAmigos($nombreAmigo, $aficion)
{
    global $conexion;
    $sql = "select * from aficionesamigos where nombreAmigo = '$nombreAmigo'";

    $resultado = $conexion->query($sql);
    try {
        if ($resultado->fetch()) {
            $sql = "UPDATE aficionesamigos SET nombreAmigo='$nombreAmigo' WHERE nombreAmigo = '$nombreAmigo'";
        } else {
            $sql = "INSERT INTO aficionesamigos(nombreAmigo,aficion) VALUES ('$nombreAmigo',$aficion)";
        }
        $conexion->exec($sql);
        unset($con);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Escribir CSV en BD Controlador
function operacionesCSV_BDAmigos($nombreYapel, $email, $sexo, $url, $convivientes, $favorito)
{
    global $conexion;
    $sql = "SELECT * FROM tb_amigos where nombreYapel = '$nombreYapel'";
    $resultado = $conexion->query($sql);

    try {
        if ($resultado->fetch()) {
            //Actualizamos la fecha de modificación
            $sql = "UPDATE tb_amigos SET email='$email',sexo='$sexo',url='$url',convivientes='$convivientes',favorito='$favorito' WHERE nombreYapel='$nombreYapel'";
        } else {
            $sql = "INSERT INTO tb_amigos(nombreYapel,email,url,sexo,convivientes,favorito) VALUES ('$nombreYapel','$email','$url','$sexo',$convivientes,'$favorito')";
        }
        $conexion->exec($sql);
        unset($con);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
//Escribir CSV en BD
function escribirCSVBDAficiones($fichero)
{
    $fila = 0;
    $gestor = fopen($fichero, "r");
    if ($gestor !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            if ($fila != 0) {
                print_r($datos);
                operacionesCSV_BDAficiones($datos[0], $datos[1]);
            }
            $fila++;
        }
        fclose($gestor);
    }
}

//Escribir CSV en BD
function escribirCSVBDAficionesAmigos($fichero)
{
    $fila = 0;
    $gestor = fopen($fichero, "r");
    if ($gestor !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            if ($fila != 0) {

                operacionesCSV_BDAficionesAmigos($datos[0], $datos[1]);
            }
            $fila++;
        }
        fclose($gestor);
    }
}

//Escribir CSV en BD
function escribirCSVBDAmigos($fichero)
{
    $fila = 0;
    $gestor = fopen($fichero, "r");
    if ($gestor !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            if ($fila != 0) {

                operacionesCSV_BDAmigos($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
            }
            $fila++;
        }
        fclose($gestor);
    }
}
