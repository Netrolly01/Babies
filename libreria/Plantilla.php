<?php

class Plantilla
{
    static $instance = null;

    public static function aplicar()
    {
        if (self::$instance == null) {
            self::$instance = new Plantilla();
        }
    }

    public function __construct()
    {
        ?>

        <!DOCTYPE html>
        <html lang="es">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>¡Crea tu Perfil Barbie Soñado!</title>
        
            <style>
                /* General body styles */
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background-image: url('https://fondosmil.co/fondo/53944.jpg');
                    margin: 0;
                    padding: 0;
                    color: #333;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    min-height: 100vh;
                }
        
                /* Header */
                .header {
                    width: 100%;
                    background: linear-gradient(135deg, #FF69B4, #FF1493);
                    color: white;
                    text-align: center;
                    padding: 20px 0;
                    font-size: 2em;
                    font-weight: bold;
                    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
                }
        
                /* Main container */
                .container {
                    width: 100%;
                    max-width: 1100px;
                    background: white;
                    padding: 20px;
                    margin: 30px auto;
                    border-radius: 12px;
                    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
                }
        
                /* Paragraph styles */
                p {
                    font-size: 1.2em;
                    color: #D5006D;
                    text-align: center;
                    font-style: italic;
                }
        
                /* Table styles */
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
        
                th, td {
                    padding: 12px;
                    text-align: left;
                    border-bottom: 2px solid #FF1493;
                    font-size: 1.1em;
                }
        
                th {
                    background: linear-gradient(135deg, #FF69B4, #FF1493);
                    color: white;
                }
        
                td {
                    background: rgba(255, 240, 246, 0.9);
                }
        
                /* Buttons */
                .boton {
                    display: block;
                    width: 100%;
                    max-width: 250px;
                    background: #FF1493;
                    color: white;
                    padding: 12px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 1.2em;
                    margin: 20px auto;
                    border-radius: 8px;
                    transition: 0.3s;
                }
        
                .boton:hover {
                    background: #FF77A9;
                }
        
                /* Footer */
                .footer {
                    width: 100%;
                    text-align: center;
                    padding: 15px 0;
                    font-size: 1em;
                    color: white;
                    background: linear-gradient(135deg, #FF69B4, #FF1493);
                    margin-top: auto;
                }
        
            </style>
        
        </head>
        
        <body>
            <div class="header">¡Crea tu Perfil Barbie Soñado!</div>
        
            <div class="container">
        <?php
    }

    public function __destruct()
    {
        ?>
            </div>
        
            <div class="footer">
                <p>Desarrollado por Netrolly01®️</p>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
