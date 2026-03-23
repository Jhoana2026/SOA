<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <title>Consulta de Estudiantes</title>
</head>
<body>

    <h1>Sistema de Gestión de Estudiantes</h1>
    
    <button type="button" name="btnListar" id="btnListar">Listar</button>
    <button type="button" name="btnInsertar" id="btnInsertar">Insertar</button>
    <button type="button" name="btnEliminar" id="btnEliminar">Eliminar</button>
    <button type="button" name="btnActualizar" id="btnActualizar">Actualizar</button>

    <p id="resultado"></p>

    <form id="FormGuardar">
        <div class="form-group">
            <label for="txtCedula">Cedula</label>
            <input type="text" class="form-control" id="txtCedula" name="txtCedula" placeholder="Ingrese cédula">
        </div>

        <div class="form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Ingrese nombre">
        </div>

        <div class="form-group">
            <label for="txtApellido">Apellido</label>
            <input type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Ingrese apellido">
        </div>

        <div class="form-group">
            <label for="txtTelefono">Telefono</label>
            <input type="text" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Ingrese teléfono">
        </div>

        <div class="form-group">
            <label for="txtDireccion">Direccion</label>
            <input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Ingrese dirección">
        </div>
    </form>

    <script>
        const apiUrl = 'http://localhost/SOA/api.php';

        $('#btnListar').click(function () {
            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let tabla = `
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    response.forEach(estudiante => {
                        tabla += `
                            <tr>
                                <td>${estudiante.cedula}</td>
                                <td>${estudiante.nombre}</td>
                                <td>${estudiante.apellido}</td>
                                <td>${estudiante.telefono}</td>
                                <td>${estudiante.direccion}</td>
                            </tr>
                        `;
                    });

                    tabla += `
                            </tbody>
                        </table>
                    `;

                    $('#resultado').html(tabla);
                },
                error: function (xhr, status, error) {
                    console.error('Error GET:', error);
                    console.log(xhr.responseText);
                    alert("Error al listar");
                }
            });
        });

        $('#btnInsertar').click(function () {
            $.ajax({
                url: apiUrl,
                type: 'POST',
                data: {
                    txtCedula: $("#txtCedula").val(),
                    txtNombre: $("#txtNombre").val(),
                    txtApellido: $("#txtApellido").val(),
                    txtTelefono: $("#txtTelefono").val(),
                    txtDireccion: $("#txtDireccion").val()
                },
                success: function (response) {
                    console.log(response);
                    alert("Se insertó correctamente");
                    $('#FormGuardar')[0].reset();
                    $('#btnListar').click();
                },
                error: function (xhr, status, error) {
                    console.error('Error INSERT:', error);
                    console.log(xhr.responseText);
                    alert("No se insertó");
                }
            });
        });

        $('#btnEliminar').click(function () {
            $.ajax({
                url: apiUrl + "?txtCedula=" + $("#txtCedula").val(),
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    alert("Se eliminó correctamente");
                    $('#FormGuardar')[0].reset();
                    $('#btnListar').click();
                },
                error: function (xhr, status, error) {
                    console.error('Error DELETE:', error);
                    console.log(xhr.responseText);
                    alert("No se eliminó");
                }
            });
        });

        $('#btnActualizar').click(function() { 
            $.ajax({
                url: apiUrl + "?txtCedula="+$("#txtCedula").val() +
                            "&txtNombre="+$("#txtNombre").val()+
                            "&txtApellido="+$("#txtApellido").val()+
                            "&txtTelefono="+$("#txtTelefono").val()+
                            "&txtDireccion="+$("#txtDireccion").val(),
                type: 'PUT',
                dataType: 'json', //TIPO DE DATOS ESPERADOS
                success: function(response) {
                    console.log(response);
                    alert(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error POST:', error);
                    console.log(xhr.responseText);
                    alert("No se actualizo");
                }
            });
        });
    </script>

</body>
</html>