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
    <div class="container">
        <div class="account">
            <div class="headers">
                <h1>Se connecter </h1>
                <h1 class="header-inactive">S'inscrire </h1>
            </div>
            <div class="tabs">
                <div class="tab" id="tab-1">
                   <div class="inner">
                    <h1>Connexion</h1>
                    <input name="email" type="email" placeholder="Adresse e-mail"/>
                    <input name="password" type="password" placeholder="Mot de passe"/>
                    <button name="login">Se Connecter</button>
                    <a onclick="ForgotPassword()">Mot de passe oublié ?</a>
                   </div>
                </div>
                <div class="tab" id="tab-2">
                    <div class="inner">
                    <h1>Inscription</h1>
                    <input type="email" placeholder="E-mail"/>
                    <input type="password" placeholder="Mot de passe"/>
                    <input type="password" placeholder="Confirme ton MDP "/>
                    <button>S'inscrire</button>
                    <div style="height:30px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="forgot-password">
            <div class="inner">
                <img src="assets/images/close.png"/>
                <h1>Récupérer le mot de passe</h1>
                <input type="email" placeholder="Adresse E-mail"/>
                <button>Récupérer le mot de passe</button>
            </div>
        </div>
    </div>
    <script src="assets/scripts/script.js"></script>
    <?php
        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $servername = "localhost";
            $username = "root";
            $pass = "";
            $dbname = "DB";
            $conn = new mysqli($servername, $username, $pass, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "select * from Users where email like '".Decrypt($email)."' and password like '".
            Decrypt($password)."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                session_start();
                $_SESSION['user'] = Encrypt($email);
                echo "<script>window.location.href='acceuil.php'</script>";
            } else {
                
            }
            $conn->close();
        }
        function Decrypt($str){
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $decryption_iv = '1234567891011121';
            $decryption_key = "@FTT123";
            $decryption=openssl_decrypt ($str, $ciphering, 
                $decryption_key, $options, $decryption_iv);
            return $decryption
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