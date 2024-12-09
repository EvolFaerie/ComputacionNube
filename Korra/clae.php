<?php
session_start();

// Verifica si el usuario es administrador
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: readOnly.php"); // Redirige a la página de solo consulta
    exit();
}

// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'personajes';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$id = $nombre = $elemento = $info = $img = "";

// Manejar la acción de editar
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM data WHERE Id=$id") or die($conn->error);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['Nombre'];
        $elemento = $row['Elemento'];
        $info = $row['Info'];
        $img = $row['Img'];
    }
}

// Manejar la acción de guardar (insertar o actualizar)
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $elemento = $_POST['elemento'];
    $info = $_POST['info'];
    $img = $_POST['img'];

    if (!empty($id)) {
        // Actualizar registro existente
        $conn->query("UPDATE data SET Nombre='$nombre', Elemento='$elemento', Info='$info', Img='$img' WHERE Id=$id") or die($conn->error);
    } else {
        // Insertar nuevo registro
        $conn->query("INSERT INTO data (Nombre, Elemento, Info, Img) VALUES ('$nombre', '$elemento', '$info', '$img')") or die($conn->error);
    }

    header("Location: clae.php");
    exit;
}

// Manejar la acción de eliminar
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM data WHERE Id=$id") or die($conn->error);
    header("Location: clae.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>CLAE - The Legend of Korra</title>
    <style>
        body {
        font-family: "Verdana", Verdana;
        font-weight: 400;
        font-style: normal;
        font-size: large;
        background-color: #c6dcfb; /* Light blue background */
        margin: 0;
        padding-bottom: 60px;
        text-align: center;
        }       
    h1, h2 {
        font-family: "Megrim", system-ui;
        font-size: xx-large;
        color: #006aff; /* Blue for headings */
        }

    header {
        background-color: #00aaff; /* Bright blue for header */
        color: white;
        padding: 20px;
        text-align: center;
    }

    table {
        width: 90%; /* Slightly reduce width for better alignment */
        margin: 20px auto; /* Center the table horizontally */
        border-collapse: collapse;
        background-color: #ffffff; /* White background for the table */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    table, th, td {
        border: 1px #32643d solid; /* green border */
    }

    th, td {
        padding: 10px;
        text-align: center;
    }

    img {
        max-width: 100px;
        height: auto;
        margin: 0 auto;
        display: block;
    }

    form {
        background-color: #ffffff; /* White background for form */
        border: 1px #cccccc solid; /* Light gray border */
        border-radius: 10px; /* Rounded corners */
        padding: 20px; /* Adds internal padding */
        margin: 20px auto; /* Centers the form */
        max-width: 600px; /* Sets a maximum width */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
    }

    form input, form textarea, form button {
        margin: 10px 0;
        display: block;
        width: calc(100% - 20px); /* Full width with some margin */
        padding: 10px; /* Adds padding inside inputs */
        border: 1px solid #006aff; /* Blue border for inputs */
        border-radius: 5px; /* Slightly rounded corners */
    }

    form button, a.btn {
        background-color: #bef0ca; /* Blue background for button */
        color: black; /* White text */
        border: none; /* Removes border */
        border-radius: 20px; /* Rounded button */
        padding: 8px 16px; /* Adds space inside button */
        width: 90%;
        margin: 0 auto; /* Centers the button */
        cursor: pointer; /* Pointer cursor on hover */
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
        transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Hover animation */
    }

    </style>
</head>
<body>
    <h1>The Legend of Korra</h1>
    
    <audio autoplay loop>
        <source src="love.mp3" type="audio/mpeg">
    </audio>

    <!-- Formulario para agregar o editar registros -->
    <form action="clae.php" method="POST">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <input type="text" name="nombre" placeholder="Nombre del personaje" value="<?php echo isset($nombre) ? $nombre : ''; ?>" required>
        <input type="text" name="elemento" placeholder="Elemento" value="<?php echo isset($elemento) ? $elemento : ''; ?>" required>
        <textarea name="info" placeholder="Información del personaje" required><?php echo isset($info) ? $info : ''; ?></textarea>
        <input type="text" name="img" placeholder="Ruta de la imagen (ej. images/korra1.jpg)" value="<?php echo isset($img) ? $img : ''; ?>">
        <br><button class="btn1" type="submit" name="save">Guardar</button><br>
    </form>

    <!-- Tabla para visualizar registros -->
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Elemento</th>
                <th>Información</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM data") or die($conn->error);
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Nombre']; ?></td>
                <td><?php echo $row['Elemento']; ?></td>
                <td><?php echo $row['Info']; ?></td>
                <td>
                    <?php if (!empty($row['Img'])): ?>
                        <img src="<?php echo $row['Img']; ?>" alt="Imagen de <?php echo $row['Nombre']; ?>">
                    <?php else: ?>
                        Sin imagen
                    <?php endif; ?>
                </td>
                <td>
                    <a href="clae.php?edit=<?php echo $row['Id']; ?>">Editar</a>
                    <a href="clae.php?delete=<?php echo $row['Id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <br>

    <!-- Botón para regresar a la página principal -->
    <a href="index.html" class="btn">Regresar a la Página Principal</a>

</body>
</html>
