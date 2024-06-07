<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard | Cash Book</title>
<link rel="icon" href="images/Home.png">
<link rel="stylesheet" href="stats.css">
</head>
<body>

<div class="header">
    <div class="logo">
        <img src="images/Cash Book.png" style="margin-left:10px;" alt="Logo">
        <style>
            .logo img{
                height: 80px;
                width: 100%;
                margin:-10px;
            }
        </style>
    </div>

    <div class="ribbon">
        <a href="addrecord.php">Add Record</a>
        <a href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=cashbook">Admin</a>
        <a href="index.php" style="background-color:#0d865a; border-radius:10px; margin-right:10px;">Logout</a>
        <style>
            .ribbon{
            }
            .ribbon a{
                margin-left: 10px;
            }
            .ribbon a :hover{
                background-color: #0d865a;

            }
        </style>
    </div>
</div>

<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'Overall')" id="defaultOpen">Overall</button>
    <button class="tablinks" onclick="openCity(event, 'Food')">Food</button>
    <button class="tablinks" onclick="openCity(event, 'Fuel')">Fuel</button>
    <button class="tablinks" onclick="openCity(event, 'AllRecords')">All Records</button>
</div>


<!----------------------------------------------Tab----------------------------------------------------->


<div id="Overall" class="tabcontent">
    <?php include 'overall.php'; ?>
</div>

<div id="Food" class="tabcontent">
    <?php include 'food.php'; ?>
</div>

<div id="Fuel" class="tabcontent">
    <?php include 'fuel.php'; ?>
</div>

<div id="AllRecords" class="tabcontent">
    <?php include 'AllRecords.php'; ?>
</div>

<style>
    #update{
        background-image: url(images/update.png);
        background-size: cover;
    }
</style>

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>
