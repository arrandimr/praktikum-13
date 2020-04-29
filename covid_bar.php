<?php
include('koneksi.php');
$country = mysqli_query($koneksi,"select * from country");
while($row = mysqli_fetch_array($country)){
$negara[] = $row['country'];
	
	$query = mysqli_query($koneksi,"select total_cases from cases where id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$jumlah_cases[] = $row['total_cases'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($negara); ?>,
				datasets: [{
					label: 'Total Cases',
					data: <?php echo json_encode($jumlah_cases); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1

				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>