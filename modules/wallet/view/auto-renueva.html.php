<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco
 *=======================================================
 *
 * @Description Vista de la página de servicio Auto·Renueva
 */

require Core::view('head', 'core');
?>

<style>
  .logo {
    display: flex;
    justify-content: center;
    padding-bottom: 20px;
  }



  .info-card {
    margin-bottom: 20px;
    padding: 20px;
    box-shadow: none;
  }

  .info-card h3 {
    font-size: 1.25rem;
    font-weight: 500;
    margin-bottom: 15px;
  }

  .info-card p {
    font-size: 0.9rem;
    color: #555;
  }

  .highlight-section {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
  }

  .highlight-section h4 {
    font-size: 1.1rem;
    font-weight: 500;
    color: #0d6efd;
  }

  .highlight-section ul {
    font-size: 0.9rem;
    color: #6c757d;
  }

  .cta-buttons {
    margin-top: 25px;
    text-align: center;
  }

  .cta-buttons a {
    margin-right: 10px;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
  }

  .cta-buttons a:last-child {
    margin-right: 0;
  }

  @media (max-width: 768px) {
    .info-card {
      padding: 15px;
    }

    .info-card h3 {
      font-size: 1.1rem;
    }

    .info-card p {
      font-size: 0.85rem;
    }

    .highlight-section h4 {
      font-size: 1rem;
    }

    .highlight-section ul {
      font-size: 0.85rem;
    }

    .cta-buttons a {
      padding: 7px 18px;
      font-size: 0.85rem;
    }
  }
</style>

<section>
  <!-- Header -->
  <?php require Core::view('menu', 'core'); ?>
  <!-- / Header -->
  <div class="container">
    <div class="row">

      <div class="col col-sm-12 col-md-9 col-lg-10">
        <!-- Descripción del servicio -->
        <div class="info-card card">
          <div class="d-flex align-items-center mb-2">
            <i class="fas fa-sync icono"></i>
            <h3>¿Qué es Auto·Renueva?</h3>
          </div>
          <p>El servicio auto·renueva sube automáticamente tu anuncio a las primeras posiciones cada 1, 2, 3, 6, 24 o 48 horas. Esto aumenta la visibilidad de tu anuncio y facilita contactos.</p>
          <p>Con este servicio no necesitas renovar manualmente, lo que mejora la exposición de tu anuncio.</p>
          <p>El objetivo de Auto·Renueva es destacar los anuncios automáticamente, mejorando su visibilidad. Si el anuncio incumple las normas, será eliminado. Publicar y renovar manualmente sigue siendo GRATIS.</p>
        </div>

        <!-- Cómo funciona -->
        <div class="info-card card">
          <div class="d-flex align-items-center mb-2">
            <i class="fas fa-cogs icono"></i>
            <h3>Cómo Funciona</h3>
          </div>
          <p>Sigue estos pasos:</p>
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent"> <i class="em em-one" aria-role="presentation" aria-label="KEYCAP 1"></i> Accede a tu cuenta y compra créditos <a href="#">AQUÍ</a>.</li>
            <li class="list-group-item bg-transparent"> <i class="em em-two" aria-role="presentation" aria-label="KEYCAP 2"></i> Haz clic en "Renovar" en el listado de anuncios.</li>
            <li class="list-group-item bg-transparent"> <i class="em em-three" aria-role="presentation" aria-label="KEYCAP 3"></i> Selecciona la frecuencia de auto·renovación.</li>
          </ul>

          <!-- Botones -->
          <div class="cta-buttons">
            <a href="#" class="btn btn-primary"><i class="fas fa-coins me-2"></i>Comprar Créditos</a>
            <a href="#" class="btn btn-dark"><i class="fas fa-sign-in-alt me-2"></i>Acceder a tu Cuenta</a>
          </div>
        </div>

        <!-- Costo del servicio -->
        <div class="info-card card">
          <h3>Costo del Servicio</h3>
          <p>Cada vez que tu anuncio se auto·renueva se consume <strong>0,20€ IVA incluido</strong>.</p>
        </div>

        <!-- Notas importantes -->
        <div class="highlight-section card">
          <h4><i class="fas fa-info-circle me-2"></i>Notas Importantes</h4>
          <ul class="list-unstyled">
            <!--<li><i class="fas fa-clock me-2"></i>No se auto·renueva entre las 00:00 y las 09:00 para evitar consumo de créditos en horas de menor tráfico.</li>-->
            <li><i class="fas fa-thumbs-up me-2"></i>Auto·Renueva mejora la visibilidad pero no garantiza el éxito.</li>
            <li><i class="fas fa-ban me-2"></i>El servicio se detiene si el anuncio es eliminado o manualmente desactivado.</li>
          </ul>
        </div>

        <!-- Código QR -->
      </div>
      <div class="menu-sidebar1 col d-none d-sm-none d-md-flex col-md-3 col-lg-2">
        <!-- SIDEBAR Solo para escritorio -->
        <?php require Core::view('sidebar', 'forums'); ?>
      </div>
    </div>
</section>
<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->