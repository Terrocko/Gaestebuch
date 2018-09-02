<head>
  <link rel="stylesheet" href="styles.css">
</head>
<body style="background-color:#EDEDE4" onload="formular.reset();">
    <form method="post" id="formular">
        <input type="text" name="name" id="name" minlength="3" maxlength="40" placeholder="Name" required>
        <br>
        <input type="email" name="email" id="email" maxlength="20" placeholder="E-Mail Adresse" required>
        <br>
        <textarea id="message" name="message" placeholder="Deine Nachricht"
                  rows="3" cols="33" minlength="10" maxlength="250" required
                  wrap="hard"></textarea>
        <br>
        <br>
        <input type="submit" name="submit" value="Eintragen" id="submit">
    </form>

<?php

$file = "gaestebuch.txt";


if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $msg = $_POST["message"];
    $log = "<div><fieldset><legend>" . date("d.m.Y H:i:s") .
    "</legend>\r\n<a href=" . "$email" . ">$name</a> schrieb:" .
    "\r\n<br><br>$msg\r\n</fieldset></div><br>\r\n\r\n\r\n";

    if (file_exists($file)) {
        $handle = fopen($file, "r");
        $temp = fread($handle, filesize($file));
        $handle = fopen($file, 'w');
        fwrite($handle, $log);
        fwrite($handle, $temp);
        fclose($handle);
        echo $log . $temp;
    } else {
        $handle = fopen($file, "w+");
        fwrite($handle, $log);
        fclose($handle);
        echo $log;
    }
} else {
    if (file_exists($file)) {
        $handle = fopen($file, "r");
        $temp = fread($handle, filesize($file));
        fclose($handle);
        echo $temp;
    }
}

?>
