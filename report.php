<?php
require_once('include/TSystemComponent.php');
require_once('include/TDbConnector.php');


if(isset($_POST['submit'])) // form submitted
{
	$pass = $_POST['pass'];
	if($pass != 'tr90PZAS%%') exit('Access denied.');
	
	
	function NowDatetime()
	{
		return date("Y-m-d H:i:s");
	}

	function mysqlToBR( $mysqlTime ) {
		$dateTime = explode( ' ', $mysqlTime );
		$dateTime[0] = explode( '-', $dateTime[0] );
		$dateTime = $dateTime[0][2].'/'.$dateTime[0][1].'/'.$dateTime[0][0].' '.$dateTime[1];
		
		return $dateTime;
	}

	// current datetime
	$datetime = NowDatetime();

	// record database register
	$db = new TDbConnector();

	$query = "SELECT * FROM traj_rfp.rfp ORDER BY datetime DESC";
	$rows = $db->GetAllResults($query);

	?>
	<html>
	<head>
	<title>Relatório de campanha</title>
	<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<style type='text/css'>
	body
	{
		font-family: Arial;
		font-size: 10px;
		color: #000;
	}

	h1
	{
		text-align: center;
		width: 100%;
	}

	#tabela1 th, #tabela1 td
	{
		padding: 8px;
	}

	#tabela1 td
	{
		border-bottom: 1px solid #bbb;
		font-size: 12px;
	}

	#tabela1 th
	{
		background: #44b5b6;
		color: #fff;
	}

	.linha_mensagem td
	{
		background: #eee;
	}

	</style>
	<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
	<script type='text/javascript'>
	$(document).ready(function(){
		$('.linha_mensagem').hide();

		$('.link_mensagem').click(function(){
			$('#msg_' + $(this).attr('id')).toggle();
		});
	});

	</script>

	</head>
	<body>
	<h1>Relatório gerado em <?php echo mysqlToBR(NowDatetime()); ?></h1>
	<table id='tabela1'>
	<thead>
		<tr>
			<th>id</th>
			<th>from_code</th>
			<th>datetime</th>
			<th>nome</th>
			<th>e-mail</th>
			<th>telefone</th>
			<th>ip</th>
			<th>país</th>
			<th>cidade</th>
			<th>os</th>
			<th>browser</th>
			<th>resolução</th>
			<th>msg</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($rows as $r) {
	?>

		<tr>
			<td><?php echo $r['id']; ?></td>
			<td><?php echo $r['from_code']; ?></td>
			<td><?php echo mysqlToBR($r['datetime']); ?></td>
			<td><?php echo $r['name']; ?></td>
			<td><a href='<?php echo $r['email']; ?>'><?php echo $r['email']; ?></a></td>
			<td><?php echo $r['telefone']; ?></td>
			<td><?php echo $r['ip']; ?></td>
			<td><?php echo $r['country_name']; ?> (<?php echo $r['country_code']; ?>)</td>
			<td><?php echo $r['city']; ?></td>
			<td><?php echo $r['os']; ?></td>
			<td><?php echo $r['browser']; ?> <?php echo $r['browser_version']; ?></td>
			<td><?php echo $r['screen']; ?></td>
			<td><a href='#' class='link_mensagem' id='<?php echo $r['id'];?>'>abrir</a></td>
		</tr>
		<tr class='linha_mensagem' id='msg_<?php echo $r['id']; ?>'>
			<td colspan='13'><pre><?php echo nl2br($r['message']); ?></pre></td>
		</tr>
	<?php } ?>
	</tbody>

	</table>
	</body>
	</html>

<?php
}
else // form wasn't submitted
{
?>
<html>
	<head>
	<title>Relatório de campanha</title>
	<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	</head>
	<body>
	
	<div style="width: 90%; text-align: center; margin: 50px;">
	<form method="post">
	Senha: <input type="password" name="pass" size="20" />
	<input type="submit" name="submit" value="Confirmar" />
	</form>
	</div>
	</body>
	</html>

<?php
}
?>
