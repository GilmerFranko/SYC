<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de editar locacion (foro)
 *
 *
 */

require Core::view('head', 'core');
?>
<section>
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
  <div class="container">
    <div class="row">
      <div class="col s12">
        <div class="card">
          <div class="card-content">
            <form action="<?php echo gLink('admin/edit.subforum', ['edit_subforum' => $subforum['id']]); ?>" method="post">
              <input type="hidden" name="subforum_id" value=" <?= $subforum['id']; ?>" />
              <div class="row">
                <div class="input-field col s12">
                  <input id="name" name="name" type="text" class="validate" value="<?php echo $subforum['name']; ?>" required>
                  <label for="name">Nombre</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <label for="short_url">URL Corta (ejemplo: tecnologia-antigua)</label>
                  <textarea name="short_url" id="short_url" class="materialize-textarea" length="1000" required><?php echo Core::model('extra', 'core')->getInputValue('short_url', 'post'); ?><?= $subforum['short_url']; ?></textarea>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="description" type="text" class="validate" name="description" value="<?php echo $subforum['description']; ?>">
                  <label for="description">Descripción</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input type="hidden" name="forum_id" value="<?= $subforum['forum_id']; ?>">
                  <select name=" forum_id1111" disabled>
                    <?php foreach (loadClass('admin/f_forums')->getAllForums()['data'] as $contact): ?>
                      <option value="<?php echo $contact['id']; ?>" <?php echo ($subforum['forum_id'] == $contact['id']) ? 'selected' : ''; ?>><?php echo $contact['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <label>Forumo <span class="text-red">(Desactivado por seguridad)</span></label>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <button id="btn_submit" type="submit" class="btn waves-effect waves-light">Editar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  $('#btn_submit').click(function() {
    Swal.fire({
      title: '¿Estás seguro de realizar este cambio?',
      html: '',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, estoy seguro',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $('form').submit()
      }
    })
    return false;
  })
</script>