<?php
require 'db.php';
session_start();

// Handle Login Request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role']; // Get role (user/admin) from form
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    if ($role === 'user') {
        // User Login
        $stmt = $conn->prepare("SELECT id, name ,status FROM users WHERE name = ? AND password = ? ");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $name, $status);
            $stmt->fetch();
            
            if ($status == 'active') {
                $_SESSION['user_id'] = $id;
                $_SESSION['name'] = $name;
                header("Location: dashboard.php");
            } else {
                $error = "Currently Inactive";
            }
        } else {
            $error = "Invalid username or password for user!";
        }
        
// if($status='active'){
//         if ($stmt->num_rows > 0) {
//             $stmt->bind_result($id, $name);
//             $stmt->fetch();
//             $_SESSION['user_id'] = $id;
//             $_SESSION['name'] = $name;
//             header("Location: dashboard.php");
//         } else {
//             $error = "Invalid username or password for user!";
//         }}
//         else{
//             $error = "Currently Inactive";
//         }
    } elseif ($role === 'admin') {
        // Admin Login
        $stmt = $conn->prepare("SELECT id FROM admins WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id);
            $stmt->fetch();
            $_SESSION['admin'] = true;
            header("Location: admin\dashboard.php");
        } else {
            $error = "Invalid username or password for admin!";
        }
    } else {
        $error = "Invalid role selected!";
    }
}
?>



<?php
if (isset($error)) {
    // echo "<p style='color: red;'>$error</p>";
    // echo "<script type='text/javascript'>alert('$error');</script>";
    echo "<script type='text/javascript'>
           window.onload = function() {
               alert('$error');
           }
       </script>";


}
?>

<!-- <form method="POST" action="">
    
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <select name="role" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br>
    
    <button type="submit">Login</button>
</form> -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="sandu.css" />
    <title>Document</title>
  </head>
  <body>

  <div class="lgnMain">
     <div class="lgmh1"> <img src="img/Royal Trust Bank (1).png" alt=""><h1>Royal Trust Bank <span>Seamless Banking for a Digital World</span> </h1></div>
      <div class="lg1">
        <h1> Login</h1>
     
        <div class="lgfrm">
          <form method="POST" action="">
            <label for="name">User Name</label><br />
            <input
              type="text"
              name="username"
              placeholder="  "
              required
            /><br />
            <label for="name">Password</label><br />
            <input
              type="password"
              name="password"
              placeholder=" "
              required
            /><br />
            <label for=""><a href="test.html">Forgot Password</a></label>
            <br />

            <label for="role">Select Your Role</label>

            <select name="role" required>
              <option value="user">User</option>
              <option value="admin">Admin</option></select
            ><br />

            <button type="submit">Login</button>
          </form>
        </div>
      </div>
    <div class="lg2">
<div class="lg2sub">
 
  <video class="v1" autoplay loop muted>
    <source src="img/1.mp4" type="video/mp4">
</video>
</div>
<div class="lg2sub">
 
  <video class="v2" autoplay loop muted>
    <source src="img/2.mp4" type="video/mp4">
</video>
</div>
<div class="lg2sub">

  <video class="v3" autoplay loop muted>
    <source src="img/3.mp4" type="video/mp4">
</video>
</div>

    </div>
    </div>
    <?php include 'footer.php'; ?>
    </body>
    </html>