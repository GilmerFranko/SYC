<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de nuevo hilo
 *
 *
 */

require Core::view('head', 'core');

foreach ($subforums['data'] as $subforum)
{
  if ($subforum['id'] == $thread['subforum_id'])
  {
    $subforumSelected['id'] = $subforum['id'];
    $subforumSelected['name'] = $subforum['name'];
    $subforumSelected['forum_id'] = $subforum['forum_id'];
  }
}
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->


<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>-->

<section>
  <div class="container mt-5">
    <h2 class="mb-4">Modificar Hilo</h2>
    <form id="edit_thread_form" action="<?= gLink('forums/edit.thread', ['edit_thread' => true, 'thread_id' => $thread['id']]) ?>" method="POST" enctype="multipart/form-data">

      <!-- Título (columna completa) -->
      <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($thread['title']) ?>" required>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $thread['email'] ?>" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <small class="form-text text-muted">No introduzca el prefijo +34</small>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?= $thread['phone'] ?>" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="forum_id" class="form-label">Categorías</label>
            <small>No puedes modificar la cargoria</small>
            <select class="form-select" id="forum_id" name="forum_id" disabled>
              <?php foreach ($forums['data'] as $contact) : ?>
                <?php if ($contact['id'] == $subforumSelected['forum_id']): ?>
                  <option value="<?= $contact['id'] ?>"><?= $contact['name'] ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="subforum_id" class="form-label">Provincias y Ciudades</label>
            <small>No puedes modificar la ubicación</small>
            <select class="form-select" id="subforum_id" name="subforum_id" disabled>
              <option value="<?= $subforumSelected['id'] ?>" selected><?= $subforumSelected['name'] ?></option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="mb-3">
            <label for="age" class="form-label">Edad</label>
            <input type="number" class="form-control" id="age" name="age" value="<?= $thread['age'] ?>" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="mb-3">
            <label for="fee" class="form-label">Tarifa €</label>
            <input type="number" class="form-control" id="fee" name="fee" value="<?= $thread['fee'] ?>" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <input type="text" class="form-control" id="disponibilidad" name="disponibilidad" value="Disponible" disabled>
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label for="content" class="form-label">Contenido</label>
        <textarea class="form-control" id="content" name="content" rows="5" maxlength="10000" required><?= br2nl($thread['content']) ?></textarea>
      </div>

      <!-- Si el hilo ya tiene imágenes, debería mostrarlas aquí para permitir su eliminación o modificación -->
      <div class="mb-3">
        <!-- Imágenes  Eliminadas-->
        <input type="hidden" id="deleted_images" name="deleted_images" value="">
        <!-- Fin -->
        <label for="images" class="form-label">Imágenes</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
        <div id="image-preview" class="mt-3 d-flex flex-wrap">
          <?php foreach ($images['data'] as $image): ?>
            <div class="position-relative m-2">
              <?php if ($image['image_url'] == null): ?>
                <img src="<?= $config['default_thread_photo'] ?>" class="img-thumbnail" style="width: 100px; height: 100px;">
              <?php else: ?>
                <img src="<?= $config['threads_url'] . '/' . $image['image_url'] ?>" class="img-thumbnail" style="width: 100px; height: 100px;">
              <?php endif; ?>
              <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-image" data-remove-image="<?= $image['id'] ?>">&times;</button>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="tu_site_key"></div>
      </div>
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
  </div>
</section>

