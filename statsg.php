<?php
$conn=mysqli_connect('localhost','root','','cashbook');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Calculate total cost of all entries in this month
$currentMonth = date('Y-m');
$sql = "SELECT SUM(cost) AS total_all FROM expense WHERE DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_all = $row['total_all'] ?? 0;

// Fetch data for each category
$categories = ['savings', 'fuel', 'food', 'investment', 'lifestyle'];
$category_totals = [];

foreach ($categories as $category) {
    $sql_category = "SELECT SUM(cost) AS total_category FROM expense WHERE category LIKE '$category' AND DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
    $result_category = mysqli_query($conn, $sql_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $total_category = $row_category['total_category'] ?? 0;
    $category_totals[$category] = $total_category;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 80%;
            margin: auto;
        }
    </style>
</head>
<body>
<style>
    .chart-container {
        width: 40%; /* Adjust width as needed */
        margin: auto;
    }
</style>

    <div class="chart-container">
        <canvas id="myPieChart"></canvas>
    </div>
    <script>
        // Data fetched from PHP
        const categoryData = <?php echo json_encode(array_values($category_totals)); ?>;
        const categoryLabels = <?php echo json_encode($categories); ?>;
        
        // Pie chart data
        const data = {
            labels: categoryLabels,
            datasets: [{
                label: 'Category Wise Expenses',
                data: categoryData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Configuration options
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw}`;
                            }
                        }
                    }
                }
            }
        };

        // Render the chart
        const myPieChart = new Chart(
            document.getElementById('myPieChart'),
            config
        );
    </script>
</body>
</html>
