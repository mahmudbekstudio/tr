<table class="table" style="background: white; font-size: 17px;">
	<tr>
		<th style="width: 20%;">Date</th>
		<th style="width: 20%;">Cash</th>
		<th style="width: 20%;">Card</th>
		<th style="width: 20%;">VIP</th>
		<th style="width: 20%;">Total</th>
	</tr>
	<?php foreach($list as $d => $item) : ?>
		<tr>
			<td style="text-align: left"><?php echo $d ?></td>
			<td style="text-align: left"><?php echo number_format($item['total']['cash'], 0, ',', ' ') ?></td>
			<td style="text-align: left"><?php echo number_format($item['total']['card'], 0, ',', ' ') ?></td>
			<td style="text-align: left"><?php echo number_format($item['total']['vip'], 0, ',', ' ') ?>
			<?php
				if(!empty($item['vipList'])) {
					foreach($item['vipList'] as $u) {
						echo '<br />' . $u['name'] . ': ' . number_format($u['total'], 0, ',', ' ');
					}
				}
			?>
			</td>
			<td style="text-align: left"><?php echo number_format($item['total']['cash'] + $item['total']['card'], 0, ',', ' ') . ' + VIP:' . number_format($item['total']['vip'], 0, ',', ' ') . ' = ' . number_format($item['total']['cash'] + $item['total']['card'] + $item['total']['vip'], 0, ',', ' ') ?></td>
		</tr>
	<?php endforeach; ?>
</table>