
<?php include("../assets/noSessionRedirect.php"); ?>

<?php include("./verifyRoleRedirect.php"); 
  $id = $_SESSION['uid'];
?>

<?php echo "<script>var id='{$id}'</script>"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ERP - Progress Report</title>
	<style type="text/css">
		.body{
			width: 80%;
			margin-left: 10%;
			margin-top: 10%;
			border-radius: 8px;
			padding: 20px;
		}
		#columnchart_material{
			height: 500px;
			width: 100%;
		}
		@media only screen and (max-width: 768px){
			#columnchart_material{
				height: 400px;
				width: 400%;
			}
			.body{
				margin-left: 0%;
			}
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="body">
    	<div id="columnchart_material"></div>
    </div>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(fetchDataAndDrawChart);

    function fetchDataAndDrawChart() {
        fetch("fetch-data/progress-data.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json" // Specify content type as JSON
            },
            body: JSON.stringify({ id: id }) // Convert data to JSON string
        })
        .then(response => response.json())
        .then(data => {

            console.log(data);

            var chartData = [['Exam', 'Marks']]; // Initialize chart data
            for (var i = 0; i < data.length; i++) {
                chartData.push([data[i]['exam_name'], data[i]['marks']]); // Push exam and marks data
            }
            drawChart(chartData); // Draw chart with fetched data
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function drawChart(chartData) {
        var data = google.visualization.arrayToDataTable(chartData);

        var options = {
            chart: {
                title: 'Exam Progress In Percentage(100%)',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

</html>