<?php
include('koneksi.php');
$country = mysqli_query($koneksi,"select * from country");
while($row = mysqli_fetch_array($country)){
$negara[] = $row['country'];
	
	$query = mysqli_query($koneksi,"select * from cases where id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$total_cases[] = $row['total_cases'];
	$new_cases[] = $row['new_cases'];
	$total_death[] = $row['total_death'];
	$new_death[] = $row['new_death'];
	$total_recovered[] = $row['total_recovered'];
	$active_cases[] = $row['active_cases'];
	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style>
		.warning {color: #FF0000;}
		.container {
			padding-top: 25px;
		}
				
	</style>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div class="container rounded shadow bg-white ">
	<div class="card ">
				<div class="card-header bg-info text-white shadow sticky-top" align="center">
					<p class="h4">GRAFIK PENYEBARAN COVID-19</p>
				</div>
		
			<div class="card-body">
				<div class="col-sm container">
					<div style="width:100%; height:100%">
						<canvas id="myChart"></canvas>
					</div>
				</div>
		</div>
	<script>
		var ctx = document.getElementById("myChart");
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($negara); ?>,
				datasets: [{ 
        			data: <?php echo json_encode($total_cases); ?>,
					label: 'Total Cases',
        			backgroundColor: 'rgba(255, 99, 132, 1)',
				},{
					data: <?php echo json_encode($new_cases); ?>,
					label: 'New Cases',
        			backgroundColor: 'rgba(54, 162, 235, 1)',
				
				},{
					data: <?php echo json_encode($total_death); ?>,
					label: 'Total Death',
        			backgroundColor: 'rgba(255, 206, 86, 1)',
					
				},{
					data: <?php echo json_encode($new_death); ?>,
					label: 'New Death',
        			backgroundColor: 'rgba(127, 255, 212, 1)',
					
				},{
					data: <?php echo json_encode($total_recovered); ?>,
					label: 'Total Recovered',
        			backgroundColor: 'rgba(0, 191, 255, 1)',
					
				},{
					data: <?php echo json_encode($active_cases); ?>,
					label: 'Active Cases',
        			backgroundColor: 'rgba(112, 128, 144, 1)',
					
				}
			]
			},
			options: {
    title: {
      display: true,
      text: 'Covid-19 in the World per-region'
    }
  }
});
	</script>
</body>
</html>