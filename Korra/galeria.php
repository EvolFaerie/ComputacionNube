<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Galería de Imágenes</title>
    <style>
        body {
            font-family: "Verdana", sans-serif;
            font-weight: 400;
            font-size: medium;
            background-color: #dce7f3; /* Soft water-like blue for the background */
            color: #333; /* Neutral text color for contrast */
            margin: 0;
            text-align: center;
            padding-bottom: 40px;
        }

        h1 {
            margin-top: 20px;
            font-family: "Megrim", sans-serif; /* Unique style for the header */
            font-size: xx-large;
            color: #00577a; /* Deep blue inspired by the Water Tribe */
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px #87a9c3; /* Subtle shadow for depth */
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px; /* Constrain the gallery width for better layout */
            background-color: rgba(255, 255, 255, 0.9); /* Light background with transparency */
            border-radius: 15px; /* Rounded edges for a polished look */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
            padding: 30px;
        }

        .gallery img {
            max-width: 100%; /* Allow images to scale with container width */
            height: auto; /* Maintain aspect ratio */
            border: 3px solid #006985; /* Inspired by Korra’s blue tones */
            border-radius: 10px;
            transition: transform 0.3s, border-color 0.3s;
            object-fit: contain; /* Ensures images are not distorted */
        }


        .gallery img:hover {
            transform: scale(1.1);
            border-color: #80b5d3; /* Softer blue highlight when hovering */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Add hover shadow for a pop effect */
        }

        button {
            width: 75%;
            margin: 10px auto;
            padding: 8px 16px;
            font-size: medium;
            background-color: #bef0ca; /* Deep blue for a Korra-inspired button */
            color: black;
            border: none;
            border-radius: 20px; /* Rounded edges for elegance */
            cursor: pointer;
            text-transform: uppercase; /* Bold, uppercase styling */
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
            z-index: 1; /* Ensures button stays behind the footer */
        }

        footer {
            text-align: center;
            padding: 8px;
            background-color: #0077aa;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
            height: 35px;
            z-index: 10;
        }
    </style>
</head>
<body>
    <h1>Galería de Imágenes - The Legend of Korra</h1>
    
    <audio autoplay loop>
        <source src="iro.mp3" type="audio/mpeg">
    </audio>

    <div class="gallery">
        <?php
        // Ruta de la carpeta de imágenes
        $folderPath = 'Galery';

        // Verifica si la carpeta existe
        if (is_dir($folderPath)) {
            // Obtén todos los archivos de la carpeta
            $images = scandir($folderPath);

            // Filtra para mostrar solo imágenes
            foreach ($images as $image) {
                $filePath = $folderPath . '/' . $image;
                if (is_file($filePath) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $image)) {
                    echo "<img src='$filePath' alt='Imagen de Korra'>";
                }
            }
        } else {
            echo "<p>No se encontró la carpeta de imágenes.</p>";
        }
        ?>
    </div>

    <br><button onclick="location.href='Index.html'">Regresar al Inicio</button><br><br>

    <footer>
        <p>&copy; Todos los derechos reservados.</p>
    </footer>
</body>
</html>