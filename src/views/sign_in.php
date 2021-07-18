<?php
    session_start();
    include("../utility/db_conn.php");
    include("../utility/misc.php");

    $index_number_error = "";
    $password_error = "";

    if(isset($_POST["sign-in"])){
        $user_index_number = validate_data($_POST["user-index-number"]);
        $user_password = validate_data($_POST["user-password"]);

        $sql = "SELECT * FROM voters WHERE `index_number` = '$user_index_number'";
        $result = $conn->query($sql);

        if($result != false && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($user_password == $row["password"]){
                    $_SESSION["index_number"] = $row["index_number"];
                    $_SESSION["voter_id"] = $row["id"];
                    $_SESSION["name"] = $row["first_name"];
                    header("Location: dashboard.php");
                }else{
                    $password_error = "Password isn't correct, try again";
                }
            }
        }else{
            $index_number_error = "Index number doesn't exist, try again";
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
    <title>Sign In | Online Voting Portal</title>
</head>
<body>
    <div class="w-full bg-blue-200 h-screen flex justify-center items-center">
       <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="bg-blue-50 lg:w-3/12 md:w-5/12 w-8/12 px-5 pt-14 pb-8 flex flex-col justify-center items-center rounded-3xl shadow-xl">
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user fa-lg mx-4"></i>
                <input class="w-full outline-none bg-blue-100" id="user-index-number" placeholder="Enter Index Number" name="user-index-number" type="text" autocomplete="off" required>
           </div>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user-lock fa-lg mx-4"></i>
                <input class="w-full outline-none bg-blue-100" name="user-password" id="user-password" type="password" placeholder="Enter password" required>
           </div>
           <span class="text-red-600"><?php echo $index_number_error; ?></span>
           <span class="text-red-600"><?php echo $password_error; ?></span>
           <input class="bg-blue-500 w-6/12 text-blue-50 py-1 pb-2 text-lg shadow-sm rounded-full capitalize font-semibold  mb-4 hover:bg-blue-700 cursor-pointer" name="sign-in" type="submit" value="Sign in">
           <div class="w-min">
                <a href="./verfication.php" class="text-gray-400 text-base tracking-tighter hover:text-gray-600 hover:underline">Forgot&nbsp;password?</a>
            </div>
       </form> 
    </div>
    <script src="../js/all.js"></script>
</body>
</html>