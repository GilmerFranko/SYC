<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de reportes agrupados por thread_id
 *
 *
 */
?>
<!-- Modal de confirmar eliminación de anuncio -->
<div id="deleteThreadModal" class="modal">
  <div class="modal-content">
    <h4>Confirmar eliminación</h4>
    <p>¿Estás seguro de que deseas eliminar este anuncio? Esta acción no se puede deshacer.</p>
    <div class="row">
      <div class="input-field col s12">
        <input id="password" name="password" type="password" class="validate" required>
        <label for="password">Ingresa tu contraseña para confirmar</label>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
    <a href="#" class="modal-action waves-effect waves-green btn-flat" onclick="confirmDelete()">Eliminar</a>
  </div>
</div>

<!-- Modal de suspender usuario -->
<div id="suspendUserModal" class="modal">
  <div class="modal-content">
    <h4>Suspender usuario</h4>
    <p>Introduce la razón para suspender al usuario.</p>
    <div class="row">
      <div class="input-field col s12">
        <textarea id="reason" name="reason" class="materialize-textarea">Incumplimiento con nuestras normas</textarea>
        <label for="reason">Razón</label>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
    <a href="#" class="modal-action waves-effect waves-green btn-flat" onclick="suspendUser(<?= $reports['data'][0]['member_id'] ?>, document.getElementById('reason').value)">Suspender usuario</a>
  </div>
</div>

<!-- Body -->
<section>
  <h1 class="center-align">Reportes de <span class="text-primary"><?= $reports['data'][0]['thread_title'] ?></span></h1>
  <p class="center-align light grey-text text-darken-2">A continuación, todos los reportes de <?= $reports['data'][0]['thread_title'] ?>.</p>
  <center>
    <a href="<?= loadClass('forums/threads')->getThreadUrl($reports['data'][0]['thread_id']) ?>" class="btn waves-effect waves-light orange darken-3">Ver Anuncio</a>

    <a href="#suspendUserModal" class="btn waves-effect waves-light green darken-3 modal-trigger">Suspender usuario</a>

    <a href="#deleteThreadModal" class="btn waves-effect waves-light red darken-3 modal-trigger">Eliminar Anuncio</a>
  </center>
  <div class="container"><br>
    <div class="row">
      <div class="col s12 m10 offset-m1">
        <table class="striped responsive-table">
          <thead>
            <tr>
              <th>Reporte</th>
              <th>Denunciado</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reports['data'] as $report): ?>
              <tr>
                <td>
                  <a href="<?= gLink('admin/reports', ['byThreadId' => $report['thread_id']]) ?>" class="title truncate" title="<?= $report['reason']; ?>" style="max-width: 250px;">
                    <?= ($report['reason']); ?>
                  </a>
                </td>
                <td><a href=""><?= $report['member_name']; ?></a></td>
                <td><?= date('Y-m-d H:i:s', $report['reported_at']); ?></td>
                <td>
                  <a href="<?= gLink('admin/reports', ['byThreadId' => $report['thread_id']]) ?>"><i class="material-icons">remove_red_eye</i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php
  // Agrega paginador
  echo $reports['pages']['paginator'];
  ?>
</section>

<script>
  // Inicializar los modales de Materialize
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });

  function suspendUser(member_id, reason) {
    $.ajax({
      url: '<?= gLink('admin/reports') ?>',
      type: 'POST',
      data: {
        suspend: member_id,
        reason: reason,
        token: '<?= $session->token ?>',
        ajax: true
      },
      dataType: 'json',
      success: function(data) {
        if (data.success) {
          M.toast({
            html: data.msg,
            classes: 'green darken-1'
          });
          $('#suspendUserModal').modal('close');
        } else {
          M.toast({
            html: data.msg,
            classes: 'red darken-1'
          });
        }
      }
    });
  }

  function confirmDelete() {
    var password = document.getElementById('password').value;
    if (!password) {
      M.toast({
        html: 'Por favor ingresa tu contraseña',
        classes: 'red darken-1'
      });
      return;
    }

    $.ajax({
      url: '<?= gLink('admin/reports', ['deleteThread' => true]) ?>',
      type: 'POST',
      data: {
        thread_id: <?= $reports['data'][0]['thread_id'] ?>,
        password: password,
        token: '<?= $session->token ?>',
        ajax: true
      },
      dataType: 'json',
      success: function(data) {
        console.log(data)
        if (data.success) {
          M.toast({
            html: data.msg,
            classes: 'green darken-1'
          });
          window.location.href = '<?= gLink('admin/reports') ?>';
        } else {
          M.toast({
            html: data.msg,
            classes: 'red darken-1'
          });
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr)
        console.log(status)
        console.log(error)
        M.toast({
          html: 'Ocurri un error al eliminar el tema',
          classes: 'red darken-1'
        });
      }
    });
  }
</script>