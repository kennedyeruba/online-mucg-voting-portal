<?php
    session_start();
    include("../utility/db_conn.php");
    include("../utility/misc.php");

    $admin_username_error = "";
    $admin_password_error = "";

    if(isset($_POST["admin-sign-in"])){
        $admin_username = validate_data($_POST["admin-username"]);
        $admin_password = validate_data($_POST["admin-password"]);

        $sql = "SELECT * FROM `admin` WHERE `username` = '$admin_username'";
        $result = $conn->query($sql);

        if($result != false && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($admin_password == $row["password"]){
                    $_SESSION["admin-username"] = $row["username"];
                    header("Location: admin_panel.php");
                }else{
                    $admin_password_error = "Password isn't correct, try again";
                }
            }
        }else{
            $admin_username_error = "Username doesn't exist, try again";
        }
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dist/style.css">
    <link rel="stylesheet" href="../css/dist/all.css">
    <title>Administrator Sign In | Online Voting Portal</title>
</head>
<body>
    <div class="w-full bg-blue-200 h-screen flex justify-center items-center">
       <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="bg-blue-50 lg:w-3/12 md:w-5/12 w-8/12 px-5 pt-14 pb-8 flex flex-col justify-center items-center rounded-3xl shadow-xl">
            <h1 class="w-full text-center mb-3 uppercase font-bold text-lg tracking-tighter text-gray-600">Admin Sign In</h1>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user fa-lg mx-4"></i>
                <input class="w-full outline-none bg-blue-100" id="admin-username" placeholder="Enter username" name="admin-username" type="text" autocomplete="off" required>
           </div>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user-lock fa-lg mx-4"></i>
                <input class="w-full outline-none bg-blue-100" name="admin-password" id="admin-password" type="password" placeholder="Enter password" required>
           </div>
           <span class="text-red-600"><?php echo $admin_username_error; ?></span>
           <span class="text-red-600"><?php echo $admin_password_error; ?></span>
           <input class="bg-blue-500 w-6/12 text-blue-50 py-1 pb-2 text-lg shadow-sm rounded-full capitalize font-semibold  mb-4 hover:bg-blue-700 cursor-pointer" name="admin-sign-in" type="submit" value="Sign in">
       </form> 
    </div>
    <script src="../js/all.js"></script>
</body>
</html>