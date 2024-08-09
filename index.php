<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Imprimir</title>
    <link rel="icon" href="icono.webp" type="image/x-icon">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        max-width: 400px;
        width: 100%;
        transform: scale(2.1);
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(2.1);
    }

    h1 {
        color: #333;
        margin-bottom: 20px;
    }

    .file-input {
        display: none;
    }

    .file-label {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .file-label:hover {
        background-color: #45a049;
    }

    .btn-upload {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
        transition: background-color 0.3s ease;
    }

    .btn-upload:hover {
        background-color: #0056b3;
    }

    .file-display-area {
        margin-top: 20px;
        font-size: 14px;
        color: #666;
    }
</style>

<body>
    <div class="container">
        <h2>Subir Documento</h2>
        <form id="formuploadajax" method="post" enctype="multipart/form-data">
            <label for="fileInput" class="file-label">Seleccionar archivo</label>
            <input type="file" class="file-input" name="archivo" id="fileInput" required onchange="updateFileName();">
            <input type="submit" class="btn-upload" value="Subir Documento" name="submit">
        </form>
        <div id="fileDisplayArea" class="file-display-area"></div>
    </div>

    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $("#formuploadajax").on("submit", function(e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("formuploadajax"));
            formData.append("dato", "valor");

            $.ajax({
                url: "subir_documento.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
            }).done(function(resp){
                $("#fileInput").val('');
                console.log(resp);
                fileDisplayArea.innerHTML = '';

                swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito",
                    // text: "¡¡Se subió un documento con el nombre de "+resp+" !!!",
                    html: '¡¡Se subió un documento con el nombre de: <br><br>"<b><u>' + resp + '"</b></u>!!!',
                    showConfirmButton: true,
                });

            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error: " + textStatus + " " + errorThrown);
                console.error("Response Text: " + jqXHR.responseText);
                alert("Hubo un error al subir el archivo: " + textStatus + " " + errorThrown);
            });
        });

        function updateFileName() {
            var fileInput = document.getElementById('fileInput');
            var fileDisplayArea = document.getElementById('fileDisplayArea');
            
            if (fileInput.files.length > 0) {
                fileDisplayArea.innerHTML = 'Archivo seleccionado: ' + fileInput.files[0].name;
            } else {
                fileDisplayArea.innerHTML = '';
            }
        }
    </script>
</body>
</html>
