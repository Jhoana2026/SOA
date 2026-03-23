<?php
include_once './cruds.php';
$opc=$_SERVER['REQUEST_METHOD'];
switch($opc){
case 'GET':  
    Cruds::selectEst(); 
    break;

case 'POST':  
    Cruds::insertEst(); 
    break;

case 'DELETE':  
    Cruds::deleteEst(); 
    break;

case 'PUT':  
    Cruds::updateEst(); 
    break;
}

?>