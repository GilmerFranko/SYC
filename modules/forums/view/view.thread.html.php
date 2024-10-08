<?php defined('SYC') || exit;

/**
 *=======================================================* SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de ver un hilo (anuncio)
 *
 */

require Core::view('head', 'core');

// Optiene imagenes del hilo 
$images = loadClass('forums/threads')->getImagesByThreadId($thread['id']);

// Registra a la visita del hilo (solo si no se ha visitado el mismo dia) (Primero se está cargando el hilo y luego se registra la visitta por lo que esta no estará reflejada en el momento)
if ($session->is_member)
  loadClass('forums/threads')->registerVisit($thread['id'], $m_id, $session->memberData['ip_address']);

// Optiene las visitas detalladas del hilo
$visits = loadClass('forums/threads')->getThreadVisitsLast10Days($thread['id']);

// Verifica si el hilo tiene activado el auto-renueva
$isAutoRenewEnabled = loadClass('forums/autorenueva')->isAutoRenewEnabled($thread['id']);

// Optiene la cantidad de veces que se ha renovado el hilo
$count_autorenew = $thread['count_renewals'];
?>

<style>
  .pagAnuStatsAnuBox {
    padding-bottom: 10px;
    padding: 8px;
    border: 2px solid #E6F1E6;
    border-radius: 5px;
    background-color: #f8fff8;
    width: 176px;
  }

  .pagAnuStatsAnu {
    margin: 5px;
    font-size: 11px;
  }

  .pagAnuStatsAnu .stats {
    color: #538053;
    text-shadow: 2px 2px 2px #99dd99;
    margin-right: 10px;
  }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<section>
  <!-- Header -->
  <?php require Core::view('menu', 'core'); ?>
  <!-- / Header -->
  <div class="container">
    <div class="row">
      <div class="col col-sm-12 col-md-9 col-lg-9">

        <div class="preAviso mt-4">

        </div>
        <div class="preAviso0" style="display: <?= (isset($_COOKIE['hasAcceptedAdultContent']) ? 'block' : 'none') ?>;">
          <div class="card thread-card">

            <div class="card-header" style="background: #e2f0e0; font-size: 14px">
              <div style="width: auto;"> Ref: <?php echo obtenerExtension($thread['slug']); ?></div>
              <div><?php echo $contact['name']; ?></div>
              <div class=" subheader">
                <div class="subheader"><?php echo date('d-m-Y', $thread['created_at']); ?></div>
              </div>
            </div>

            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col col-12">
                    <strong class="thread-title">
                      <?= strtoupper($thread['title']); ?>
                    </strong>
                    <br>
                    <p class="thread-content">
                      <?php
                      $parser->parse($thread['content']);
                      echo tobr($parser->getAsHTML());
                      ?>
                    </p>
                  </div>
                  <div class="" style="display: flex; padding: 0px 13px 15px; flex-wrap: wrap; flex-direction: row;">
                    <?php if ($images['rows'] > 0) : ?>
                      <?php foreach ($images['data'] as $image) : ?>
                        <div class="">

                          <?php if ($image['image_url'] == null): ?>
                            <img src="<?= $config['default_thread_photo'] ?>" class="rounded" data-bs-toggle=" modal" data-bs-target="#imageModal" style="cursor: pointer;" width="100" height="100">
                          <?php else: ?>
                            <img src="<?= $config['threads_url'] ?>/<?= $image['image_url'] ?>" class="rounded-1" data-bs-toggle="modal" data-bs-target="#imageModal" style="cursor: pointer;" width="100">
                          <?php endif; ?>

                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>

                </div>
              </div>
            </div>
            <div class="card-footer">
              <!-- Botones del footer -->
              <?php require Core::view('thread.footer', 'forums'); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- Estadísticas de visitas -->
      <div id="item-stats" class="col col-md-3 col-lg-3" style="">
        <div class="pagAnuStatsAnuBox" bis_skin_checked="1">
          <div class="pagAnuStatsAnu" bis_skin_checked="1">
            <div class="stats" bis_skin_checked="1">
              Estadísticas
            </div>
            <div class="dato" bis_skin_checked="1"><strong><?= $thread['views_count'] ?></strong>
              veces listado
              <a href="javascript:alert('Veces listado es el número de veces que se ha mostrado el anuncio a los usuarios, bien sea en el listado de resultados como en la página propia del anuncio. Solo se cuenta una vez por usuario y este debe estar logueado');"><b>?</b></a>
            </div>
            <div class="dato" bis_skin_checked="1"><strong><?= $thread['count_favorites'] ?></strong> añadido a favoritos
              <a href="javascript:alert('Añadido a favoritos es el número de usuarios que han añadido este anuncio a su lista de \'Mi selección de anuncios\'.');"><b>?</b></a>
            </div>
            <div class="dato" bis_skin_checked="1"><strong><?= $count_autorenew ?></strong> <a href="/web/20171209172108/http://www.pasion.com/creditos/auto-renueva.php">auto·renovados</a></div>
          </div>

          <div class="pagAnuGraph" bis_skin_checked="1">
            <div id="chart_div"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="center-align">
      <div style="width: 800px">
        <!-- Menu de busqueda -->
        <?php require Core::view('menu.search', 'core'); ?>
      </div>
    </div>
</section>

<script type="text/javascript">
  google.charts.load('current', {
    packages: ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Fecha', 'Veces listado'],
      ['1-Dic', 56],
      <?php foreach ($visits as $visit)
      {
        echo "[\"$visit[0]\"," . $visit[1] . "],";
      } ?>
    ]);

    var options = {
      title: 'Veces listado por día',
      hAxis: {
        title: 'Ultimos 10',
        titleTextStyle: {
          color: '#333'
        },
        textPosition: 'none'
      },
      vAxis: {
        minValue: 0,
        gridlines: {
          count: 5 // Controla cuántas líneas de grilla quieres
        }

      },
      height: 170,
      width: 150,
      backgroundColor: '#f8fff8',
      colors: ['068306'],
      legend: ('none'),
      chartArea: {
        left: '40',
        width: '150',
        top: '15'
      },

    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);

  }
</script>



<!-- Modal denunciar -->
<?php require Core::view('report.modal', 'forums'); ?>

<!-- Modal Renovar -->
<?php require Core::view('renovar.modal', 'forums'); ?>

<!-- Aviso -->
<?php require Core::view('preaviso.modal', 'forums'); ?>

<!-- Estadisticas -->
<?php require Core::view('stats.modal', 'forums'); ?>

<!-- FOOTER -->
<?php require Core::view('footer', 'core'); ?>