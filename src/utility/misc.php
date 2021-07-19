<?php
    function validate_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //INSERT VOTER INTO VOTERS TABLE
    function prepare_bind_insert_voter($user_first_name, $user_last_name, $user_index_number, $user_security_question, $user_security_answer, $user_password){
        
        global $conn;
        //PREPARE STATMENT
        $prepared_stmt = $conn->prepare("INSERT INTO voters (`first_name`, `last_name`, `index_number`, `security_question`, `security_answer`, `password`) VALUES (?, ?, ?, ?, ?, ?)");

        //BIND PARAMETERS
        $prepared_stmt->bind_param("ssssss", $first_name, $last_name, $index_number, $security_question, $security_answer, $password);

        //ASSIGN VALUES TO PARAMETERS
        $first_name = $user_first_name;
        $last_name = $user_last_name; 
        $index_number = $user_index_number;
        $security_question = $user_security_question;
        $security_answer = $user_security_answer;
        $password = $user_password;

        //EXECUTE PREPARED STATEMENT
        $prepared_stmt->execute();

        return true;
    }

    //INSERT VOTER INTO VOTERS TABLE
    function prepare_bind_insert_candidate($candidate_first_name, $candidate_last_name, $candidate_index_number, $candidate_position, $candidate_gender, $candidate_level, $candidate_image){
        
        global $conn;
        //PREPARE STATMENT
        $prepared_stmt = $conn->prepare("INSERT INTO candidates (`first_name`, `last_name`, `index_number`, `position`, `gender`, `level`, `image`) VALUES (?, ?, ?, ?, ?, ?, ?)");

        //BIND PARAMETERS
        $prepared_stmt->bind_param("sssssss", $first_name, $last_name, $index_number, $position, $gender, $level, $image);

        //ASSIGN VALUES TO PARAMETERS
        $first_name = $candidate_first_name;
        $last_name = $candidate_last_name; 
        $index_number = $candidate_index_number;
        $position = $candidate_position;
        $gender = $candidate_gender;
        $level = $candidate_level;
        $image = $candidate_image;

        //EXECUTE PREPARED STATEMENT
        $prepared_stmt->execute();

        return true;
    }
    
    function getCandidate($position){
        global $conn;
        $sql = "SELECT * FROM `candidates` WHERE `position` = '$position'";
        $result = $conn->query($sql);
    }

    //CLEAR SESSION BEFORE LOGGING OUT
    function log_out(){
        session_unset();
        session_destroy();
    }
?>