<div>
	<table class="striped custom-rounded-table">
		<?php if ($transactions['pages']['results'] > 0): ?>
			<thead>
				<tr>
					<th>Monto</th>
					<th>Razón</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($transactions['transactions'] as $transaction): ?>
					<tr>
						<?php if($transaction['transaction_type'] == '+'){ ?>
							<td><span class="">+<?php echo $transaction['amount']; ?></span></td>
						<?php }else{ ?>
							<td><span class="red-text">-<?php echo $transaction['amount']; ?></span></td>
						<?php } ?>
						<td><?php echo $reasonAr[$transaction['reason']]; ?></td>
						<td><?php echo date('Y-m-d H:i:s', ($transaction['timestamp'])); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		<?php else: ?>
			<div class="center">
				<p>No hay transacciones disponibles.</p>
			</div>
		<?php endif; ?>
	</table>
	<!-- Paginador -->
	
	<!-- FIN Paginador -->
	
</div>
