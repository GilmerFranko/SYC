<?php
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
<style>
  .menu-search {
    background-color: #F8F1F7;
    margin: 10px 0;
    font-size: 0.9rem;
    color: var(--primary-dark);
    text-align: left;
    padding: 6px 0 0 0;
    border-right: 4px solid #F0DCED;
    border-bottom: 2px solid #F0DCED;
    border-radius: 5px 0 5px 5px;

    .form-select,
    .form-control {
      border: var(--bs-border-width) solid var(--primary);
      color: var(--primary-dark);
      font-weight: bold;
      font-size: 0.8rem !important;
      /* Tamaño de fuente reducido */
      padding: 0rem 0.5rem !important;
      /* Espaciado reducido */
    }

    .form-select {
      height: 20px;
      /* Ajusta la altura del select */
      border-radius: 2px !important;
    }

    .form-control {
      height: 20px;
      /* Ajusta la altura del input */
      border-radius: 2px !important;
    }

    .row>* {
      padding: 0 2px !important;
    }
  }



  .search-form .btn {
    font-size: 0.875rem;
    /* Reduce el tamaño de fuente del botón */
    padding: 0rem 0.75rem;
    /* Reduce el padding del botón */
  }

  .search-form .input-group {
    width: 100%;
  }

  .search-form .form-row {
    margin-bottom: 0.5rem;
    /* Reduce el espacio entre filas */
  }

  .search-header {
    margin-bottom: 10px;
    width: 200px;
    font-size: 20px;
  }
</style>

<div class="menu-search mt-4">
  <!--<div class="search-header">
    Buscador
  </div>-->
  <span style="color: var(--bs-gray-800); font-weight:500;">BUSCAR ANUNCIO</span>
  <br><br>
  <div class="container">
    <form class="search-form" action="<?= gLink('forums/view.searches') ?>">
      <div class="row">
        <!-- Select de Categorías -->
        <div class="col col-sm-5 col-md-4 ">
          <select id="search-category" name="contact_id" class="form-select">
            <option selected value="">Categorías</option>
            <?php foreach ($contacts_search['data'] as $contact_search) : ?>
              <option value="<?= $contact_search['id'] ?>" <?php if ($contact_id == $contact_search['id']) echo 'selected' ?>><?= $contact_search['name'] ?></option>
            <?php endforeach; ?>

          </select>
        </div>
        <!-- Select de Ubicaciones -->
        <div class="col col-sm-3 col-md-3 ">
          <select id="search-location" name="location_id" class="form-select">
            <option selected value="">Ubicaciones</option>
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
        </div>
      </div>
      <div class="row" style="margin: -5px;">
        <!-- Input de Palabras -->
        <div class="col col-sm-8 col-md-8">
          <div class="input-group" style="display: flex; align-items: center;">
            <label for="searh-words" style="margin: 15px;">Que contenga las palabras</label>
            <input id="searh-words" type="text" class="form-control" name="words" value="<?= $words ?>">
          </div>
        </div>
      </div>
      <div class="row" style="align-items: center;">
        <!-- Select Edad Desde -->
        <div class="col col-sm-2 col-md-2">
          <select name="age_from" class="form-select">
            <option selected value="">Desde</option>
            <option value="18" <?php if ($age_from == 18) echo 'selected' ?>>18</option>
            <option value="25" <?php if ($age_from == 25) echo 'selected' ?>>25</option>

          </select>
        </div>
        <!-- Select Edad Hasta -->
        <div class="col col-sm-2 col-md-2">
          <select name="age_to" class="form-select">
            <option selected value="">Hasta</option>
            <option value="30" <?php if ($age_to == 30) echo 'selected' ?>>30</option>
            <option value="40" <?php if ($age_to == 40) echo 'selected' ?>>40</option>

          </select>
        </div>
        <!-- Select Ordenar por Fecha -->
        <div class="col col-sm-4 col-md-4">
          <select name="order_by" class="form-select">
            <option selected value="">Ordenar por fecha</option>
            <option value="asc" <?php if ($order_by == 'asc') echo 'selected' ?>>Ascendente</option>
            <option value="desc" <?php if ($order_by == 'desc') echo 'selected' ?>>Descendente</option>
          </select>
        </div>

        <!-- Botón Buscar -->
        <div class="col col-sm-2 col-md-4" style="display:flex;justify-content: flex-end;">
          <a href="javascript:void(0)" onclick="$(this).closest('form').submit()"><img src="<?= $config['images_url'] . '/button-search.png' ?>" class="" alt="Buscar" /></a>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  const contacts_s = <?= json_encode($contacts_search) ?>;
  const locations_s = <?= json_encode($locations_search) ?>;

  $(document).ready(function() {
    // Maneja el cambio en la categoría
    $('#search-category').on('change', function() {
      const selectedContact = $(this).val();
      const $locationSelect = $('#search-location');

      $locationSelect.empty();

      // Filtra y agrega las ubicaciones correspondientes a la categoría seleccionada
      locations_s.data.forEach(function(location) {
        if (location.contact_id == selectedContact) {
          $locationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
        }
      });
    });
  })
</script>