<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de nueva categoria foro
 *
 *
 */

require Core::view('head', 'core');
?>

<section id="adminNewForum">
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
  <div class="sectionForums container">
    <div class="row">
      <form class="col s12" id="newForumForm" method="POST" action="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'new.contact', null, array('do' => 'new')); ?>" enctype="multipart/form-data">

        <div class="input-field">
          <label for="name">Nombre</label>
          <input type="text" name="name" id="name" value="<?php echo Core::model('extra', 'core')->getInputValue('name', 'post'); ?>" required>
        </div>

        <div class="input-field">
          <label for="short_url">URL Corta (ejemplo: foro-hombres)</label>
          <textarea name="short_url" id="short_url" class="materialize-textarea" length="1000" required><?php echo Core::model('extra', 'core')->getInputValue('short_url', 'post'); ?></textarea>
        </div>

        <div class="input-field">
          <select name="status" id="status" required>
            <option value="" disabled selected>Elige uno</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select>
          <label for="status">Estado</label>
        </div>

        <!--<div class="input-field">
          <select name="visibility" id="visibility" required>
            <option value="" disabled selected>Elige uno</option>
            <option value="1">Publico</option>
            <option value="0">Privado</option>
          </select>
          <label for="visibility">Visibilidad</label>
        </div>-->

        <div class="">
          <input id="image" type="file" name="image" required>
          <label for="image">Imagen</label>
        </div>

        <br>
        <button class="btn" type="submit"><i class="material-icons right notranslate">send</i>Crear nuevo foro</button>
      </form>
    </div>
  </div>
</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>