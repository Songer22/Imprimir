<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener la ip de la mauquina desde donde se sube el archivo
    $ip = $client_ip = $_SERVER['REMOTE_ADDR'];

    // Validar la maquina y nombrear la carpeta donde se subiran los archivos
    if($ip == '148.234.170.150'){
        $carpeta = "Maquina-00";
    } 
    else if($ip == '148.234.170.151'){
        $carpeta = "Maquina-01";
    } 
    else if($ip == '148.234.170.152'){
        $carpeta = "Maquina-02";
    }
    else if($ip == '148.234.170.153'){
        $carpeta = "Maquina-03";
    }
    else if($ip == '148.234.170.154'){
        $carpeta = "Maquina-04";
    }
    else if($ip == '148.234.170.155'){
        $carpeta = "Maquina-05";
    }
    else if($ip == '148.234.170.156'){
        $carpeta = "Maquina-06";
    }
    else if($ip == '148.234.170.157'){
        $carpeta = "Maquina-07";
    }
    else if($ip == '148.234.170.158'){
        $carpeta = "Maquina-08";
    }
    else if($ip == '148.234.170.159'){
        $carpeta = "Maquina-09";
    }
    else if($ip == '148.234.170.160'){
        $carpeta = "Maquina-10";
    }
    else if($ip == '148.234.170.161'){
        $carpeta = "Maquina-11";
    }
    else if($ip == '148.234.170.162'){
        $carpeta = "Maquina-12";
    }
    else if($ip == '148.234.170.163'){
        $carpeta = "Maquina-13";
    }
    else if($ip == '148.234.170.164'){
        $carpeta = "Maquina-14";
    }
    else if($ip == '148.234.170.165'){
        $carpeta = "Maquina-15";
    }
    else if($ip == '148.234.170.166'){
        $carpeta = "Maquina-16";
    }
    else if($ip == '148.234.170.167'){
        $carpeta = "Maquina-17";
    }
    else if($ip == '148.234.170.168'){
        $carpeta = "Maquina-18";
    }
    else if($ip == '148.234.170.169'){
        $carpeta = "Maquina-19";
    }
    else if($ip == '148.234.170.170'){
        $carpeta = "Maquina-20";
    }
    else if($ip == '148.234.170.171'){
        $carpeta = "Maquina-21";
    }
    else if($ip == '148.234.170.172'){
        $carpeta = "Maquina-22";
    }
    else if($ip == '148.234.170.173'){
        $carpeta = "Maquina-23";
    }
    else if($ip == '148.234.170.174'){
        $carpeta = "Maquina-24";
    }
    else if($ip == '148.234.170.175'){
        $carpeta = "Maquina-25";
    }
    else if($ip == '148.234.170.176'){
        $carpeta = "Maquina-26";
    }
    else if($ip == '148.234.170.177'){
        $carpeta = "Maquina-27";
    }
    else if($ip == '148.234.170.178'){
        $carpeta = "Maquina-28";
    }
    else if($ip == '148.234.170.179'){
        $carpeta = "Maquina-29";
    }
    else if($ip == '148.234.170.180'){
        $carpeta = "Maquina-30";
    }
    else if($ip == '148.234.170.181'){
        $carpeta = "Maquina-31";
    }
    else if($ip == '148.234.170.182'){
        $carpeta = "Maquina-32";
    }
    else if($ip == '148.234.170.183'){
        $carpeta = "Maquina-33";
    }
    else if($ip == '148.234.170.184'){
        $carpeta = "Maquina-34";
    }
    else if($ip == '148.234.170.185'){
        $carpeta = "Maquina-35";
    }
    else if($ip == '148.234.170.186'){
        $carpeta = "Maquina-36";
    }
    else{
        $carpeta = "Externo";
    }


    $directorioSubida = '../Forestales/public/documentos/'.$carpeta.'/';
    $nombreArchivo = pathinfo($_FILES['archivo']['name'], PATHINFO_FILENAME);
    $tipoArchivo = strtolower(pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION));

    // Crear el directorio si no existe
    if (!is_dir($directorioSubida)) {
        mkdir($directorioSubida, 0777, true);
    }

    // Generar un nombre de archivo único
    $archivoSubido = $directorioSubida . $nombreArchivo . '.' . $tipoArchivo;
    $contador = 1;
    while (file_exists($archivoSubido)) {
        $archivoSubido = $directorioSubida . $nombreArchivo . '(' .  $contador . ')' . '.' . $tipoArchivo;
        $contador++;
    }

    // peso del archivo
    if ($_FILES['archivo']['size'] > 15000000) { // 15MB en bytes
        echo "Lo siento, el archivo es demasiado grande.";
        exit;
    }

    // Intentar subir el archivo
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $archivoSubido)) {
        // echo "El archivo " . htmlspecialchars(basename($archivoSubido)) . " ha sido subido.";
        echo $nombreArchivo;
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
        exit;
    }
} else {
    echo "Método de solicitud no válido.";
    exit;
}







date_default_timezone_set('America/Monterrey');

$fecha_actual = date("Y-m-d");
$hora_actual = date("h:i:s");


// Create connection
$conn = mysqli_connect('127.0.0.1', 'alumnos', 'AlumnosFCF', 'forestales2');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully";

$sql = "INSERT INTO `documentos`(`NOMBRE_DOCUMENTO`, `UBICACION`, `TIPO_ARCHIVO`,`TIEMPO`) VALUES ('".$nombreArchivo."','".$carpeta."','".$tipoArchivo."','".$hora_actual."')";
if (mysqli_query($conn, $sql)) {
    // echo "New record created successfully";
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>

