<?php
include('koneksi.php');
$query = mysqli_query($koneksi,"select sum(total_cases) as total, sum(new_cases) as new, sum(total_death) as total_death, sum(new_death) as new_death, sum(total_recovered) as recovered, sum(active_cases) as active from cases");
$row = 	$query->fetch_array();
$total_cases = $row['total'];
$new_cases = $row['new'];
$total_death = $row['total_death'];
$new_death = $row['new_death'];
$total_recovered = $row['recovered'];
$active_cases = $row['active'];
	
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
				<div class="col-sm container ">
					<div style="width:100%; height:100%">
						<canvas id="myChart"></canvas>
					</div>
				</div>
		</div>
	<script>
		var ctx = document.getElementById("myChart");
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: ['Total Cases','New Cases','Total Death', 'New Death', 'Total Recovered', 'Active Cases'],
				datasets: [{ 
					data: [<?php 
						echo json_encode($total_cases); 
						echo ', '; 
						echo json_encode($new_cases); 
						echo ', '; 
						echo json_encode($total_death);
						echo ', '; 
						echo json_encode($new_death); 
						echo ', '; 
						echo json_encode($total_recovered);
						echo ', '; 
						echo json_encode($active_cases);
						   ?>],
					label: 'Total Cases', 
        			backgroundColor:[ 
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(127, 255, 212, 1)',
						'rgba(0, 191, 255, 1)',
						'rgba(112, 128, 144, 1)'
					]
				}
			]
			},
			options: {
				
    title: {
      display: true,
      text: 'Total cases Covid-19 in the World'
    }
  }
});
	</script>
</body>
</html>