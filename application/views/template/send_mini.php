<style type="text/css">
	* {font-family: arial}
	a { text-decoration: none; border: 1px solid black; padding: 4px;}
</style>
<div>
	<p>Mini Proposal</p>
	<br>
	<p style="text-align: justify;"><?php echo @$data->background ?></p>
	<p style="text-align: justify;"><?php echo @$data->what .' '. @$data->why .' '. @$data->who .' '. @$data->where_location ?></p>
	<br>
	<br>
	<table>
		<tr>
			<td>Requestor</td>
			<td>:</td>
			<td><?php echo @$data->submitfromUsername ?></td>
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
	<br>
	<table>
		<tr>
			<td>Approved By</td>
			<td>:</td>
			<td>Caroline Francis – FHI 360 Chief of Party</td>
		</tr>
		<tr>
			<td>Date</td>
			<td>:</td>
			<td></td>
		</tr>
	</table>	
	<br>
	<a href="<?php echo @$data->link_approve ?>" style="">Approve</a> |
	<a href="<?php echo @$data->link_reject ?>" style="">Reject</a> |
	<a href="<?php echo base_url() ?>" style="">Login</a>

</div>