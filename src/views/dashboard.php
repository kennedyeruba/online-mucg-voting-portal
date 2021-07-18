<?php
    session_start();
    // if(isset($_SESSION("index_number") == false)){
    //     header("Location: sign_up.php");
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dist/style.css">
    <link rel="stylesheet" href="../css/dist/all.css">
    <title>Vote | Online Voting Portal</title>
</head>
<body>
    <div class="w-full bg-blue-200 min-h-screen pt-3 pb-7">
       <div class="w-4/5 m-auto bg-white h-12 flex justify-center items-center rounded-xl shadow-lg">
           <h1 class="uppercase text-2xl tracking-wider font-bold">Welcome <?php echo $_SESSION["name"]?>, vote for desired candidates</h1>
       </div>
       <!--Candidates Container-->
       <div class="w-full mt-5 px-7">
           <h1 class="rounded-xl mt-10 mb-3 text-center font-bold bg-blue-50 text-gray-900 py-1 text-xl uppercase">President</h1>
           <!--Candidates Container inner-->
           <div class="w-full bg-white rounded-2xl shadow-inner py-3 px-1 flex justify-start items-center">
                <!--Candidate-->
                <div class="h-72 w-60 bg-blue-200 rounded-2xl mx-2 shadow-md pt-2 px-2">
                    <img class="mx-auto h-2/5 rounded-full shadow-md" src="../images/male.jpg" alt="">
                    <div class="h-3/6 bg-white w-full mt-4 rounded-xl shadow-md p-2">
                        <p><span class="font-bold">Name: </span> <span class="font-semibold">John Doe</span></p>
                        <p><span class="font-bold">Level: </span> <span class="font-semibold">400</span></p>
                        <p><span class="font-bold">Position: </span> <span class="font-semibold">President</span></p>
                        <p>
                            <span class="font-bold">Select: </span>
                            <input class="ml-3 transform translate-y-1/4 w-4 h-4" type="radio" name="president">
                        </p>
                    </div>
                </div>
                <!--Candidate-->
                <div class="h-72 w-60 bg-blue-200 rounded-2xl mx-2 shadow-md pt-2 px-2">
                    <img class="mx-auto h-2/5 rounded-full shadow-md" src="../images/female.jpg" alt="">
                    <div class="h-3/6 bg-white w-full mt-4 rounded-xl shadow-md p-2">
                        <p><span class="font-bold">Name: </span> <span class="font-semibold">Jane Doe</span></p>
                        <p><span class="font-bold">Level: </span> <span class="font-semibold">300</span></p>
                        <p><span class="font-bold">Position: </span> <span class="font-semibold">President</span></p>
                        <p>
                            <span class="font-bold">Select: </span>
                            <input class="ml-3 transform translate-y-1/4 w-4 h-4" type="radio" name="president">
                        </p>
                    </div>
                </div>
                <!--Candidate-->
                <div class="h-72 w-60 bg-blue-200 rounded-2xl mx-2 shadow-md pt-2 px-2">
                    <img class="mx-auto h-2/5 rounded-full shadow-md" src="../images/female.jpg" alt="">
                    <div class="h-3/6 bg-white w-full mt-4 rounded-xl shadow-md p-2">
                        <p><span class="font-bold">Name: </span> <span class="font-semibold">Jane Doe</span></p>
                        <p><span class="font-bold">Level: </span> <span class="font-semibold">300</span></p>
                        <p><span class="font-bold">Position: </span> <span class="font-semibold">President</span></p>
                        <p>
                            <span class="font-bold">Select: </span>
                            <input class="ml-3 transform translate-y-1/4 w-4 h-4" type="radio" name="president">
                        </p>
                    </div>
                </div>
           </div>
       </div>
       <div class="flex justify-center items-center my-10">
       <input class="bg-blue-500 w-28 text-blue-50 py-1 pb-2 text-lg shadow-sm rounded-full capitalize font-semibold  mb-4 hover:bg-blue-700 cursor-pointer" name="vote-candidates" type="submit" value="vote">
       </div>
    </div>
    <script src="../js/all.js"></script>
</body>
</html>