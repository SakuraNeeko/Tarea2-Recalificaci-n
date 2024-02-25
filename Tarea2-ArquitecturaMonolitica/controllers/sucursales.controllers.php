<?php
error_reporting(0);
// Requerimientos
require_once('../config/sesiones.php');
require_once("../models/sucursales.models.php");

$Sucursales = new Sucursales;

switch ($_GET["op"]) {
    // Método para listar todos los registros 
    case 'todos':
        $datos = $Sucursales->todos();
        $todos = array();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    // Método para sacar un registro
    case 'uno':
        if (isset($_POST["SucursalId"])) {
            $SucursalId = $_POST["SucursalId"];
            $datos = $Sucursales->uno($SucursalId);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
        } else {
            echo json_encode(["error" => "No se proporcionó el ID de la sucursal"]);
        }
        break;

    // Método para insertar
    case 'insertar':
        $Nombre = $_POST["Nombre"] ?? "";
        $Direccion = $_POST["Direccion"] ?? "";
        $Telefono = $_POST["Telefono"] ?? "";
        $Correo = $_POST["Correo"] ?? "";
        $Parroquia = $_POST["Parroquia"] ?? "";
        $Canton = $_POST["Canton"] ?? "";
        $Provincia = $_POST["Provincia"] ?? "";
        $SucursalId = $_POST["SucursalId"] ?? "";
        $datos = $Sucursales->Insertar($Nombre, $Direccion, $Telefono, $Correo, $Parroquia, $Canton, $Provincia, $SucursalId);
        echo json_encode($datos);
        break;

    // Método para actualizar
    case 'actualizar':
        $SucursalId = $_POST["SucursalId"] ?? "";
        $Nombre = $_POST["Nombre"] ?? "";
        $Direccion = $_POST["Direccion"] ?? "";
        $Telefono = $_POST["Telefono"] ?? "";
        $Correo = $_POST["Correo"] ?? "";
        $Parroquia = $_POST["Parroquia"] ?? "";
        $Canton = $_POST["Canton"] ?? "";
        $Provincia = $_POST["Provincia"] ?? "";
        $datos = $Sucursales->Actualizar($SucursalId, $Nombre, $Direccion, $Telefono, $Correo, $Parroquia, $Canton, $Provincia);
        echo json_encode($datos);
        break;

    // Método para eliminar
    case 'eliminar':
        $SucursalId = $_POST["SucursalId"] ?? "";
        $datos = $Sucursales->Eliminar($SucursalId);
        echo json_encode($datos);
        break;
}
