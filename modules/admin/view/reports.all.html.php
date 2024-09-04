<?php defined('SYC') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de todos los reportes
 *
 */
?>

<!-- Body -->
<section>
  <h1 class="center-align">Todos los reportes</h1>
  <p class="center-align light grey-text text-darken-2">A continuación, todos los reportes se muestran agrupados por anuncio. Puedes presionar en <i class="material-icons">remove_red_eye</i> para los reportes de cada anuncio.</p>
  <div class="row">
    <div class="col s12 m10 offset-m1">
      <table class="striped responsive-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Denunciado</th>
            <th>Anuncio</th>
            <th>Fecha</th>
            <th>N° de denuncias</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reports['data'] as $report): ?>
            <tr>
              <td><?php echo $report['id']; ?></td>
              </td>
              <td><a href=""><?php echo $report['member_name']; ?></a></td>
              <td><a href="<?= loadClass('forums/threads')->getThreadUrl($report['thread_id']); ?>" title="<?= $report['thread_title']; ?>"><?php echo cutText($report['thread_title'], 32); ?></a></td>
              <td><?php echo date('Y-m-d H:i:s', $report['reported_at']); ?></td>
              <td><?php echo $report['reports_count']; ?></td>
              <td>
                <a href="<?= gLink('admin/reports', ['byThreadId' => $report['thread_id']]) ?>"><i class="material-icons">remove_red_eye</i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
  // Agrega paginador
  echo $reports['pages']['paginator'];
  ?>
</section>