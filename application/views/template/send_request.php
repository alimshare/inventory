<style type="text/css">
	* {font-family: arial}
	a { text-decoration: none; border: 1px solid black; padding: 4px;}
</style>
<div>
	<p>Request Detail</p>
	<table>
		<tr>
			<td>Requestor</td>
			<td>:</td>
			<td><?php echo @$data->username ?></td>
		</tr>
		<tr>
			<td>Purpose</td>
			<td>:</td>
			<td><?php echo @$data->purpose ?></td>
		</tr>
		<tr>
			<td>Duration</td>
			<td>:</td>
			<td><?php echo @$data->duration ?></td>
		</tr>
		<tr>
			<td>Item</td>
			<td>:</td>
			<td><?php echo @$data->item ?></td>
		</tr>
		<tr>
			<td>Brand</td>
			<td>:</td>
			<td><?php echo @$data->brand ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo @$data->submitfrom ?></td>
		</tr>
		<tr>
			<td>Date</td>
			<td>:</td>
			<td><?php echo date('d M Y') ?></td>
		</tr>
	</table>	

	<br>
	<a href="<?php echo @$data->link_approve ?>" style="">Approve</a> |
	<a href="<?php echo @$data->link_reject ?>" style="">Reject</a> |
	<a href="<?php echo base_url() ?>" style="">Login</a>

</div>