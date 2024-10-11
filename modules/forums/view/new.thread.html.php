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
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>-->

<section>
  <div class="container mt-5">
    <h2 class="mb-4">Crear Nuevo Hilo</h2>
    <form id="new_thread_form" action="<?= gLink('forums/new.thread', ['new_thread' => '1']) ?>" method="POST" enctype="multipart/form-data">

      <!-- Título (columna completa) -->
      <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" class="form-control" id="title" name="title" value="Título de prueba" required>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="example@example.com" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <small class="form-text text-muted">No introduzca el prefijo +34</small>
            <input type="tel" class="form-control" id="phone" name="phone" value="666 666 666" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="contact_id" class="form-label">Categorías</label>
            <select class="form-select" id="contact_id" name="contact_id" required>
              <option selected disabled>Selecciona una categoría</option>
              <?php foreach ($contacts['data'] as $contact) : ?>
                <option value="<?= $contact['id'] ?>"><?= $contact['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="location_id" class="form-label">Provincias y Ciudades</label>
            <select class="form-select" id="location_id" name="location_id" required>
              <option selected disabled>Selecciona una provincia/ciudad</option>
              <option disabled>Primero debes seleccionar una categoria</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="mb-3">
            <label for="age" class="form-label">Edad</label>
            <input type="number" class="form-control" id="age" name="age" value="25" required>
          </div>
        </div>
        <div class="col-md-4">
          <div class="mb-3">
            <label for="fee" class="form-label">Tarifa €</label>
            <input type="number" class="form-control" id="fee" name="fee" value="10" required>
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
        <textarea class="form-control" id="content" name="content" rows="5" maxlength="10000" required>[b]Texto en negrita[/b], [i]Texto en cursiva[/i], [url]http://example.com[/url]</textarea>
      </div>

      <div class="mb-3">
        <label for="images" class="form-label">Imágenes</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/jpg, image/jpeg, image/png">
        <div id="image-preview" class="mt-3 d-flex flex-wrap"></div>
        <small class="form-text text-muted">
          Puedes subir un máximo de 9 imágenes, siendo el tamaño ideal 800 píxeles de ancho por 800 píxeles de alto.<br>
          Los anuncios no se publicarán si presentan las siguientes situaciones:<br>
          - No incluyen imágenes. Cualquier anuncio sin fotos será eliminado de inmediato.<br>
          - Contienen imágenes explícitas de genitales.<br>
          - Alguna de las imágenes está rota o invertida.<br>
          - Las fotos no son coherentes con el contenido del anuncio.<br>
          - Si deseas publicar un anuncio con fotos de rostro visible, es necesario enviar una selfie haciendo ✌️ con dos dedos. Esta foto no será publicada, pero servirá para que los usuarios sepan que el anuncio está verificado.<br>
          - Las imágenes que aparezcan en gris están bloqueadas y no se mostrarán.
        </small>
      </div>

      <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="tu_site_key"></div>
      </div>
      <button type="submit" class="btn btn-primary">Crear Hilo</button>
    </form>
  </div>
</section>

<script>
  const preview = document.getElementById('image-preview');
  let archivosSeleccionados = []; // Array para almacenar los archivos seleccionados

  const contacts = <?= json_encode($contacts) ?>;
  const locations = <?= json_encode($locations) ?>;

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

  // Agrega una imagen al preview y crea un botón para eliminar
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
    $('#contact_id').on('change', function() {
      const selectedContact = $(this).val();
      const $locationSelect = $('#location_id');

      // Limpia las opciones previas
      $locationSelect.empty();
      $locationSelect.append('<option selected disabled>Selecciona una provincia/ciudad</option>');

      // Filtra y agrega las ubicaciones correspondientes a la categoría seleccionada
      locations.data.forEach(function(location) {
        if (location.contact_id == selectedContact) {
          $locationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
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
      const location_id = $form.find('select[name="location_id"]').val()
      const contact_id = $form.find('select[name="contact_id"]').val()
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

      if (!location_id || isNaN(location_id)) {
        errors.push('Debes seleccionar una ubicación');
      }

      if (!contact_id || isNaN(contact_id)) {
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