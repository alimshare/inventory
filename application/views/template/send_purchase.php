<div>
	<p>Purchase Request</p>
	<table>
		<tr>
			<td>Requestor</td>
			<td>:</td>
			<td><?php echo @$data['header']['username'] ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo @$data['header']['submitfrom'] ?></td>
		</tr>
		<tr>
			<td>Date</td>
			<td>:</td>
			<td><?php echo date('d M Y') ?></td>
		</tr>
	</table>

	<p>Detail</p>
	<?php if (@$data['header']['purchase_type']=="SERVICES"){ ?>
		<table border="1" cellpadding="8px" cellspacing="0">
			<tr>
				<td>Item</td>
				<td>Description</td>
				<td>Qty</td>
				<td>Unit</td>
			</tr>
			<?php $i=1; ?>
			<?php foreach ($data['data'] as $key => $val): ?>
				<tr>
					<td><?php echo $val['item'] ?></td>
					<td><?php echo $val['description'] ?></td>
					<td><?php echo $val['qty'] ?></td>
					<td><?php echo $val['unit'] ?></td>
				</tr>			
			<?php endforeach ?>
		</table>
	<?php } else if (@$data['header']['purchase_type']=="STUFF") { ?>
		<table border="1" cellpadding="8px" cellspacing="0">
			<tr>
				<td>Category</td>
				<td>Item</td>
				<td>Qty</td>
				<td>Unit</td>
				<td>Price</td>
				<td>Total</td>
			</tr>
			<?php $i=1; ?>
			<?php foreach ($data['data'] as $key => $val): ?>
				<tr>
					<td><?php echo $val['stuff_category'] ?></td>
					<td><?php echo $val['item'] ?></td>
					<td><?php echo $val['qty'] ?></td>
					<td><?php echo $val['unit'] ?></td>
					<td><?php echo number_format($val['unit_price']) ?></td>
					<td><?php echo number_format($val['qty']*$val['unit_price']) ?></td>
				</tr>			
			<?php endforeach ?>
		</table>
	<?php } else { ?>
		<table border="1" cellpadding="8px" cellspacing="0">
			<tr>
				<td>Item</td>
				<td>Description</td>
				<td>Qty</td>
				<td>Unit</td>
				<td>Price</td>
				<td>Total</td>
			</tr>
			<?php $i=1; ?>
			<?php foreach ($data['data'] as $key => $val): ?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php echo $val['op_titel'].', '.$val['description'] ?></td>
					<td><?php echo $val['qty'] ?></td>
					<td><?php echo $val['unit'] ?></td>
					<td><?php echo number_format($val['unit_price']) ?></td>
					<td><?php echo number_format($val['qty']*$val['unit_price']) ?></td>
				</tr>			
			<?php endforeach ?>
		</table>
	<?php } ?>

	<br>
	<a href="<?php echo @$data['link_approve'] ?>" style="">Approve</a> |
	<a href="<?php echo @$data['link_reject'] ?>" style="">Reject</a> |
	<a href="<?php echo base_url() ?>" style="">Login</a>


</div>