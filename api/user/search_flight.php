<?php
include(__DIR__ . '/../db.php');

// OOP Class Instantiation
$flightObj = new Flight($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Flights | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">
    <a href="../index.php" class="navbar-brand">
        <i class="fa-solid fa-plane-departure"></i>
        <span>AIRLINE SYSTEM</span>
    </a>
    <div class="navbar-tagline">Flight Search</div>
</div>

<div class="container">

    <h2>Search Global Routes</h2>
    <p style="margin-bottom: 30px;">Find available flights across your favorite destinations</p>

    <div style="background: var(--bg-card); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); padding: 30px; border-radius: 20px; max-width: 750px; margin: 0 auto 40px;">
        <form method="POST" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">
            <div class="form-group" style="width: 280px;">
                <label><i class="fa-solid fa-plane-departure" style="margin-right: 6px;"></i>Departure City (Source)</label>
                <input type="text" name="source" placeholder="e.g. Dubai, New York, London" required value="<?php echo htmlspecialchars($_POST['source'] ?? ''); ?>">
            </div>

            <div class="form-group" style="width: 280px;">
                <label><i class="fa-solid fa-plane-arrival" style="margin-right: 6px;"></i>Arrival City (Destination)</label>
                <input type="text" name="destination" placeholder="e.g. Tokyo, Paris, Sydney" required value="<?php echo htmlspecialchars($_POST['destination'] ?? ''); ?>">
            </div>

            <button type="submit" name="search" style="width: 100%; max-width: 580px; margin-top: 10px;">
                <i class="fa-solid fa-magnifying-glass"></i> Search Available Flights
            </button>
        </form>
    </div>

<?php
if(isset($_POST['search'])){
    $source = $_POST['source'];
    $destination = $_POST['destination'];

    // Call OOP Flight class search method
    $result = $flightObj->search($source, $destination);

    if($result && mysqli_num_rows($result) > 0){
        echo "<h3 style='margin-bottom: 20px; color: var(--text-gold);'>Available Flights</h3>";
        echo "<div class='table-responsive'>";
        echo "<table>";
        echo "<thead>
                <tr>
                    <th>Flight No</th>
                    <th>Route</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Available Seats</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>";

        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td><strong style='color: var(--text-gold);'><i class='fa-solid fa-plane' style='margin-right: 6px;'></i>".$row['flight_no']."</strong></td>";
            echo "<td>".$row['source']." <i class='fa-solid fa-arrow-right' style='color: var(--primary-gold); margin: 0 6px;'></i> ".$row['destination']."</td>";
            echo "<td><i class='fa-regular fa-clock' style='margin-right: 4px;'></i>".$row['departure_time']."</td>";
            echo "<td><i class='fa-regular fa-clock' style='margin-right: 4px;'></i>".$row['arrival_time']."</td>";
            echo "<td><span style='background: rgba(56, 239, 125, 0.15); color: #38EF7D; padding: 4px 10px; border-radius: 12px; font-weight: 700;'>".$row['available_seats']." Seats Left</span></td>";
            echo "<td><span style='background: rgba(212, 175, 55, 0.2); color: var(--text-gold); padding: 4px 12px; border-radius: 12px; font-weight: 600;'>".$row['status']."</span></td>";
            echo "<td><a class='btn btn-gold' style='padding: 8px 18px; font-size: 13px; font-weight: 700;' href='book_flight.php?id=".$row['flight_id']."'><i class='fa-solid fa-ticket'></i> Book Flight</a></td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        echo "</div>";
    }else{
        echo "<div class='status-card'><p class='error'><i class='fa-solid fa-circle-exclamation' style='font-size: 30px; margin-bottom: 10px; display: block;'></i>No available flights found for this route.</p></div>";
    }
}
?>

    <div style="margin-top: 40px;">
        <a href="user_dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
    </div>

</div>

<div class="footer">
    <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
</div>

</body>
</html>