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


// Calculate total savings
$sql_savings = "SELECT SUM(cost) AS total_savings FROM expense WHERE category LIKE 'savings' AND DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$result_savings = mysqli_query($conn, $sql_savings);
$row_savings = mysqli_fetch_assoc($result_savings);
$total_savings = $row_savings['total_savings'] ?? 0;

// Calculate total fuel
$sql_fuel = "SELECT SUM(cost) AS total_fuel FROM expense WHERE category LIKE 'fuel' AND DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$result_fuel = mysqli_query($conn, $sql_fuel);
$row_fuel = mysqli_fetch_assoc($result_fuel);
$total_fuel = $row_fuel['total_fuel'] ?? 0;

// Calculate total food
$sql_food = "SELECT SUM(cost) AS total_food FROM expense WHERE category LIKE 'food' AND DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$result_food = mysqli_query($conn, $sql_food);
$row_food = mysqli_fetch_assoc($result_food);
$total_food = $row_food['total_food'] ?? 0;

// Calculate total investment
$sql_investment = "SELECT SUM(cost) AS total_investment FROM expense WHERE category LIKE 'investment' AND DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$result_investment = mysqli_query($conn, $sql_investment);
$row_investment = mysqli_fetch_assoc($result_investment);
$total_investment = $row_investment['total_investment'] ?? 0;

// Calculate total lifestyle
$sql_lifestyle = "SELECT SUM(cost) AS total_lifestyle FROM expense WHERE category LIKE 'lifestyle' AND DATE_FORMAT(date, '%Y-%m') = '$currentMonth'";
$result_lifestyle = mysqli_query($conn, $sql_lifestyle);
$row_lifestyle = mysqli_fetch_assoc($result_lifestyle);
$total_lifestyle = $row_lifestyle['total_lifestyle'] ?? 0;

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    background-color: rgb(182, 180, 180);
    margin: 0;
    font-family: Arial, sans-serif;
}

.display-boxes {
    margin: 15px;
    padding: 10px 30px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.boxes {
    height: 85px;
    width: 160px;
    text-align: center;
    border-radius: 12px;
    padding: 15px 5px;
    margin-bottom: 15px;
}

.cost {
    font-size: 18px;
    margin-top: 10px;
    text-align: center;
}

table {
    border-collapse: collapse;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    max-height: 20vh;
    overflow-y: auto; /* Add scroll only vertically */
    margin-top: 10px;
}


th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid black;
}

th {
    background-color: #051f26;
    color:white;
    font-weight: bold;
}

h1, h2 {
    font-size: 24px;
    text-align: center;
    margin-top: 20px;
}

.tab {
    float: left;
    background-color: #051f26;
    width: 12%;
    height: 88.3vh;
    margin-top: .2px;
}

.tab button {
    display: block;
    background-color: #051f26;
    color: white;
    padding: 22px 16px;
    width: 100%;
    text-align: left;
    border: 1px solid #051f26;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
}

.tab button:hover {
    background-color: #113e5c;
}

.tab button.active {
    background-color: #113e5c;
}

.tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 88%;
    height: 88.3vh;
}

.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #051f26;
    height: 12vh;
    color: #fff;
}

.logo img {
    height: 10vh;
}

.ribbon {
    display: flex;
}

.ribbon a {
    color: #fff;
    text-decoration: none;
    font-size: 19px;
    padding: 10px 20px;
    display: inline-block;
}

.ribbon a:hover {
    background-color: #113e5c;
    transition: 200ms;
}

.displaycases {
    max-width: 800px;
    max-height: 60vh;
    margin-left: 17%;
}

.case-Pending {
    color: black;
    background-color: yellow;
}

.case-approved {
    color: white;
    background-color: green;
}
/* Style the scrollbar */
::-webkit-scrollbar {
    width: 8px; /* Set the width of the scrollbar */
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1; /* Set a background color for the scrollbar track */
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888; /* Set a color for the scrollbar handle */
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; /* Set a darker color for the scrollbar handle on hover */
}


</style>
</head>
<body>

<h1 style="font-size:30px; text-align: center;">History</h1><br>
<div style="overflow-x:auto; max-height: 70vh;">
    <table border=1>
        <tr>
            <th>Date</th>
            <th>Day</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Cost</th>
        </tr>
        <?php
            $sql_recent = "SELECT * FROM expense ORDER BY id DESC ";
            $result_recent = mysqli_query($conn, $sql_recent);
            while($row_recent = mysqli_fetch_assoc($result_recent)) {
                echo "<tr>";
                echo "<td>".date("d-m-y", strtotime($row_recent['date']))."</td>";
                echo "<td>".$row_recent['day']."</td>";
                echo "<td>".$row_recent['category']."</td>";
                echo "<td>".$row_recent['subcategory']."</td>";
                echo "<td>".$row_recent['cost']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>


</body>
</html>


