<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que incluye el sub menu de busqueda
 *
 *
 */

// Carga todos los contactos
$contacts_search = loadClass('forums/f_contacts')->getAllContacts();

// Carga todos los foros
$locations_search = loadClass('forums/locations')->getAllLocations();

$contact_id = isset($_GET['contact_id']) ? $_GET['contact_id'] : '';

$location_id = isset($_GET['location_id']) ? $_GET['location_id'] : '';

$age_from = isset($_GET['age_from']) ? $_GET['age_from'] : '';

$age_to = isset($_GET['age_to']) ? $_GET['age_to'] : '';

$words = isset($_GET['words']) ? $_GET['words'] : '';

$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : '';
?>

<form class="d-flex justify-content-center align-items-center search-bar menu-search" action="<?= gLink('forums/view.searches') ?>">
  <!-- Select 1 -->
  <select id="search-category" class="form-select me-2" name="contact_id">
    <option selected value="">Selecciona</option>
    <?php foreach ($contacts_search['data'] as $contact_search) : ?>
      <option value="<?= $contact_search['id'] ?>" <?php if ($contact_id == $contact_search['id']) echo 'selected' ?>><?= $contact_search['name'] ?></option>
    <?php endforeach; ?>
  </select>

  <!-- Select 2 -->
  <select id="search-location" class="form-select me-2" name="location_id">
    <option value="">En toda España</option>
    <?php foreach ($locations_search['data'] as $location_search)
    {
      // Si se ha seleccionado un contacto 
      if ($contact_id and $contact_id == $location_search['contact_id'])
      {
        // Muestra las ubicaciones de ese contacto y si la ubicación coincide con la ubicación seleccionada se marca como seleccionada
        echo '<option value="' . $location_search['id'] . '" ' . ($location_id == $location_search['id'] ? 'selected' : '') . '>' . $location_search['name'] . '</option>';
      }
    } ?>

  </select>

  <!-- Input de búsqueda -->
  <input type="text" name="words" class="form-control me-2" placeholder="¿Qué buscas?" value="<?= $words ?>">

  <!-- Select para ordenar por fecha -->
  <select class="form-select me-2" name="order_by">
    <option value="">Orden por fecha</option>
    <option value="asc" <?php if ($order_by == 'asc') echo 'selected' ?>>Más recientes</option>
    <option value="desc" <?php if ($order_by == 'desc') echo 'selected' ?>>Más antiguos</option>
  </select>

  <!-- Botón de búsqueda -->
  <button type="submit" class="btn btn-submenu"><i class="material-icons">search</i>Buscar</button>
</form>


<style>
  .search-bar {
    background-color: unset;
    padding: 10px;
    display: flex;
    justify-content: center;
    margin-bottom: 18px;
  }

  .search-bar form {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    max-width: 1000px;
  }

  .btn-submenu {
    background-color: var(--primary-200);
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    transition: background-color 0.3s ease;
  }

  .btn-submenu:hover {
    background-color: var(--primary-300);
  }

  @media (max-width: 768px) {
    .search-bar form {
      flex-wrap: wrap;
    }

    .form-select,
    .form-control,
    .btn-primary {
      width: 100%;
    }

    .form-select {
      display: none !important;
    }
  }
</style>

<script>
  const contacts_s = <?= json_encode($contacts_search) ?>;
  const locations_s = <?= json_encode($locations_search) ?>;

  $(document).ready(function() {
    // Maneja el cambio en la categoría
    $('#search-category').on('change', function() {
      const selectedContact = $(this).val();
      const $locationSelect = $('#search-location');

      // Limpia el select de ubicaciones
      $locationSelect.empty();

      // Filtra y agrega las ubicaciones correspondientes a la categoría seleccionada
      $locationSelect.append('<option value="">En toda España</option>');
      // Filtra y agrega las ubicaciones correspondientes a la categoría seleccionada
      locations_s.data.forEach(function(location) {
        if (location.contact_id == selectedContact) {
          $locationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
        }
      });
    });
  })
</script>