<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de nueva locacion (foro)
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
            <form action="<?php echo gLink('admin/new.location', ['new_location' => true]); ?>" method="post">
              <div class="row">
                <div class="input-field col s12">
                  <input id="name" name="name" type="text" class="validate" required>
                  <label for="name">Nombre</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="description" name="description" class="materialize-textarea"></textarea>
                  <label for="description">Descripción</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <select name="contact_id">
                    <?php foreach (loadClass('admin/f_contacts')->getAllContacts()['data'] as $contact): ?>
                      <option value="<?php echo $contact['id']; ?>"><?php echo $contact['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <label>Contacto</label>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <button type="submit" class="btn waves-effect waves-light">Agregar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>