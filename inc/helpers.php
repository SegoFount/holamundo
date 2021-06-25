<?php 
/**
 * ------------------ Redirigir a una URL ------------------
 *  @param $path
 */

function redirect_to( $path ) {
    header('location: '. SITE_URL . $path);
    die();
}
// ------------------------------------------------------------
/**
 * --------------- Funcion para generar hash ------------------
 * genera una cadena alfahumérica 
 * 
 * @param action
 * ---
 * @return string
 */
function generate_hash( $action ){
    return md5($action);
}
// ------------------------------------------------------------
/**
 * --------------- Funcion para comprobar hash ----------------
 * @param action
 * @param hash
 * ---
 * @return bool
 */
function check_hash( $action, $hash ){
    if (generate_hash($action) == $hash){
        return true;
    }
        return false;
}