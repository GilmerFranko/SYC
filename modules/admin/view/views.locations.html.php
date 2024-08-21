<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de los foros
 *
 *
 */

require Core::view('head', 'core');

?>

<section>
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
  <div class="fixed-action-btn direction-top active" bis_skin_checked="1">
    <a href="<?= gLink('admin/new.location') ?>" class="btn-floating btn-large btn-primary darken-4"><i class="material-icons notranslate">add</i></a>
  </div>
  <table class="table striped responsive-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Contacto - Foro</th>
        <th>Nombre</th>
        <th>URL corta</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($locations['rows'] > 0)
      {
        foreach ($locations['data'] as $location)
        { ?>
          <tr>
            <td><?= $location['id']; ?></td>
            <td><?= $location['contact_name']; ?></td>
            <td><?= $location['name']; ?></td>
            <td><?= $location['short_url']; ?></td>
            <td><?= $location['status']; ?></td>
            <td>
              <a class="btn-floating btn-small waves-effect waves-light blue" href="<?= gLink('admin/edit.location', ['location_id' => $location['id']]) ?>"><i class="material-icons">edit</i></a>
              <a id="btn_delete" class="btn-floating btn-small waves-effect waves-light red" href="#"><i class="material-icons">delete</i></a>
            </td>
          </tr>
      <?php }
      }
      else echo '<tr><td colspan="8">No hay foros</td></tr>'; ?>
    </tbody>
  </table>
  <?php
  if ($locations['rows'] > 0)
  {
    echo $locations['pages']['paginator'];
  }
  ?>
</section>

<script>
  $('#btn_delete').click(function() {
    Swal.fire({
      title: '¿Estás seguro de que desea eliminar esta ubicacion?',
      html: '',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, estoy seguro',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '<?= gLink('admin/edit.location', ['delete_location' => true]) ?>',
          type: 'POST',
          data: {
            location_id: <?= $location['id'] ?>,
            ajax: true
          },
          success: function(response) {
            var data = JSON.parse(response);
            if (data.status == true) {
              m.toast({
                html: data.message
              });
            } else {
              m.toast({
                html: 'Error al eliminar la ubicación'
              });
            }
          }
        })
      }
    })
    return false;
  })
</script>