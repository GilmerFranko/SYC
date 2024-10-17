<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de acciones para un hilo (anuncio)
 *
 *
 */
require Core::view('head', 'core');
?>
<!-- Modal de confirmar activacion de anuncio -->
<div id="ActivateThreadModal" class="modal">
  <div class="modal-content">
    <h4>Confirmar activacion</h4>
    <p>¿Estás seguro de que deseas activar este anuncio?</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
    <a href="#" class="modal-action waves-effect waves-green btn-flat" onclick="confirmActivate()">Activar</a>
  </div>
</div>

<!-- Modal de confirmar activacion de anuncio -->
<div id="renewThreadModal" class="modal">
  <div class="modal-content">
    <h4>Confirmar renovación</h4>
    <p>¿Estás seguro de que deseas renovar este anuncio?</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
    <a href="#" class="modal-action waves-effect waves-green btn-flat" onclick="confirmRenew()">Destacar</a>
  </div>
</div>

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
    <a href="#" class="modal-action waves-effect waves-green btn-flat" onclick="suspendUser(<?= $thread['member_id'] ?>, document.getElementById('reason').value)">Suspender usuario</a>
  </div>
</div>

<!-- Body -->
<section>
  <h3 class="center-align">Anuncio&nbsp;<i class="text-primary"><?= cutText($thread['title'], 44) ?></i></h3>
  <p class="center-align light grey-text text-darken-2">A continuación, se muestra el anuncio <?= cutText($thread['title'], 44) ?>.</p>
  <center>
    <a href="#ActivateThreadModal" class="btn btn-small waves-effect waves-light green lighten-1 modal-trigger" style="margin-top: 5px;">
      <i class="material-icons left">check_circle</i> Activar anuncio
    </a>

    <a href="<?= gLink('mi-panel/editar', ['thread_id' => $thread['id']]) ?>" class="btn btn-small waves-effect waves-light blue lighten-1 modal-trigger" style="margin-top: 5px;">
      <i class="material-icons left">edit</i> Editar anuncio
    </a>

    <a id="renewThread" href="#renewThreadModal" class="btn btn-small waves-effect waves-light amber darken-1 modal-trigger" style="margin-top: 5px;">
      <i class="material-icons left">star</i> Destacar anuncio
    </a>

    <a href="<?= loadClass('forums/threads')->getThreadUrl($thread['id']) ?>" class="btn btn-small waves-effect waves-light grey lighten-1" style="margin-top: 5px;">
      <i class="material-icons left">visibility</i> Ver Anuncio
    </a>

    <a href="#suspendUserModal" class="btn btn-small waves-effect waves-light orange darken-2 modal-trigger" style="margin-top: 5px;">
      <i class="material-icons left">person_off</i> Suspender usuario
    </a>

    <a href="#deleteThreadModal" class="btn btn-small waves-effect waves-light red lighten-1 modal-trigger" style="margin-top: 5px;">
      <i class="material-icons left">delete</i> Eliminar Anuncio
    </a>
  </center>


  <br>
  <table class="striped responsive-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Contacto</th>
        <th>Region</th>
        <th>Visitas</th>
        <th>Estado</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $thread['id']; ?></td>
        <td><?php echo htmlspecialchars(cutText($thread['title'], 44)); ?></td>
        <td><?php echo htmlspecialchars($thread['member_name']); ?></td>
        <td><?php echo htmlspecialchars($thread['contact_name']); ?></td>
        <td><?php echo htmlspecialchars($thread['location_name']); ?></td>
        <td><?php echo $thread['views_count']; ?></td>
        <td><?php echo ($thread['status'] == 1 ? '<span class="green-text">Activo</span>' : '<span class="red-text">Inactivo</span>'); ?></td>
        <td><?php echo date('d/m/Y H:i', $thread['created_at']); ?></td>
      </tr>
    </tbody>
  </table>
</section>

<script>
  // Inicializar los modales de Materialize
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });

  function confirmActivate() {
    $.ajax({
      url: '<?= gLink('admin/threads.actions', ['activateThread' => true]) ?>',
      type: 'POST',
      data: {
        thread_id: <?= $thread['id'] ?>,
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
          $('#ActivateThreadModal').modal().close();
        } else {
          M.toast({
            html: data.msg,
            classes: 'red darken-1'
          });
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }

  function suspendUser(member_id, reason) {
    $.ajax({
      url: '<?= gLink('admin/threads.actions') ?>',
      type: 'POST',
      data: {
        suspend: member_id,
        reason: reason,
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
          $('#suspendUserModal').modal().close();
        } else {
          M.toast({
            html: data.msg,
            classes: 'red darken-1'
          });
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
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
      url: '<?= gLink('admin/threads.actions', ['deleteThread' => true]) ?>',
      type: 'POST',
      data: {
        thread_id: <?= $thread['id'] ?>,
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
          window.location.href = '<?= gLink('admin/threads.actions') ?>';
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

  function confirmRenew() {
    $.ajax({
      url: '<?= gLink('admin/threads.actions', ['renewThread' => true]) ?>',
      type: 'POST',
      data: {
        thread_id: <?= $thread['id'] ?>,
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
          $('#renewThreadModal').modal().close();

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
          html: 'Ocurrió un error al renovar el tema',
          classes: 'red darken-1'
        });
      }
    });
  }
</script>
<?php require Core::view('footer', 'core'); ?>