<script>
  const preview = document.getElementById('image-preview');
  let archivosSeleccionados = []; // Array para almacenar los archivos seleccionados
  let deletedImages = []; // Array para almacenar los IDs de imágenes eliminadas

  const forums = <?= json_encode($forums) ?>;
  const subforums = <?= json_encode($subforums) ?>;

  // Manejar la eliminación de imágenes existentes
  preview.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-existing-image')) {
      const imageId = event.target.getAttribute('data-remove-image');
      // Añade el ID de la imagen al array de eliminadas
      deletedImages.push(imageId);
      // Actualiza el campo oculto con los IDs eliminados
      document.getElementById('deleted_images').value = deletedImages.join(',');

      // Elimina la imagen del DOM
      const imgWrapper = event.target.parentElement;
      imgWrapper.remove();
    }
  });

  // Manejar la adición de nuevas imágenes
  document.getElementById('images').addEventListener('change', function(event) {
    Array.from(event.target.files).forEach((file) => {
      archivosSeleccionados.push(file); // Agrega el archivo al array

      const reader = new FileReader();
      reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('img-thumbnail');
        img.style.width = '100px';
        img.style.height = '100px';

        newPreview(img, file);
      };
      reader.readAsDataURL(file);
    });
  });

  // Función para previsualizar nuevas imágenes y permitir su eliminación
  function newPreview(img, file) {
    const imgWrapper = document.createElement('div');
    imgWrapper.classList.add('position-relative', 'm-2');

    const removeBtn = document.createElement('button');
    removeBtn.innerHTML = '&times;';
    removeBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute', 'top-0', 'end-0');
    removeBtn.style.zIndex = '10';

    removeBtn.addEventListener('click', function() {
      imgWrapper.remove(); // Elimina la imagen del preview
      archivosSeleccionados = archivosSeleccionados.filter((f) => f !== file); // Elimina el archivo del array
    });

    imgWrapper.appendChild(img);
    imgWrapper.appendChild(removeBtn);
    preview.appendChild(imgWrapper);
  }

  // Enviar el formulario de la manera habitual
  document.querySelector('form').addEventListener('submit', function(event) {
    // Sincroniza los archivos seleccionados con el input file antes de enviar
    const inputFile = document.getElementById('images');

    const dataTransfer = new DataTransfer();
    archivosSeleccionados.forEach((file) => {
      dataTransfer.items.add(file);
    });

    inputFile.files = dataTransfer.files;
  });

  $(document).ready(function() {
    // Inicializa SCEditor en el textarea
    /*const $textarea = $('#content');
    sceditor.create($textarea[0], {
      format: 'bbcode',
      style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
      locale: 'es', // Ajusta el idioma si es necesario
      toolbar: 'bold,italic,underline|bulletlist,orderedlist|link,unlink|source',
      width: '100%',
      height: '200px',
    });*/


    // Maneja el cambio en la categoría
    $('#forum_id').on('change', function() {
      const selectedForum = $(this).val();
      const $subforumSelect = $('#subforum_id');

      // Limpia las opciones previas
      $subforumSelect.empty();
      $subforumSelect.append('<option selected disabled>Selecciona una provincia/ciudad</option>');

      // Filtra y agrega las subforos correspondientes a la categoría seleccionada
      subforums.data.forEach(function(subforum) {
        if (subforum.forum_id == selectedForum) {
          $subforumSelect.append('<option value="' + subforum.id + '">' + subforum.name + '</option>');
        }
      });
    });


    // Manejo del evento de envío del formulario
    $('#new_thread_form').on('submit', function(event) {
      event.preventDefault(); // Previene el envío del formulario hasta que se validen los datos

      const $form = $(this);
      const title = $form.find('input[name="title"]').val()
      const email = $form.find('input[name="email"]').val()
      const phone = $form.find('input[name="phone"]').val()
      const subforum_id = $form.find('select[name="subforum_id"]').val()
      const forum_id = $form.find('select[name="forum_id"]').val()
      const age = $form.find('input[name="age"]').val()
      const fee = $form.find('input[name="fee"]').val()
      const content = $('#content').val()

      const errors = [];

      if (!title) {
        errors.push('Debes introducir un título');
      }

      if (!email) {
        errors.push('Debes introducir un correo electrónico');
      }

      const phoneNum = phone.replace(/\s+/g, '');
      if (!phoneNum || isNaN(phoneNum) || phoneNum.length < 9) {
        errors.push('El teléfono debe tener al menos 9 dígitos y ser un número');
      }

      if (!subforum_id || isNaN(subforum_id)) {
        errors.push('Debes seleccionar una ubicación');
      }

      if (!forum_id || isNaN(forum_id)) {
        errors.push('Debes seleccionar una categoría');
      }

      if (!age || isNaN(age) || age < 18) {
        errors.push('Debes introducir una edad mayor a 18');
      }

      if (!fee || isNaN(fee)) {
        errors.push('Debes introducir una tarifa numérica');
      }

      if (!content || content.length > 10000) {
        errors.push('El contenido no debe tener más de 10000 caracteres');
      }

      if (errors.length) {
        errors.forEach(error => {
          Toastify({
            text: error,
            duration: 3000,
            gravity: 'top',
            backgroundColor: 'linear-gradient(to right, #ff6c6c, #ff6c6c)',
            stopOnFocus: true, // Optional
          }).showToast();
        });
        return;
      }

      // Si todas las validaciones pasan, se puede enviar el formulario
      $form.off('submit').submit(); // Remueve el manejador del evento y envía el formulario
    });
  });
</script>