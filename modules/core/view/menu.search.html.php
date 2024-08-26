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
    <form class="search-form">
      <div class="row">
        <!-- Select de Categorías -->
        <div class="col col-sm-3 col-md-3 ">
          <select class="form-select">
            <option selected>Categorías</option>
            <option value="1">Categoría 1</option>
            <option value="2">Categoría 2</option>
            <!-- Más opciones aquí -->
          </select>
        </div>
        <!-- Select de Ubicaciones -->
        <div class="col col-sm-3 col-md-3 ">
          <select class="form-select">
            <option selected>Ubicaciones</option>
            <option value="1">Ubicación 1</option>
            <option value="2">Ubicación 2</option>
            <!-- Más opciones aquí -->
          </select>
        </div>
      </div>
      <div class="row" style="margin: -5px;">
        <!-- Input de Palabras -->
        <div class="col col-sm-8 col-md-8">
          <div class="input-group" style="display: flex; align-items: center;">
            <label for="searh-words" style="margin: 15px;">Que contenga las palabras</label>
            <input id="searh-words" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="row" style="align-items: center;">
        <!-- Select Edad Desde -->
        <div class="col col-sm-2 col-md-2">
          <select class="form-select">
            <option selected>Desde</option>
            <option value="18">18</option>
            <option value="25">25</option>
            <!-- Más opciones aquí -->
          </select>
        </div>
        <!-- Select Edad Hasta -->
        <div class="col col-sm-2 col-md-2">
          <select class="form-select">
            <option selected>Hasta</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <!-- Más opciones aquí -->
          </select>
        </div>
        <!-- Select Ordenar por Fecha -->
        <div class="col col-sm-4 col-md-4">
          <select class="form-select">
            <option selected>Ordenar por fecha</option>
            <option value="asc">Ascendente</option>
            <option value="desc">Descendente</option>
          </select>
        </div>

        <!-- Botón Buscar -->
        <div class="col col-sm-2 col-md-2 center-align">
          <a href="javascript:void(0)"><img src="<?= $config['images_url'] . '/button-search.png' ?>" class="" alt="Buscar" /></a>
        </div>
      </div>
    </form>
  </div>
</div>