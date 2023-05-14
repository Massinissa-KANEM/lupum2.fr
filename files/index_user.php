<?php
 session_start();
 if(!isset($_SESSION['email'])){
   header('location: index.php');
   exit;
 }
include('../includes/head.php');
?>
<link rel="stylesheet" href="../CSSs/index_user.css">
 </head>  

 <body>
 
     <header>
         <div class="container">
             <svg class="vagues" id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 180" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(245, 238, 255, 1)" offset="0%"></stop><stop stop-color="rgba(245, 238, 255, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,132L80,113.7C160,95,320,59,480,62.3C640,66,800,110,960,106.3C1120,103,1280,51,1440,58.7C1600,66,1760,132,1920,161.3C2080,191,2240,183,2400,150.3C2560,117,2720,59,2880,51.3C3040,44,3200,88,3360,95.3C3520,103,3680,73,3840,73.3C4000,73,4160,103,4320,121C4480,139,4640,147,4800,128.3C4960,110,5120,66,5280,58.7C5440,51,5600,81,5760,99C5920,117,6080,125,6240,113.7C6400,103,6560,73,6720,62.3C6880,51,7040,59,7200,77C7360,95,7520,125,7680,113.7C7840,103,8000,51,8160,47.7C8320,44,8480,88,8640,88C8800,88,8960,44,9120,51.3C9280,59,9440,117,9600,124.7C9760,132,9920,88,10080,66C10240,44,10400,44,10560,58.7C10720,73,10880,103,11040,102.7C11200,103,11360,73,11440,58.7L11520,44L11520,220L11440,220C11360,220,11200,220,11040,220C10880,220,10720,220,10560,220C10400,220,10240,220,10080,220C9920,220,9760,220,9600,220C9440,220,9280,220,9120,220C8960,220,8800,220,8640,220C8480,220,8320,220,8160,220C8000,220,7840,220,7680,220C7520,220,7360,220,7200,220C7040,220,6880,220,6720,220C6560,220,6400,220,6240,220C6080,220,5920,220,5760,220C5600,220,5440,220,5280,220C5120,220,4960,220,4800,220C4640,220,4480,220,4320,220C4160,220,4000,220,3840,220C3680,220,3520,220,3360,220C3200,220,3040,220,2880,220C2720,220,2560,220,2400,220C2240,220,2080,220,1920,220C1760,220,1600,220,1440,220C1280,220,1120,220,960,220C800,220,640,220,480,220C320,220,160,220,80,220L0,220Z"></path></svg>
             <div class="logo">
                 <img src="../images/logo_lupum.png" alt="logo">
                 <div class="menu">
                     <ul>
                        <li class="simple_button"><a href="#text"><ion-icon name="information-circle-outline"></ion-icon>Infos</a></li>
                        <li class="simple_button"><a href="planning.php"><ion-icon name="information-circle-outline"></ion-icon>Planning</a></li>
                        <li class="big_button"><a href="profil.php"><i class="fa-regular fa-user"></i>Mon Profil</a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </header>
 
     <main>
 
         <div class="first_block">
             
             <div class="intro">
                 <h2>Renforcez votre équipe et boostez votre productivité</h2>
                 <p>la pratique qui favorise la collaboration et la cohésion au sein de votre entreprise !</p>
                 <a href="assister.php"><div class="inscription"><ion-icon name="log-in-outline"></ion-icon>Assister</div></a>
             </div>
             <svg   id="chart"   width="1000"   height="500"   viewBox="0 0 1000 500"   xmlns="http://www.w3.org/1000/svg" >    <path d="M 0,242.1048752069084 C 66.6,237.05957611863886 199.79999999999998,215.71389104841668 333,216.8783797655608 C 466.20000000000005,218.04286848270493 532.8,257.0694235995893 666,247.92731879262914 C 799.2,238.78521398566897 932.4,186.51974834313376 999,171.16785573075992" fill="none" stroke="#F68B1E" stroke-width="4px" />   <g>      </g> </svg>        
             <div class="blob"></div>
             <div class="image">
                 <img src="../images/connected_image.png" alt="illustration">
             </div>
         </div>
 
         
         <div id="text">
             <div>
                 <h1>Qu'est-ce qu'un team building ?</h1>
             </div>
             <div>
                 <h2>Le team building est une activité de renforcement d'équipe.</h2>
                 <hr>
                 <p>
                     C'est une activité qui vise à renforcer les liens et la collaboration entre les membres d'une équipe, en mettant l'accent sur les objectifs communs, les valeurs partagées, les compétences et les personnalités de chacun. Les activités de team building peuvent être organisées en entreprise ou à l'extérieur, et peuvent prendre diverses formes, telles que des défis sportifs, des jeux de rôle, des ateliers de créativité, des projets collaboratifs, des sorties culturelles, etc.
                 </p>
             </div>
             <div>
                 <h2>Pourquoi organiser un team building ?</h2>
                 <hr>
                 <p>
                     Les activités de team building permettent d'améliorer la communication, la cohésion, la motivation et la productivité des membres de l'équipe, en favorisant l'échange, la découverte, la confiance et l'entraide. Elles permettent également de renforcer l'identité et l'image de l'entreprise, en mettant en avant sa culture, ses valeurs et son engagement envers ses collaborateurs.
                 </p>
             </div>
             <div>
                 <h2>Quelles sont les activités de team building possibles ?</h2>
                 <hr>
                 <p>
                     Les activités de team building peuvent être très variées et adaptées aux objectifs, aux ressources et aux préférences de chaque équipe et entreprise. Voici quelques exemples d'activités de team building : Escape Game, participation à des événements caritatifs, rallye découverte d'une ville ou d'un quartier, karaoké, chorégraphie ou scénettes de théâtre, activité de réalité virtuelle, création artistique (peinture, sculpture, etc.), compétition sportive, apéro, cocktail ou repas, atelier culinaire, tournoi de babyfoot, ping-pong ou autre, jeux de société, randonnée, voyage ou weekend. Il est important de choisir des activités qui répondent aux objectifs et aux besoins de l'équipe, qui soient accessibles et motivantes pour tous les membres, et qui soient encadrées par des professionnels compétents.
                 </p>
             </div>
         </div>
     </main>
 
     <footer>
         <div class="media">
             <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
             <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a>
             <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
         </div>
         
         <h4 class="made">Made by <a href="#">Massi KANEM  -  Mathis MAGNE  -  Jeremy MICU</a> </h4>
         <h4 class="reserve">©Together&Stronger 2023. All Rights Reserved.</h4>
     </footer>
 
 </body>
 
 </html>