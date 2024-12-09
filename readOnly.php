<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'personajes';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Consulta - The Legend of Korra</title>

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
        background-color: #9fbada; /* Bright blue for header */
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

    /* Agrega un estilo para los enlaces si es necesario */
    a {
        text-decoration: none;
        color: #006aff;
    }
    a:hover {
        color: #0088cc;
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
    <h1>Consulta de Personajes</h1>

    <audio autoplay loop>
        <source src="momo.mp3" type="audio/mpeg">
    </audio>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Elemento</th>
                <th>Información</th>
                <th>Imagen</th>
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
                        <img src="<?php echo $row['Img']; ?>" alt="Imagen de <?php echo $row['Nombre']; ?>" style="max-width: 100px; height: auto;">
                    <?php else: ?>
                        Sin imagen
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br>
    <a href="index.html" class="btn">Regresar a la Página Principal</a>
</body>
</html>
