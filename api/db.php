<?
function connectToDB(){
    $servername = "localhost";
    $database = "t937836o_memes";
    $username = "t937836o_memes";
    $password = "iidVrgtf";  

    $conn = mysqli_connect($servername, $username, $password, $database);
     if (!$conn) {
     die(theError("db_error"));
}
    return $conn;
}

?>