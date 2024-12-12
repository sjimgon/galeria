<?php

if(!isset($_POST['enviar'])){
    echo 'No se ha subido la imagen aún';
}else{
    $archivo = $_FILES['archivo'];
    $nombre = $archivo['name'];
    $tipo = $archivo['type'];
    $tamano = $archivo['size'];
    $dirTemp = $archivo['tmp_name'];
    $directorio = '';

    if($tipo == 'image/jpg' || $tipo == 'image/jpeg' || $tipo == 'image/png' || $tipo == 'image/gif' || $tamano <= 1000000){
        if(!is_dir('imagenes')){
            mkdir('imagenes', 0777);
        }
        $directorio .= 'imagenes/'.$nombre;
        move_uploaded_file($dirTemp, $directorio);
        echo 'Imagen subida correctamente';
    }else{
        echo 'Sube una imagen con un formato correcto';
    }
}
//Prueba
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería</title>
</head>
<body>

<h2>Galería de imágenes</h2>

<form action="" method="post" enctype="multipart/form-data">

    <label for="archivo">Selecciona el archivo: </label>
    <input type="file" name="archivo" id="archivo">

    <button type="submit" value="enviar" name="enviar">Enviar</button>
</form>

<?php

if(isset($_POST['enviar'])){

    $directorio = opendir('imagenes');
    while($imagen = readdir($directorio)){
        if($imagen != '.' && $imagen != '..'){
            echo "<img src='imagenes/$imagen' width='300px' >";
        }
    }   
}
?>
    
</body>
</html>