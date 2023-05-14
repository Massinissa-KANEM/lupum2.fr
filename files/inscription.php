<?php include '../includes/head.php' ?>
<title>Inscription</title>

<link href="../CSSs/inscription.css" rel="stylesheet">
</head>
<script src="../js/transition.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body>
  <main>
    <div class="bloc">
        <h3 class="hello">Bienvenue !</h3>
        <form action="verif_inscription.php" method="POST">

          <h1>Inscrivez-vous</h1>
          <?php include '../includes/message.php' ?>

          <div class="email">
            <input type="email" placeholder="Adresse mail" required="" name="email">  
          </div>

          <div class="lastName">
            <input type="texte" placeholder="Nom" required="" name="lastName">  
          </div>

          <div class="firstName">
            <input type="texte" placeholder="Prénom" required="" name="firstName">
          </div>

          <div class="password1">
            <input type="password" placeholder="Mot de passe" required="" name="password">
          </div>

          <div class="password2">
            <input type="password" placeholder="Confirmer le mdp" required="" name="password2">
          </div>

          <!-- <h4 class="status_select">Sélectionnez Votre Status</h4>
          <div class="btn-group" role="group" aria-label="Status">
            <input type="radio" class="btn-check" name="status" id="salarié" autocomplete="off" checked value="salarié">
            <label class="btn btn-outline-success" for="salarié">Utilisateur</label>
            <input type="radio" class="btn-check" name="status" id="responsable" autocomplete="off" checked value="responsable">
            <label class="btn btn-outline-success" for="responsable">Admin</label>
          </div> -->
          <div class="g-recaptcha" data-sitekey="6Lcn8QsmAAAAAJUNOuIsWJg4XeAHwJUhaLDmgBNb" data-callback="onSubmit"></div>
          <button type="submit" name="submit" id="submit-btn" disabled>S'inscrire</button><br>

          <div class="possession">
            <p>Vous avez déjà un compte ?</p>
            <a href="connexion.php">Se connecter</a>
          </div>
        </form>

        <div class="description">
          <img src="../images/inscription-removebg-preview.png" alt="inscription image">
          <h3>Rejoignez notre communauté de passionnés pour des activités de team building inoubliables !</h3>
        </div>
        <button class="cta">
          <a href="../index.php">Accueil</a>
          <svg viewBox="0 0 13 10" height="10px" width="15px">
            <path d="M1,5 L11,5"></path>
            <polyline points="8 1 12 5 8 9"></polyline>
          </svg>
        </button>
    </div>
    <script>
            function onSubmit(token) {
                document.getElementById("submit-btn").disabled = false;
            }

            document.getElementById("submit-btn").addEventListener("click", function(event) {
                if (grecaptcha.getResponse() == "") {
                    event.preventDefault();
                }
            });
        </script>
  </main>
</body>
</html>