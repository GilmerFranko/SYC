<div id="contentTransactions">
  <br>
  <?php if ($transactions): ?>
    <h2 class="center-align">Movimientos</h2>
    <p class="center-align light grey-text text-darken-2">A continuación, se muestran todos los movimientos transaccionales de todos los usuarios del sistema.</p>
    <table class="striped responsive-table">
      <thead>
        <tr>
          <th>Usuario</th>
          <th>Monto</th>
          <th>Razón</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($transactions['transactions'] as $transaction): ?>
          <tr>
            <td><a href="<?php echo gLink('admin/wallet_add_remove_credits', ['member_id' => $transaction['member_id']]) ?>"><?php echo $transaction['name']; ?></td>
            <?php if ($transaction['transaction_type'] == '+')
            { ?>
              <td><span class="green-text">+<?php echo $transaction['amount']; ?></span></td>
            <?php }
            else
            { ?>
              <td><span class="red-text">-<?php echo $transaction['amount']; ?></span></td>
            <?php } ?>
            <td><?php echo $reasonAr[$transaction['reason']]; ?></td>
            <td><?php echo date('Y-m-d H:i:s', ($transaction['timestamp'])); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <!-- Paginador -->
    <?php echo $transactions['pages']['paginator']; ?>
    <!-- FIN Paginador -->
  <?php else: ?>
    <div class="center">
      <p>No hay transacciones disponibles.</p>
    </div>
  <?php endif; ?>
</div>