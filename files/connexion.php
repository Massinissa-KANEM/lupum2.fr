<?php include '../includes/head.php' ?>
<title>Connexion</title>
<script src="../js/transition.js"></script>
<link href="../CSSs/connexion.css" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
    <body class="text-center">

        <main>
            <div class="bloc">
                <h3 class="hello">content de vous revoir !</h3>
                <div class="description">
                    <img src="../images/undraw_mobile_login_re_9ntv.svg" alt="inscription image">
                    <h3>Connectez-vous pour découvrir des activités de team building originales et renforcer les liens de votre équipe !</h3>
                </div> 

                <form action="verif_connexion.php" method="post">
                  <h1>Connectez-vous</h1>
                  <?php include '../includes/message.php' ?>

                  <div class="email">
                    <input type="email" name="email" placeholder="Adresse mail">  
                  </div>

                  <div class="password">
                    <input type="password" name="password" placeholder="Mot de passe">
                  </div>

                  <div class="g-recaptcha" data-sitekey="6Lcn8QsmAAAAAJUNOuIsWJg4XeAHwJUhaLDmgBNb" data-callback="onSubmit" ></div>

                  <button type="submit" name="submit" id="submit-btn" disabled>Connexion</button><br>

                  <div class="possession">
                    <p>Vous n’avez pas encore de compte !</p>
                    <a href="inscription.php">S’inscrire</a>
                  </div>
                </form>

                <button class="cta">
                  <a href="../index.php">Accueil</a>
                  <svg viewBox="0 0 13 10" height="10px" width="15px">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                  </svg>
                </button>
            </div>
        </main>

        <script>
            function onSubmit(token) {
                document.getElementById("submit-btn").disabled = false;
            }
        </script>
    </body>
</html>