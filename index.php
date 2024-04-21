<?php
include "./connection.php";


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
//     $e_id = $_POST['e_id'];
//     $activity = $_POST['activity'];
//     $timestamp = date("Y-m-d H:i:s"); 

//     $stmt = $conn->prepare("INSERT INTO attendance (E_ID, activity, timestamp) VALUES (?, ?, ?)");
//     $stmt->bind_param("sss", $e_id, $activity, $timestamp);
//     $stmt->execute();
//     $stmt->close();
// }

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="./first.css">
  <title>Homepage</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg bgnav">
    <div class="container-fluid d-flex justify-content-between align-items-center">

      <a class="logo d-flex align-items-center text-warning text-decoration-none">
        <img src="image/logo.png" alt="Logo" class="logo-img">
        <h3 class="headtxt">Turnago Group.</h3>
      </a>

      <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
      </button>

      <div class="collapse navbar-collapse d-flex align-items-center" id="navbarNavAltMarkup">
        <button class="employee-btn"><a href="./employee/login.php">Employee</a></button>
        <button class="admin-btn"><a href="./admin/login.php">Admin</a></button>
      </div>

    </div>

  </nav>

  <div class="homepage">
    <div class="text-content">
      <h2 class="home-head">Developing Employee Manage & Attendance System</h2>
      <p>Embark on a transformative journey with Turnago Group, a multifaceted enterprise shaping excellence across diverse sectors. From pioneering the realms of Travel & Tourism through Turnago Enterprise, and cutting-edge Software Development with Turnago IT, to the serene retreats of Turnago Lounge & Resort, and groundbreaking initiatives in Agro-Based Projects, Turnago stands as a beacon of innovation. E-Turnago, Turnago Holdings, and the Humandity Charity Foundation further exemplify our commitment to holistic development and societal well-being. Join us as we redefine possibilities and inspire positive change with every endeavor.</p>
    </div>

    <div class="employee-activites">
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="input-on">
          <label style="color: white;">E_ID:</label>
          <input type="text" class="text-in" name="e_id" />
        </div>

        <div class="select-option" style="margin-top:1rem; border: none;">
          <select name="activity" style="background: rgba(255, 255, 255, 0.555); border-radius: 10px; padding:4px 10px; font-weight:600;">
            <option>Time In</option>
            <option>Time Out</option>
          </select>
        </div>

        <div class="button-on" style="margin:1.8rem auto;">
          <button type="submit" class="submit-btn">Submit</button>
        </div>
      </form>

      <div id="time" class="timeshow" onload='showTime()'>
        <?php
        date_default_timezone_set("Asia/Dhaka");
        echo date("h : i : s a");
        ?>
      </div>
    </div>

    <footer>
      Developed by @bid Hasan © 2024.
    </footer>

    <style>
      @font-face {
        font-family: 'clock';
        src: url("./image/digital.ttf");
      }

      .timeshow {
        margin-top: 3.5rem;
        font-family: 'clock';
        color: rgba(255, 246, 187, 0.455);
        text-align: center;
        font-size: 45px;
        font-weight: 800;
      }

      footer {
        left: 0;
        bottom: 0;
        position: fixed;
        background: rgba(255, 255, 255, 0.205);
        color: greenyellow;
        font-family: clock;
        font-weight: 600;
        word-spacing: 6px;
        width: 100%;
        padding: 6px 0;
        text-align: center;
      }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      // Function to update time
      function updateTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var meridian = hours >= 12 ? "PM" : "AM";

        // Convert hours to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // If hours is 0, set it to 12

        // Pad single digit minutes and seconds with leading zeros
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        // Update the time display
        document.getElementById('time').innerHTML = hours + " : " + minutes + " : " + seconds + " " + meridian;
      }

      // Call updateTime initially
      updateTime();

      // Call updateTime every second (1000 milliseconds)
      setInterval(updateTime, 1000);
    </script>

</body>

</html>
