<?php
    session_start();
    include("../utility/db_conn.php");
    include("../utility/misc.php");

    if(isset($_POST["add-candidate"])){
        $candidate_first_name = validate_data($_POST["candidate-first-name"]);
        $candidate_last_name = validate_data($_POST["candidate-last-name"]);
        $candidate_index_number = validate_data($_POST["candidate-index-number"]);
        $candidate_position = validate_data($_POST["candidate-position"]);
        $candidate_level = validate_data($_POST["candidate-level"]);
        $candidate_gender = validate_data($_POST["candidate-gender"]);
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
    <title>Administrator Panel | Online Voting Portal</title>
</head>
<body>
    <div class="w-full bg-blue-200 min-h-screen p-10">
       <div class="absolute inset-8 bg-blue-50 rounded-3xl shadow-xl p-5">
        <button id="candidate-form-open" class="bg-blue-500 w-48 text-blue-50 py-1 pb-2 text-lg shadow-md rounded-full capitalize font-semibold  mb-4 hover:bg-blue-700 cursor-pointer">Add Candidate</button>
       </div>
       <div id="candidate-form" class="absolute inset-0 bg-blue-50 bg-opacity-80 z-10 justify-center items-center hidden">
            <p id="candidate-form-close" class=" absolute top-6 left-6 bg-white rounded-full shadow-md w-12 h-12 flex justify-center items-center cursor-pointer hover:bg-blue-100">
                <i class="fas fa-times fa-lg text-blue-500"></i>
            </p>
            <form class="bg-white lg:w-3/12 md:w-5/12 w-8/12 px-5 pt-6 pb-6 flex flex-col justify-center items-center    rounded-3xl shadow-xl" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <h1 class="w-full text-center mb-3 uppercase font-bold text-lg tracking-tighter text-gray-600">Add Candidate</h1>
                <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                        <i class="fas fa-user mx-4"></i>
                        <input class="w-full outline-none bg-blue-100" id="candidate-first-name" placeholder="Enter candidate first name" name="candidate-first-name" type="text" autocomplete="off" required>
                </div>
                <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                        <i class="fas fa-user mx-4"></i>
                        <input class="w-full outline-none bg-blue-100" id="candidate-last-name" placeholder="Enter candidate last name" name="candidate-last-name" type="text" autocomplete="off" required>
                </div>
                <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                        <i class="fas fa-user mx-4"></i>
                        <input class="w-full outline-none bg-blue-100" id="candidate-index-number" placeholder="Enter candidate index number" name="candidate-index-number" type="text" autocomplete="off" required>
                </div>
                <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                        <i class="fas fa-user mx-4"></i>
                        <input class="w-full outline-none bg-blue-100" id="candidate-position" placeholder="Enter candidate position" name="candidate-position" type="text" autocomplete="off" required>
                </div>
                <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                        <i class="fas fa-user mx-4"></i>
                        <input class="w-full outline-none bg-blue-100" id="candidate-level" placeholder="Enter candidate level" name="candidate-level" type="text" autocomplete="off" required>
                </div>
                <div class="overflow-hidden rounded-full py-2 px-4 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                    <select class="w-full outline-none bg-blue-100" name="candidate-gender" id="candidate-gender" required>
                        <option>Select gender</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>
                <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                        <input class="w-full outline-none px-4 bg-blue-100" id="candidate-image" name="candidate-image" type="file" autocomplete="off" required>
                </div>
                <span class="text-red-600"><?php //echo $password_error; ?></span>
                <span class="text-red-600"><?php //echo $user_security_question_error; ?></span>
                <span class="text-red-600"><?php //echo $new_voter_error; ?></span>
                <span class="text-green-600"><?php //echo $new_voter_success; ?></span>
                <input class="bg-blue-500 w-2/3 text-blue-50 py-1 pb-2 text-lg shadow-sm rounded-full capitalize font-semibold mt-1 mb-4 hover:bg-blue-700 cursor-pointer" type="submit" value="add candidate" name="add-candidate">
            </form> 
       </div>
    </div>
    <script src="../js/all.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>