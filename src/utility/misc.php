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

    //CLEAR SESSION BEFORE LOGGING OUT
    function log_out(){
        session_unset();
        session_destroy();
    }
?>