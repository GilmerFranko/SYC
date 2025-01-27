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
    <a href="<?= gLink('admin/new.subforum') ?>" class="btn-floating btn-large btn-primary darken-4"><i class="material-icons notranslate">add</i></a>
  </div>
  <table class="table striped responsive-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Foro - Foro</th>
        <th>Nombre</th>
        <th>URL corta</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($subforums['rows'] > 0)
      {
        foreach ($subforums['data'] as $subforum)
        { ?>
          <tr>
            <td><?= $subforum['id']; ?></td>
            <td><?= $subforum['forum_name']; ?></td>
            <td><?= $subforum['name']; ?></td>
            <td><?= $subforum['short_url']; ?></td>
            <td><?= $subforum['status']; ?></td>
            <td>
              <a class="btn-floating btn-small waves-effect waves-light blue" href="<?= gLink('admin/edit.subforum', ['subforum_id' => $subforum['id']]) ?>"><i class="material-icons">edit</i></a>
              <a id="btn_delete" class="btn-floating btn-small waves-effect waves-light red" href="#"><i class="material-icons">delete</i></a>
            </td>
          </tr>
      <?php }
      }
      else echo '<tr><td colspan="8">No hay foros</td></tr>'; ?>
    </tbody>
  </table>
  <?php
  if ($subforums['rows'] > 0)
  {
    echo $subforums['pages']['paginator'];
  }
  ?>
</section>

<script>
  $('#btn_delete').click(function() {
    Swal.fire({
      title: '¿Estás seguro de que desea eliminar esta subforo?',
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
          url: '<?= gLink('admin/edit.subforum', ['delete_subforum' => true]) ?>',
          type: 'POST',
          data: {
            subforum_id: <?= $subforum['id'] ?>,
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