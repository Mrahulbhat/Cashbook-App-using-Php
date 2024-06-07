<?php
    $conn=mysqli_connect("localhost","root","","cashbook");
    if(!$conn)
    {
        die("error".mysqli_connect_error());
    }
?>
<div class="header">
    <div class="logo">
        <img src="images/Cash Book.png" alt="Logo">
        <style>
            body{
                background-color: #0d865a;
            }
            .logo img{
                height: 80px;
                width: 100%;
                margin:10px;
            }
        </style>
    </div>

    <div class="ribbon">
        <a href="dashboard.php">Home</a>
        <a href="addrecord.php">Add Record</a>
        <a href="index.php" style="background-color:#0d865a; border-radius:10px;">Logout</a>
        <style>
            header{
                height: 10vh;
            }
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

</div><link rel="stylesheet" href="stats.css">
<h1>New Expense Record</h1>
    <form action="addrecord.php" method="post">
        <table class="updatetable">
            <tr>
                <td class="updatelabel">Date</td>
                <td><input class="updateinput" type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>"></td>
            </tr>

            <tr>
                <td class="updatelabel">Day</td>
                <td>
                    <select name="day" class="updateinput">
                        <option value="Monday" <?php if(date('l') == 'Monday') echo 'selected'; ?>>Monday</option>
                        <option value="Tuesday" <?php if(date('l') == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                        <option value="Wednesday" <?php if(date('l') == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                        <option value="Thursday" <?php if(date('l') == 'Thursday') echo 'selected'; ?>>Thursday</option>
                        <option value="Friday" <?php if(date('l') == 'Friday') echo 'selected'; ?>>Friday</option>
                        <option value="Saturday" <?php if(date('l') == 'Saturday') echo 'selected'; ?>>Saturday</option>
                        <option value="Sunday" <?php if(date('l') == 'Sunday') echo 'selected'; ?>>Sunday</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="updatelabel">Category</td>
                <td>
                    <select name="category" id="category" class="updateinput" onchange="populateSubCategories()">
                        <option value="fuel">Fuel</option>
                        <option value="food">Food</option>
                        <option value="savings">Savings</option>
                        <option value="investment">Investment</option>
                        <option value="lifestyle">Lifestyle</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="updatelabel">Sub Category</td>
                <td>
                    <select name="subcategory" id="subcategory" class="updateinput">
                        
                    </select>
                </td>
            </tr>
            <tr>
                <td class="updatelabel">Cost</td>
                <td><input class="updateinput" type="number"  name="cost" placeholder="Enter Cost"></td>
            </tr>
            <tr>
                <td class="updatelabel">Note</td>
                <td><input class="updateinput" type="text" name="note" placeholder="Add Note"></td>
            </tr>
           
                        
        </table>
        <button class="btn-edit1" type="submit" >Update</button>
    </form><br><br><br>
    <h2>Last entered Record</h2>
    <table class="updatetable" style="margin-bottom:200px">
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Cost</th>
        </tr>
    <?php
            $sql_recent = "SELECT * FROM expense ORDER BY date DESC LIMIT 3";
            $result_recent = mysqli_query($conn, $sql_recent);
            while($row_recent = mysqli_fetch_assoc($result_recent)) {
                echo "<tr>";
                echo "<td>".date("d-m-y", strtotime($row_recent['date']))."</td>";
                echo "<td>".$row_recent['category']."</td>";
                echo "<td>".$row_recent['subcategory']."</td>";
                echo "<td>".$row_recent['cost']."</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <?php
    

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date=$_POST['date'];
    $day=$_POST['day'];
    $category=$_POST['category'];
    $subcategory=$_POST['subcategory'];
    $cost=$_POST['cost'];
    $note=$_POST['note'];

    $sql_insert = "INSERT INTO `expense` (`category`, `subcategory`, `date`, `day`, `cost`, `note`) 
                   VALUES ('$category', '$subcategory', '$date', '$day', '$cost', '$note')";
    $result_insertion = mysqli_query($conn, $sql_insert);

    if ($result_insertion) {
        echo "<script>alert('Record Inserted successfully.')</script>";
    } 
    else {
        echo "<script>alert('Error')</script>";
    }
}
?>

<script>
    function populateSubCategories() {
        var category = document.getElementById("category").value;
        var subcategorySelect = document.getElementById("subcategory");

        subcategorySelect.innerHTML = "";

        switch (category) {
            case "fuel":
                subcategorySelect.innerHTML = "<option value='bike'>Bike</option><option value='bus'>Bus</option><option value='car'>Car</option><option value='other'>Other</option>";
                break;
            case "food":
                subcategorySelect.innerHTML = "<option value='breakfast'>Breakfast</option><option value='lunch'>Lunch</option><option value='snacks'>Snacks</option><option value='gym'>Gym</option><option value='junk'>Junk</option><option value='water'>water</option>";
                break;
            case "savings":
                subcategorySelect.innerHTML = "<option value='savings'>Savings</option>";
                break;
            case "investment":
                subcategorySelect.innerHTML = "<option value='investment'>Investment</option>";
                break;
            case "lifestyle":
                subcategorySelect.innerHTML = "<option value='books'>Books</option><option value='trips'>Trips</option><option value='party'>Party</option><option value='other'>Other</option>";
                break;
            default:
                subcategorySelect.innerHTML = ""; 
                break;
        }
    }

    populateSubCategories();
</script>

<style>
        
    .updatetable {
        margin: 20px;
        margin-left: 350px;
        background-color: grey;
        max-width: 600px;
        margin-right: 200px;
    }

    .updatetable table {
        border-collapse: collapse;
    }

    .updatetable td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .updatetable .updatelabel {
        font-weight: bold;
    }

    .updateinput{
        width: 200px;
        height: 6vh;
        padding:10px 15px;
        margin-left: -80px;
        margin-right: -80px;
    }
    .updatelabel{
        width: 150px;
    }

    .btn-edit1 {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        margin-left: 380px;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn-edit1:hover {
        background-color: #45a049;
    }
</style>