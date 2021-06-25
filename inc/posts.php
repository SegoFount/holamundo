<?php
// Archivo donde escribo las funciones para trabajar con los posts.
/** -------------- Devuelve todos los posts -----------------------------
 *
 * @param - ninguno
 * --
 * @return - nada
 */
function get_all_posts(){
    global $app_db;
    $result = mysqli_query( $app_db, 'SELECT * FROM posts' ); // selecciono todos los posts de la tabla posts de la base de datos.
    if( !$result ){
        die( mysqli_error( $app_db ));
    }
    $all_posts = mysqli_fetch_all( $result, MYSQLI_ASSOC ); // La variable de sistema  MYSQLI_ASSOC, modifica el array para que sea asociativo, de modo que nos devuelve los nombres de las columnas en lugar de las posiciones numericas 1 , 2 , 3 , 4 ... 
   
    return $all_posts;
}
// ---------------------------------------------------------------------------
/** ------------- Funcion para Buscar y devuelve un solo post ----------------
 * 
 * @param $post_id
 * ---------------
 * @return $post_found 
 */
function get_post( $post_id ){
    global $app_db;

    $post_id = intval($post_id); // SEGURIDAD ---- esta función hace que cuando recibimos un id que no es un entero, portegemos el código.
    $query = 'SELECT * FROM posts WHERE id = '.$post_id;
    $result = mysqli_query( $app_db, $query );

    if( !$result ){             // en este bucle entra si ha encontrado un post valido.
        die( mysqli_error( $app_db ) );
    }
    $post_found = mysqli_fetch_assoc( $result ); // mysqli_fetch_assoc Función que devuelve una fila de arrays como array asociativo.

    return $post_found; // si no lo encuentra devuelve NULL.
}
// ---------------------------------------------------------------------------
/** ---------------------- Funcion para inserta un post ----------------------
 * @param $title
 * @param $excerpt
 * @param $content
 * ---------------
 * @return - nada
 */
function insert_post( $title, $excerpt, $content ){
    global $app_db;
    $published_on = date('Y-m-d H:i:s');
    $title = mysqli_real_escape_string( $app_db, $title ); // SEGURIDAD ---- esta función lo que hace es proteger la base de datos de posibles querys dañinas.
    $excerpt = mysqli_real_escape_string( $app_db, $excerpt );
    $content = mysqli_real_escape_string( $app_db, $content );

    // vamos a construir el insert de la tabla de datos, los campos introduccidos y hacer la conexión con la base de datos para guardarlos allí. 
    $query = "INSERT INTO posts ( title, excerpt, content, published_on ) VALUES ('$title','$excerpt','$content','$published_on' )";
    $result = mysqli_query( $app_db, $query );
    if ( !$result ){
       die( mysqli_error( $app_db ) ); // Funcion que muestra el último error en la base de datos.
    }
}
// ---------------------------------------------------------------------------
/** ---------------------- Funcion para borrar un post -----------------------
 * @param $id
 * -
 * @return - nada
 */
function delete_post( $id ){
    global $app_db;

    $id = intval($id); // SEGURIDAD ---- saneamos el entero del id.
    $query = "DELETE FROM posts WHERE id = $id";
    $result = mysqli_query( $app_db, $query );
    if( !$result ){
        die( mysqli_error( $app_db) );
    }
}
// ----------------------------------------------------------------------------