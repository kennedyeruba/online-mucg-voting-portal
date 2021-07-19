<?php
    session_start();
    include("../utility/db_conn.php");
    include("../utility/misc.php");

    $candidate_first_name = "";
    $candidate_last_name = "";
    $candidate_gender = "";
    $candidate_level = "";

    //Notifiers
    $candidate_index_number_error = "";
    $new_candidate_success = "";
    $new_candidate_failure = "";
    $statusMsg = "";

    if(isset($_POST["add-candidate"])){
        $candidate_index_number = validate_data($_POST["candidate-index-number"]);
        $candidate_position = validate_data($_POST["candidate-position"]);

        $sql = "SELECT * FROM `mucg_db` WHERE `index_number` = '$candidate_index_number'";
        $result = $conn->query($sql);

        if($result != false && $result->num_rows > 0){
            if(!empty($_FILES["candidate-image"]["name"])){
                // Get file info 
                $fileName = basename($_FILES["candidate-image"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType, $allowTypes)){
                    $image = $_FILES['candidate-image']['tmp_name']; 
                    $candidate_image_content = addslashes(file_get_contents($image));

                    while($row = $result->fetch_assoc()){
                        $candidate_first_name = $row["first_name"];
                        $candidate_last_name = $row["last_name"];
                        $candidate_gender = $row["gender"];
                        $candidate_level = $row["level"];
                    }

                    if(prepare_bind_insert_candidate($candidate_first_name, $candidate_last_name, $candidate_index_number, $candidate_position, $candidate_gender, $candidate_level, $candidate_image_content)){
                        $new_candidate_success = "New candidate added.";
                    }else{
                        $new_candidate_failure = "Error adding candidate, try again.";
                    }
                }else{ 
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                }
            }else{ 
                $statusMsg = 'Please select an image file to upload.'; 
            }
        }else{
            $candidate_index_number_error = "Index number doesn't exist";
        }
    }
    // $conn->close();
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
    <style>
        *::-webkit-scrollbar{
            width: 8px;
        }
        *::-webkit-scrollbar-thumb{
            border-radius: 10px;
            background: rgba(0,0,0,0.5);
        }
        *::-webkit-scrollbar-track{
            width: 8px;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            border-radius: 20px;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <div class="w-full bg-blue-200 min-h-screen p-10">
       <div class="absolute inset-8 bg-blue-50 rounded-3xl shadow-xl p-5">
        <button id="candidate-form-open" class="bg-blue-500 w-48 text-blue-50 py-1 pb-2 text-lg shadow-md rounded-full capitalize font-semibold  mb-4 hover:bg-blue-700 cursor-pointer">Add Candidate</button>
        <h1 class="absolute top-5 right-5 uppercase text-lg font-bold">Admin Panel</h1>
        <div class="w-full overflow-y-scroll h-4/5 shadow-inner rounded-md">
            <table>
                <tr>
                    <th>Index Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Position</th>
                    <th>Gender</th>
                    <th>Level</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM `candidates`";
                    $result = $conn->query($sql);
                    if($result != false && $result->num_rows > 0){

                    while($row = $result->fetch_assoc()) {
                ?>
                    <tr class="capitalize">
                        <td><?php echo $row["index_number"]; ?></td>
                        <td><?php echo $row["first_name"]; ?></td>
                        <td><?php echo $row["last_name"]; ?></td>
                        <td><?php echo $row["position"]; ?></td>
                        <td><?php echo $row["gender"]; ?></td>
                        <td><?php echo $row["level"]; ?></td>
                    </tr>
                <?php }} ?>
            </table>
        </div>
       </div>

       <div id="candidate-form" class="absolute inset-0 bg-blue-50 bg-opacity-80 z-10 justify-center items-center hidden">
            <p id="candidate-form-close" class=" absolute top-6 left-6 bg-white rounded-full shadow-md w-12 h-12 flex justify-center items-center cursor-pointer hover:bg-blue-100">
                <i class="fas fa-times fa-lg text-blue-500"></i>
            </p>
            <form class="bg-white lg:w-3/12 md:w-5/12 w-8/12 px-5 pt-6 pb-6 flex flex-col justify-center items-center    rounded-3xl shadow-xl" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <h1 class="w-full text-center mb-3 uppercase font-bold text-lg tracking-tighter text-gray-600">Add Candidate</h1>
                <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                        <i class="fas fa-user mx-4"></i>
                        <input class="w-full outline-none bg-blue-100" id="candidate-index-number" placeholder="Enter candidate index number" name="candidate-index-number" type="text" autocomplete="off" required>
                </div>
                <div class="overflow-hidden rounded-full py-2 px-4 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                    <select class="w-full outline-none bg-blue-100" name="candidate-position" id="candidate-position">
                        <option>Select candidate position</option>
                        <option value="president">President</option>
                        <option value="vice president">Vice President</option>
                        <option value="general secretary">General Secretary</option>
                        <option value="src treasurer">SRC Treasurer</option>
                        <option value="src pusug president">SRC Pusug President</option>
                        <option value="src women's commissioner">SRC Women's Commissioner</option>
                    </select>
                </div>
                <div class="overflow-hidden rounded-full py-2 bg-blue-100 w-full mb-5 shadow-inner flex items-center">
                        <input class="w-full outline-none px-4 bg-blue-100" id="candidate-image" name="candidate-image" type="file" autocomplete="off">
                </div>
                <span class="text-red-600"><?php echo $candidate_index_number_error; ?></span>
                <span class="text-red-600"><?php echo $statusMsg; ?></span>
                <span class="text-red-600"><?php echo $new_candidate_failure; ?></span>
                <span class="text-green-600"><?php echo $new_candidate_success; ?></span>
                <input class="bg-blue-500 w-2/3 text-blue-50 py-1 pb-2 text-lg shadow-sm rounded-full capitalize font-semibold mt-1 mb-4 hover:bg-blue-700 cursor-pointer" type="submit" value="add candidate" name="add-candidate">
            </form> 
       </div>
    </div>
    <script src="../js/all.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>