<?php
     include("../utility/db_conn.php");
     include("../utility/misc.php");

     $user_index_number_error = "";
     $password_error = "";
     $user_security_question_error = "";
     $new_voter_success = "";
     $new_voter_error = "";

     if(isset($_POST["register-sub"])){
          // $user_first_name = validate_data($_POST["user-first-name"]);
          // $user_last_name = validate_data($_POST["user-last-name"]);
          $user_index_number = validate_data($_POST["user-index-number"]);
          $user_security_question = validate_data($_POST["user-security-question"]);
          $user_security_answer = validate_data($_POST["user-security-answer"]);
          $user_password = validate_data($_POST["user-password"]);
          $user_password_confirm = validate_data($_POST["user-password-confirm"]);
          
          $sql = "SELECT * FROM `mucg_db` WHERE `index_number` = '$user_index_number'";
          $result = $conn->query($sql);

          if($result != false && $result->num_rows > 0){
               while($row = $result->fetch_assoc()){
                    $user_first_name = $row["first_name"];
                    $user_last_name = $row["last_name"];
               }

               if($user_security_question == "Select security question"){
                    $user_security_question_error = "Please select valid question.";
               }else{
                    if($user_password != $user_password_confirm){
                         $password_error = "Password doesn't match, try again.";
                    }else{
          
                         if(prepare_bind_insert_voter($user_first_name, $user_last_name, $user_index_number, $user_security_question, $user_security_answer, $user_password)){
                              $new_voter_success = "New voter added successfully.";
                         }else{
                              $new_voter_error = "Operation could not be completed, try again.";
                         }
                    }
               }
          }else{
               $user_index_number_error = "Index number doesn't exist, try again.";
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
    <title>Register | Online Voting Portal</title>
</head>
<body>
    <div class="w-full bg-blue-200 h-screen flex justify-center items-center">
       <form class="bg-blue-50 lg:w-3/12 md:w-5/12 w-8/12 px-5 pt-14 pb-8 flex flex-col justify-center items-center rounded-3xl shadow-xl" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <h1 class="w-full text-center mb-3 uppercase font-bold text-lg tracking-tighter text-gray-600">Register</h1>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user mx-4"></i>
                <input class="w-full outline-none bg-blue-100" id="user-index-number" placeholder="Enter Index Number" name="user-index-number" type="text" autocomplete="off" required>
           </div>
           <div class="overflow-hidden rounded-full py-2 px-4 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <select class="w-full outline-none bg-blue-100" name="user-security-question" id="user-security-question" required>
                    <option>Select security question</option>
                    <option value="mother's name">Mother's Name</option>
                    <option value="favourite food">Favourite Food</option>
                    <option value="favourite color">Favourite Color</option>
                </select>
           </div>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <input class="w-full outline-none px-4 bg-blue-100" id="user-security-answer" placeholder="Enter answer" name="user-security-answer" type="text" autocomplete="off" required>
           </div>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user-lock fa-lg mx-4"></i>
                <input class="w-full outline-none bg-blue-100" id="user-password" name="user-password" type="password" placeholder="Enter password" required>
           </div>
           <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                <i class="fas fa-user-lock fa-lg mx-4"></i>
                <input class="w-full outline-none bg-blue-100" id="user-password-confirm" name="user-password-confirm" type="password" placeholder="Confirm password" required>
           </div>
           <span class="text-red-600"><?php echo $user_index_number_error; ?></span>
           <span class="text-red-600"><?php echo $password_error; ?></span>
           <span class="text-red-600"><?php echo $user_security_question_error; ?></span>
           <span class="text-red-600"><?php echo $new_voter_error; ?></span>
           <span class="text-green-600"><?php echo $new_voter_success; ?></span>
           <input class="bg-blue-500 w-6/12 text-blue-50 py-1 pb-2 text-lg shadow-sm rounded-full capitalize font-semibold mt-1 mb-4 hover:bg-blue-700 cursor-pointer" type="submit" value="Register" name="register-sub">
       </form> 
    </div>
    <script src="../js/all.js"></script>
</body>
</html>