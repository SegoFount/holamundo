<?php require('init.php'); ?>
<?php
$error = false;
$title = '';
$excerpt = '';
$content = '';

    if ( isset($_POST['submit-new-post']) ){
// comprobamos que hemos enviado el formularios
// recogemos los campos según el nombre name del formulario.
       //$title = $_POST['title'];
       $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING );
       // $excerpt = $_POST['excerpt'];
       $excerpt = filter_input(INPUT_POST, 'excerpt', FILTER_SANITIZE_STRING );
       $content = strip_tags( $_POST['content'], '<br><p><a><img><div><h2><h3><h4>' ); // la función strip_tags, me permite filtrar todas las etiquetesas HTML y SCRIPS con la excepción de las que yo le diga en el segundo argumento mediante una string.

      if ( empty($title) || empty($content)){
            $error = true;

      }else{
         insert_post( $title, $excerpt, $content );
         // hacemos una redirección a la pagina principal de blog.
         redirect_to('index.php?success=true');
      }
    }
    // $title = '"onclick="alert()""';
    /*
    con filtro en titulo y extracto.j
<style>background: #000 !important;</style>
<script>alert(" QUE TE HACKEOOOOO ");</script>
    */
?>
<?php require('templates/header.php'); ?>

<h2>Crear nuevo post</h2>

<?php if ( $error ): ?>
   <div class="error">
   Error en el formulario.
   </div>

<?php endif; ?>

<form action="" method="post">
    <label for="title">Titulo *</label>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars( $title, ENT_QUOTES ); ?>">

     <label for="excerpt">Extracto</label>
     <input type="text" name="excerpt" id="excerpt" value="<?php echo htmlspecialchars( $excerpt, ENT_QUOTES ); ?>">

     <label for="content">Contenido *</label>
     <textarea name="content" id="content" cols="30" rows="30"><?php echo htmlspecialchars( $content, ENT_QUOTES ); ?></textarea>

     <p>
        <input type="submit" name="submit-new-post" value="Publicar">
     </p>
     <?php echo '<br>'.'La hora de publicación es la hora de Madrid: '.strftime('%H:%M');?>
</form>

<?php require('templates/footer.php'); ?>