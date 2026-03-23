<?php
include_once("conexion.php");
class Cruds{

public static function selectEst()
{
$objconexion=new conexion();
$conectar=$objconexion->Conectar();
$sqlSelect="select * from estudiantes";
$resultado=$conectar->prepare($sqlSelect);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
}
public static function insertEst()
{
$objconexion=new conexion();
$conectar=$objconexion->Conectar();
$cedula=$_POST['txtCedula'];
$nombre=$_POST['txtNombre'];
$apellido=$_POST['txtApellido'];
$telefono=$_POST['txtTelefono'];
$direccion=$_POST['txtDireccion'];
$sqlInsert="Insert into estudiantes values('$cedula','$nombre','$apellido','$telefono','$direccion')";
$resultado=$conectar->prepare($sqlInsert);
$resultado->execute();
$data="Se inserto correctamente el estudiante";
echo json_encode($data);
}
public static function deleteEst()
{
$objconexion=new conexion();
$conectar=$objconexion->Conectar();
$cedula=$_GET['txtCedula'];
$sqlDelete="delete from estudiantes where cedula='$cedula'";
$resultado=$conectar->prepare($sqlDelete);
$resultado->execute();
$data="Se elimino correctamente el estudiante";
echo json_encode($data);
}
public static function updateEst()
{
$objconexion=new conexion();
$conectar=$objconexion->Conectar();
$cedula=$_GET['txtCedula'];
$nombre=$_GET['txtNombre'];
$apellido=$_GET['txtApellido'];
$telefono=$_GET['txtTelefono'];
$direccion=$_GET['txtDireccion'];
$sqlUpdate="update estudiantes set nombre='$nombre', 
                                   apellido='$apellido', 
                                   telefono='$telefono',
                                   direccion='$direccion'
                                   WHERE cedula='$cedula'"; ///hay que terminar con los demas del update
$resultado=$conectar->prepare($sqlUpdate);
$resultado->execute();
$data="Se actualizo correctamente el estudiante";
echo json_encode($data);
}
}
?>