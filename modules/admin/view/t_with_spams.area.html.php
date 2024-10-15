<div id="contentT_with_spams">
  <table class="striped responsive-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Contacto</th>
        <th>Region</th>
        <th>Visitas</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($threads['rows'] > 0)
      {
        foreach ($threads['data'] as $thread): ?>
          <tr>
            <td><?= $thread['id']; ?></td>
            <td><?= loadClass('core/extra')->getHighlight($search, $thread['title']) ?></td>
            <td><?= $thread['member_name']; ?></td>
            <td><?= $thread['contact_name']; ?></td>
            <td><?= $thread['location_name']; ?></td>
            <td><?= $thread['views_count']; ?></td>
            <td><?= ($thread['status'] == 1 ? '<span class="green-text">Activo</span>' : '<span class="red-text">Inactivo</span>'); ?></td>
            <td><?= date('d/m/Y H:i', $thread['created_at']); ?></td>
            <td>
              <!-- boton de ver -->
              <a class="btn-floating btn-small waves-effect waves-light teal" href="<?= gLink('admin/threads.actions', ['byThreadId' => $thread['id']]); ?>"><i class="material-icons">visibility</i></a>

            </td>
          </tr>
        <?php endforeach;
      }
      else
      { ?>
        <tr>
          <td colspan="9">No se han encontrado resultados</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <!--paginador-->
  <?php echo $threads['pages']['paginator']; ?>
  <!--fin_paginador-->
</div>