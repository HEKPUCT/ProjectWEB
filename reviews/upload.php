<pre>

<?php
$ran = rand(0000, 9999);
$ran1 = rand(0000, 9999);
$description ='';
$userId = 1;

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "seeds";


    if (isset($_POST['discription']))
    {
        $description = htmlspecialchars($_POST['discription']);
    }



// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $dateToday = date("Y-m-d H:i:s");
    $sql = "INSERT INTO review (dateReview, description, idUser) VALUES ('$dateToday', '$description'), '$userId')";
    if ($conn->query($sql) === TRUE) {
        echo " <br> New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

header( 'Location: reviews.php', true, 301 );
?>


</pre>