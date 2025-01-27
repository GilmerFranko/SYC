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
            <form action="<?php echo gLink('admin/new.subforum', ['new_subforum' => true]); ?>" method="post">
              <div class="row">
                <div class="input-field col s12">
                  <input id="name" name="name" type="text" class="validate" required>
                  <label for="name">Nombre</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <label for="short_url">URL Corta (ejemplo: foro-hombres)</label>
                  <input name="short_url" id="short_url" type="text" class="validate" length="64" required>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="description" type="text" class="validate" name="description" value="">
                  <label for="description">Descripción</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <select name="forum_id">
                    <?php foreach (loadClass('admin/f_forums')->getAllForums()['data'] as $contact): ?>
                      <option value="<?php echo $contact['id']; ?>"><?php echo $contact['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <label>Foro</label>
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