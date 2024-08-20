<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de los formularios de contacto
 *
 *
 */

require Core::view('head', 'core');

?>

<section>
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align">Contáctos</div>
  <div class="fixed-action-btn direction-top active" bis_skin_checked="1">
    <a href="<?= gLink('admin/new.contact') ?>" class="btn-floating btn-large btn-primary darken-4"><i class="material-icons notranslate">add</i></a>
  </div>
  <table class="table striped responsive-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Visibilidad</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($contacts['rows'] > 0)
      {
        foreach ($contacts['data'] as $contact)
        { ?>
          <tr>
            <td><?= $contact['id']; ?></td>
            <td><?= $contact['name']; ?></td>
            <td><?= $contact['status']; ?></td>
            <td><?= $contact['visibility']; ?></td>
            <td>
              <a class="btn-floating btn-small waves-effect waves-light blue" href="<?= gLink('admin/new.contact') ?>"><i class="material-icons">edit</i></a>
              <a class="btn-floating btn-small waves-effect waves-light red" href="#"><i class="material-icons">delete</i></a>
            </td>
          </tr>
      <?php }
      }
      else echo '<tr><td colspan="8">No hay secciones</td></tr>'; ?>
    </tbody>
  </table>
</section>