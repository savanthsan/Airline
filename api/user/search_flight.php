<?php
include(__DIR__ . '/../db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Flight</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Search Flights</div>

<div class="container">

<form method="POST">
    <input type="text" name="source" placeholder="Source" required>
    <input type="text" name="destination" placeholder="Destination" required>
    <button type="submit" name="search">Search</button>
</form>

<br>

<?php
if(isset($_POST['search'])){
    $source = $_POST['source'];
    $destination = $_POST['destination'];

    $result = mysqli_query($conn,
    "SELECT * FROM flight 
     WHERE source='$source' 
     AND destination='$destination'
     AND available_seats > 0
     AND status NOT IN ('Cancelled', 'Reached Destination')");

    if(mysqli_num_rows($result) > 0){
        echo "<table>";
        echo "<tr>
                <th>Flight No</th>
                <th>Route</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Seats</th>
                <th>Status</th>
                <th>Action</th>
              </tr>";

        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['flight_no']."</td>";
            echo "<td>".$row['source']." → ".$row['destination']."</td>";
            echo "<td>".$row['departure_time']."</td>";
            echo "<td>".$row['arrival_time']."</td>";
            echo "<td>".$row['available_seats']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td><a class='back-btn' href='book_flight.php?id=".$row['flight_id']."'>Book</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    }else{
        echo "<p class='error'>No available flights found.</p>";
    }
}
?>

<a href="user_dashboard.php" class="back-btn">Back to Dashboard</a>

</div>

</body>
</html>