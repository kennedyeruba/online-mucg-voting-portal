<?php
    session_start();
    include("../utility/db_conn.php");
    include("../utility/misc.php");

    $index_number_error = "";
    $security_question_error = "";
    $security_answer_error = "";
    $password_update_success = "";
    $password_update_error = "";

    if(isset($_POST["verify-sub"])){
        $user_index_number = validate_data($_POST["user-index-number"]);
        $user_security_question = validate_data($_POST["user-security-question"]);
        $user_security_answer = validate_data($_POST["user-security-answer"]);
        $user_new_password = validate_data($_POST["user-new-password"]);

        $sql = "SELECT * FROM voters WHERE `index_number` = '$user_index_number'";
        $result = $conn->query($sql);

        if($result != false && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($user_security_question == $row["security_question"]){
                    if($user_security_answer == $row["security_answer"]){
                        $sql = "UPDATE voters SET password='$user_new_password' WHERE `index_number` = '$user_index_number'";

                        if ($conn->query($sql) === TRUE) {
                            $password_update_success = "New password set successfully.";
                        } else {
                            $password_update_error = "Could not set new password, try again.";
                        }
                    }else{
                        $security_answer_error = "Security answer isn't correct, try again.";
                    }
                }else{
                    $security_question_error = "Security question isn't correct, try again.";
                }
            }
        }else{
            $index_number_error = "Index number doesn't exist, try again.";
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
    <title>Verification | Online Voting Portal</title>
</head>
<body>
    <div class="w-full bg-blue-200 h-screen flex justify-center items-center">
       <form class="bg-blue-50 lg:w-3/12 md:w-5/12 w-8/12 px-5 pt-14 pb-8 flex flex-col justify-center items-center rounded-3xl shadow-xl" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
       <h1 class="w-full text-center mb-3 uppercase font-bold text-lg tracking-tighter text-gray-600">verfication</h1>
            <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user fa-lg mx-4"></i>
                <input class="w-full outline-none bg-blue-100" id="user-index-number" placeholder="Enter Index Number" name="user-index-number" type="text" autocomplete="off" required>
           </div>
           <div class="overflow-hidden rounded-full py-2 px-4 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <select class="w-full outline-none bg-blue-100" name="user-security-question" id="user-security-question" required>
                    <option>Select security question</option>
                    <option value="Mother's Name">Mother's Name</option>
                    <option value="Favourite Food">Favourite Food</option>
                    <option value="Favourite Color">Favourite Color</option>
                </select>
           </div>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <input class="w-full outline-none px-4 bg-blue-100" id="user-security-answer" placeholder="Enter answer" name="user-security-answer" type="text" autocomplete="off" required>
           </div>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user-lock fa-lg mx-4"></i>
                <input class="w-full outline-none bg-blue-100" id="user-new-password" name="user-new-password" type="password" placeholder="Enter new password" required>
           </div>
           <span class="text-red-600"><?php echo $index_number_error; ?></span>
           <span class="text-red-600"><?php echo $security_question_error; ?></span>
           <span class="text-red-600"><?php echo $security_answer_error; ?></span>
           <span class="text-red-600"><?php echo $password_update_error; ?></span>
           <span class="text-green-600"><?php echo $password_update_success; ?></span>
           <input class="bg-blue-500 w-6/12 text-blue-50 py-1 pb-2 text-lg shadow-sm rounded-full capitalize font-semibold  mb-4 hover:bg-blue-700 cursor-pointer" type="submit" value="Verify" name="verify-sub">
       </form> 
    </div>
    <script src="../js/all.js"></script>
</body>
</html>