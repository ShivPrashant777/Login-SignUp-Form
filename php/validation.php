<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Page</title>
</head>
<body>
    <?php 
    require_once "config.php";

        $email = $pass = $pass_repeat = "";

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email_err = "Invalid Email";
                echo $email_err;
            }
            $pass = test_input($_POST["pass"]);
            $pass_repeat = test_input($_POST["pass_repeat"]);
        }
        
        
        $sql = "INSERT INTO loginInfo
        VALUES('$email', '$pass')";

        if ($pass == $pass_repeat) {
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else {
            echo "Password did not match ";
        }
        $conn->close();

    ?>
</body>
</html>