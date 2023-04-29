<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="assets/style/main.css">
</head>
<body>
    <form method="POST" target="_self">
    <div class="scrollable">
        <div class="signup">
            <h1>Inscris-toi rapidement</h1>
            <input type="email" name="email" placeholder="Adresse e-mail"/>
            <input type="password" name="password" placeholder="Mot de passe"/>
            <input type="password" name="password2" placeholder="Confirme ton MDP"/>
            <input type="text" name="firstname" placeholder="Ton prénom"/>
            <input type="text" name="lastname" placeholder="Ton nom"/>
            <div class="checkbox">
                <input type="checkbox"/> 
                <label>J'accepte les <strong>conditions d'utilisation</strong></label>
            </div>
            <div class="bar" onclick="Select(0)">
                <img src="assets/images/school.png"/>
                <a id="ecole">Choisis ton école</a>
            </div>
            <div class="bar" onclick="Select(1)">
                <img src="assets/images/book.png"/>
                <a id="spec">Choisis ta spécialité</a>
            </div>
            <div class="bar" onclick="Select(2)">
                <img src="assets/images/star.png"/>
                <a id="grade">Choisis ton niveau d'étude</a>
            </div>
            <input name="tel" style="margin-top: 30px;" type="text" placeholder="N° de téléphone"/>
            <button onclick="SubmitForm()">Activer mon compte</button>
            <button name="activer" id="activer" hidden></button>
            <div class="checkbox" style="justify-content: center; margin-bottom: 50px;">
                <label>Vous avez déjà un compte? <strong style="cursor: pointer;" onclick="window.location='account.html'">Connectez-vous ici</strong></label>
            </div>
        </div>
        <div class="selection">
            <div class="inner">

            </div>
        </div>
    </div>
    <script src="assets/scripts/script.js"></script>
    <?php
    if(isset($_POST['activer'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $ecole = $_COOKIE['ecole'];
        $spec = $_COOKIE['spec'];
        $grade = $_COOKIE['grade'];
        $tel = $_POST['tel'];



        $servername = "localhost";
        $username = "root";
        $pass = "";
        $dbname = "DB";
        $conn = new mysqli($servername, $username, $pass, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO Users(email,password,firstname,lastname,ecole,spec,grade,tel) Values('".Encrypt($email)."',
        '".Encrypt($password)."','".Encrypt($firstname)."','".Encrypt($lastname)."','".Encrypt($ecole)
        ."','".Encrypt($spec)."','".Encrypt($grade)."','".Encrypt($tel)."')";

        if ($conn->query($sql) === TRUE) {
            session_start();
            $_SESSION['user'] = Encrypt($email);
            echo "<script>window.location.href='acceuil.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    function Encrypt($str){
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = "@FTT123";
        $encryption = openssl_encrypt($str, $ciphering,
            $encryption_key, $options, $encryption_iv);
        return $encryption;
    }
    ?>
</form>
</body>
</html>