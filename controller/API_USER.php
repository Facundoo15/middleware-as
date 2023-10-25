<?php
include_once "../model/database.php";

// UTILIZAMOS UN MIDDLEWARE EN FORMA DE API 
// PARA LAS CONSULTAS
class API_USUARIO
{

    // FUNCIÓN PARA AGREGAR UN USUARIO
    public static function registrarUsuario($nombre, $apellido, $correo, $contrasenia)
    {
        $conexionDB = DATABASE::crearInstancia();
        $sql = "INSERT INTO USUARIOS(nombre,apellido,correo,contrasenia) VALUES (:nombre, :apellido, :correo, :contrasenia)";
        $consulta = $conexionDB->prepare($sql);
        $consulta->bindParam(":nombre", $nombre);
        $consulta->bindParam(":apellido", $apellido);
        $consulta->bindParam(":correo", $correo);
        $consulta->bindParam(":contrasenia", $contrasenia);
        $consulta->execute();
    }
    // FUNCIÓN PARA LISTAR USUARIOS
    public static function listarUsuarios()
    {
        $conexionDB = DATABASE::crearInstancia();
        $sql = "SELECT * FROM USUARIOS";
        $consulta = $conexionDB->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll();
    }
    // FUNCIÓN PARA VALIDAR CORREO
    public static function validarCorreo($correo)
    {
        $conexionDB = DATABASE::crearInstancia();
        $sql = "SELECT * FROM USUARIOS WHERE correo = :correo";
        $consulta = $conexionDB->prepare($sql);
        $consulta->bindParam(":correo", $correo);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }






}




?>