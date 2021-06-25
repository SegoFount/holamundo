<?php 
if ( !file_exists('config.php') ) {
    die( 'ERROR: no existe el fichero config.php');
}
require( 'config.php' );

// Establecer el idioma que PHP lo va a sacar por pantalla.  Cambiar fechas a español u todo.
setlocale( LC_TIME, SITE_LANG ); 
// LC_TIME es la constante a traducier, los siguientes parametros son la forma de expresarlo según si la máquina local es windows, mac o linux.
// Con esto establecemos la hora del proyecto, en lugar de la hora del servidor.
date_default_timezone_set( SITE_TIMEZONE );

$app_db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_DABABASE, DB_PORT );
// Si la conexisón ha ido mal, devuelve un false, sino devuelve el recurso.
if (!$app_db){
    die( 'Error de conexión con el servidor de la base de datos');
}
// El init no sólo nos a a servir para configurar todo lo generico, sino que también va a llamar a los ficheros necesarios.
require('inc/posts.php'); // funciones referentes a los posts.
require('inc/helpers.php'); // funciones auxiliares de ayuda.