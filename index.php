<?php
  session_start();

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
?>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=mypot", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>History</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
 
<body>
    <div class="container">
        <h3>History</h3><br>
        <h4>IP of Honeypot server is 192.168.1.111</h4>
        <table id="myTable" class="table table-striped">
            <thead>
                <th>Risk</th>
                <th>Honeypot</th>
                <th>Date</th>
                <th>Time</th>
                <th>IP Attacker</th>
                <th>Protocol</th>
                <!-- <th>Honeypot</th> -->
                <th>Description</th>
            </thead>
            <tbody>
        <?php
        
        $stmt = $conn->query("SELECT * FROM honeypot");
        $stmt->execute();

        $honeypot = $stmt->fetchAll();
        foreach($honeypot as $pot){
        ?>
            <tr>
                <td><?php echo $pot['alert']?></td>
                <td><?php echo $pot['type']?></td>
                <td><?php echo $pot['date']?></td>
                <td><?php echo $pot['time']?></td>
                <td><?php echo $pot['ip_attacker']?></td>
                <td><?php echo $pot['protocol']?></td>
                <td><?php echo $pot['comment']?></td>
            </tr>

        <?php
        }

        ?>
            </tbody>
        </table>
        <h1> </h1>
        <a href="logout.php" class="btn btn-warning">LOGOUT</a>
    </div>

    <script src=https://code.jquery.com/jquery-3.6.4.min.js></script>
    <script src=https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js></script>
    <script>
        $(document).ready(function () {
            $("#myTable").DataTable();
        });
    </script>
    
</body>
</html>
<?php
}else {
   header("Location: login.php");
}
 ?>
