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
?>

<form class="d-flex justify-content-center align-items-center search-bar menu-search">
  <!-- Select 1 -->
  <select class="form-select me-2" name="categoria">
    <option value="">Selecciona</option>
    <option value="categoria1">Opción 1</option>
    <option value="categoria2">Opción 2</option>
  </select>

  <!-- Select 2 -->
  <select class="form-select me-2" name="ubicacion">
    <option value="">En toda España</option>
    <option value="region1">Región 1</option>
    <option value="region2">Región 2</option>
  </select>

  <!-- Input de búsqueda -->
  <input type="text" name="query" class="form-control me-2" placeholder="¿Qué buscas?">

  <!-- Select para ordenar por fecha -->
  <select class="form-select me-2" name="ordenar">
    <option value="recientes">Orden por fecha</option>
    <option value="recientes">Más recientes</option>
    <option value="antiguos">Más antiguos</option>
  </select>

  <!-- Botón de búsqueda -->
  <button type="submit" class="btn btn-submenu"><i class="material-icons">search</i>Buscar</button>
</form>


<style>
  .menu-search {

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
      height: 28px;
      /* Ajusta la altura del select */
      border-radius: 2px !important;
    }

    .form-control {
      height: 28px;
      /* Ajusta la altura del input */
      border-radius: 2px !important;
    }

    .row>* {
      padding: 0 2px !important;
    }
  }

  .search-bar {
    background-color: #c298bc;
    padding: 10px;
    display: flex;
    justify-content: center;
    margin-bottom: 18px;
    box-shadow: 0 0 5px #000;
  }

  .search-bar form {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    max-width: 1000px;
  }

  .form-select,
  .form-control {
    font-size: 16px;
    padding: 5px;
    height: 40px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .btn-submenu {
    color: white;
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
  }

  .btn-primary:hover {
    background-color: #8e44ad;
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