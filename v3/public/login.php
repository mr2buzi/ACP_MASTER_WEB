<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css_login/form.css">
</head>
<body>
    <form method="post" action="login.php">
    <div class="form">
        <h1 class="heading">Login</h1>
        <input type="email" placeholder="email" autocomplete="off" class="email" required name="username">
        <input type="password" placeholder="password" autocomplete="off" class="password" required name="password" >
    <button class="submit-btn" name="loginbtn">Log In</button>
    <a href="sign_up.php" src="sign_up.php" class=link> Sign Up</a>
    </div>
    </form>

        <script src="js_login/form.js"></script>
    
</body>                                                                                                                                                        
</html>
<!--
<?php
$conn = mysqli_connect("localhost", "root","");
if(isset($_POST['loginbtn']))
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql= "SELECT * FROM login.login_deets WHERE username = '$username'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $resultPassword = $row['password'];
        if($password == $resultPassword){
            header('Location:index.html');
        }else{
            echo "<script>
                alert('Login unsuccessful)
            </script>";
        }
    }

?>