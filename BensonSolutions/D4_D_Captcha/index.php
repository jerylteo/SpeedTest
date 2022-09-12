<?php 
if(isset($_POST['captcha'])) {
    session_start();
    $string = strtoupper($_SESSION['captcha']);
    $userstring = strtoupper($_POST['captcha']); 
    session_destroy();   

    if ($string == $userstring) {
        header("Location: success.html");
        exit();
    } else {
        header("Location: failure.html");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Captcha</title>
</head>
<body>

    <form action="" method="POST">
        <div>
            <img src="captcha_code2.php" />
        </div>
        Type the text:<br>
        <input type="text" id="captcha" name="captcha">
        <button>Submit</button>
    </form>
    
</body>
</html>