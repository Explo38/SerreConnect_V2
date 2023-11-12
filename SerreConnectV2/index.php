<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SerreConnect</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/logo_rond.png" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/scrollanim.css" />
    <link rel="stylesheet" href="./css/script.css" />
</head>

<body>
    <div class="main-container">


        <nav class="navbar">
            <a href="#" class="logo">
                <img src="./assets/img/logo-grand.png" alt="Logo SerreConnect">
            </a>
            <div class="nav-links">
                <ul>
                    <li><a href="#">Application</a></li>
                    <li><a href="./qui_sommes_nous.php">Qui sommes-nous ?</a></li>
                    <li><a href="#">Home</a></li>
                    <?php
                    session_start();
                    if (isset($_SESSION['connected']) && $_SESSION['connected'] === true) : ?>

                        <!-- Si l'utilisateur est connecté, affichez sa photo de profil -->
                        <!-- <li>
                    <div class="user-profile">
                        <img src="./assets/img/ppdora.png" alt="Profile Pic" class="profile-pic">
                    </div>
                </li>-->
                        <span class="welcome-message">Bonjour <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> !</span>

                        <!-- Ajout du lien de déconnexion -->
                        <li><a href="./logout.php" class="custom-btn">Déconnexion</a></li>
                    <?php else : ?>
                        <!-- Sinon, affichez le bouton pour se connecter -->
                        <li><a class="custom-btn" id="open-login-modal">Votre compte</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <img src="./assets/img/menu-btn.png" alt="menu déroulant" class="menu-deroulent">
        </nav>



        <!-- *********************** intro (video debut) ************************* -->
        <div class="intro no-select">
            <video src="./assets/video/video-debut-ultra-compressed.mp4" preload="auto"></video>
            <h1>UN AVENIR VERT</h1>
            <img src="./assets/img/logo-grand.png" id="logo">
        </div>


        <!-- *********************** ecriture annimation ************************* -->
        <div class="main-section no-select">
            <h1 class="animated-text">Votre jardin, vos règles</h1>
            <h1 class="animated-text">Ajustez, surveillez et cultivez grâce à notre serre connectée</h1>
        </div>

        <!-- *********************** revolution cards ************************* -->
        <div class="revolution">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-6">
                                    <h1>La Revolution est là</h1>
                                    <div class="subtitle">Ajustez, surveillez et cultivez</div>
                                    <p class="py-5">Découvrez notre serre connectée,
                                        une innovation autonome qui régule avec précision la qualité de l'air,
                                        l'humidité et la température pour un environnement de croissance optimal.
                                        Alimentée par l'énergie solaire grâce à ses panneaux performants et sa batterie de 20 000 mAh,
                                        elle intègre un système d'arrosage intelligent, le tout contrôlable du bout des doigts via notre application mobile dédiée.</p>
                                    <button class="btn-outline-secondary" id="openPopupBtn">Vue 3D</button>
                                </div>
                                <div class="col-6">
                                    <img src="./assets/img/cardimg.png" class="video" width="100%" height="100%" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- La popup -->
        <div id="popupOverlay" class="popup-overlay">
            <div class="popup">
                <button id="closePopupBtn" class="close-popup-btn">&times;</button>
                <!-- Contenu de la popup -->
                <div class="popup-content">
                    <video id="videoPopupContent" class="video-popup-content" preload="auto" loop>
                        <source src="./assets/video/serre3D-png.mp4" type="video/mp4">
                        Votre navigateur ne prend pas en charge les vidéos HTML5.
                    </video>
                    <p class="scroll-instruction">Utilisez la molette de défilement vers le
                        bas pour commencer la vue 3D.</p>
                </div>
            </div>
        </div>

        <!-- *********************** scroll box ************************* -->
        <div class="cover no-select">
            <div class="scroll-images">
                <div class="child">
                    <h4>Autonomie solaire</h4>
                    <img src="./assets/img/icon/icon-paneau-solaire2.png">
                    <p>Grâce à l'intégration de panneaux solaires de pointe, notre serre connectée bénéficie d'une autonomie énergétique complète, favorisant une agriculture durable et respectueuse de l'environnement.</p>
                    <img src="./assets/img/panneau.png">
                </div>
                <div class="child">
                    <h4>humiditer</h4>
                    <img src="./assets/img/icon/humiditer.png">
                    <p>Nos capteurs d'humidité de précision assurent le maintien optimal de l'eau nécessaire à vos cultures, en ajustant automatiquement l'irrigation pour une gestion efficace et économe des ressources en eau</p>
                    <img src="./assets/img/humiditer.png">
                </div>
                <div class="child">
                    <h4>qualité de l'aire</h4>
                    <img src="./assets/img/icon/qualiter de l'aire_contour.png">
                    <p>Dotée de capteurs de qualité d'air avancés, notre serre connectée surveille et régule en continu l'atmosphère interne, garantissant ainsi un environnement parfaitement équilibré pour la santé et la croissance de vos plantes</p>
                    <img src="./assets/img/airquality.png">
                </div>
                <div class="child">
                    <h4>température</h4>
                    <img src="./assets/img/icon/temperature_froid_contour.png">
                    <p>Les capteurs de température intégrés à notre serre connectée offrent un contrôle constant du climat, permettant d'adapter en temps réel les conditions internes pour une productivité maximale, quelles que soient les variations climatiques extérieures.</p>
                    <img src="./assets/img/icon/tmp36.png">
                </div>
            </div>
        </div>


        <!-- *********************** grille cards ************************* -->
        <section class="custom-section">
            <!-- Large Box -->
            <div class="box large">
                <img src="./assets/img/logo.png" alt="Titre 1" />
                <h2>Titre 1</h2>
                <p>Texte de description pour le titre 1.</p>
            </div>

            <!-- Two Small Boxes stacked on each other -->
            <div class="box small">
                <h2>Titre 2</h2>
                <p>Texte de description pour le titre 2.</p>
            </div>
            <div class="box small">
                <h2>Titre 3</h2>
                <p>Texte de description pour le titre 3.</p>
            </div>

            <!-- Medium Box -->
            <div class="box medium">
                <div class="icons">
                    <!-- Add your icons here -->
                    <img src="./assets/img/logo.png" alt="icon1">
                    <img src="./assets/img/logo.png" alt="icon2">
                    <!-- ... add other icons similarly ... -->
                </div>
                <p>Découvrez votre nouvel appareil avec une séance personnalisée en ligne.</p>
            </div>

            <!-- Additional boxes around as mentioned -->
            <div class="box small">
                <h2>Titre 4</h2>
                <p>Texte de description pour le titre 4.</p>
            </div>

            <div class="box large">
                <img src="./assets/img/logo.png" alt="Titre 5" />
                <h2>Titre 5</h2>
                <p>Texte de description pour le titre 5.</p>
            </div>

            <div class="box small">
                <h2>Titre 6</h2>
                <p>Texte de description pour le titre 6.</p>
            </div>
        </section>
    </div>



    <!-- *********************** pied de page du site *********************** -->
    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#">Home</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Application</a></li>
            <li class="menu__item"><a class="menu__link" href="./qui_sommes_nous.php">Qui sommes-nous ?</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>

        </ul>
        <p class="center">&copy; 2023 SerreConnect | All Rights Reserved</p>
    </footer>

    <!-- *********************** Modal pour le formulaire de connexion *********************** -->
    <div id="login-modal" class="modal-container" style="display: none;">
        <div class="modal-content">
            <div class="card">
                <button class="close-popup-btn-connexion">&times;</button>
                <div class="card-image">
                    <img src="./assets/img/fond_logo.png" alt="Background">
                </div>
                <div class="card-header">
                    <h2>Connectez-vous</h2>
                </div>
                <div class="card-body">
                    <!-- Assurez-vous que l'action pointe vers le script login.php -->
                    <form id="login-form" action="login.php" method="post">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" name="email" required>

                        <label for="login-password">Mot de passe</label>
                        <input type="password" id="login-password" name="password" required>

                        <div class="form-footer">
                            <a class="forgot-password">Mot de passe oublié?</a>
                            <button type="submit">Connexion</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <span>Vous n'avez pas de compte?</span> <a id="show-register-form">Inscrivez-vous</a>
                </div>
            </div>
        </div>
    </div>


    <!-- *********************** Modal pour le formulaire d'inscription *********************** -->
    <div class="register-modal-dialog" id="registerModal" style="display: none;">
        <div class="modal-content modal-scroll-content">
            <!-- Formulaire d'inscription -->
            <div class="register-card card">
                <!-- Bouton de fermeture -->
                <button class="close-popup-btn-connexion-inscription" onclick="closeModal('registerModal')">×</button>

                <div class="register-card-image card-image">
                    <img src="./assets/img/fond_logo.png" alt="Background">
                </div>
                <div class="register-card-header card-header">
                    <h2>Inscrivez-vous</h2>
                </div>
                <div class="register-card-body card-body">
                    <form id="register-form" method="POST" action="register.php">
                        <!-- Ajout du champ de nom d'utilisateur -->
                        <div class="register-form-group">
                            <label for="register-username">Nom d'utilisateur</label>
                            <input type="text" id="register-username" name="username" required class="register-form-input form-input">
                        </div>

                        <div class="register-form-group">
                            <label for="register-email">Email</label>
                            <input type="email" id="register-email" name="email" required class="register-form-input form-input">
                        </div>

                        <!-- Ajout du champ de numéro de téléphone -->
                        <div class="register-form-group">
                            <label for="register-phone">Numéro de téléphone</label>
                            <input type="tel" id="register-phone" name="phone" required class="register-form-input form-input">
                        </div>

                        <div class="register-form-group">
                            <label for="register-password">Mot de passe</label>
                            <input type="password" id="register-password" name="password" required onkeyup="checkPasswordStrength();" class="register-form-input form-input">
                            <!-- Indicateur de la force du mot de passe ajouté ici -->
                            <div id="password-strength" class="password-strength" style="display:none;">
                                <progress id="password-strength-meter" max="100" value="0"></progress>
                                <p id="password-strength-text"></p>
                            </div>
                        </div>

                        <div class="register-form-group">
                            <label for="register-confirm-password">Confirmez le mot de passe</label>
                            <input type="password" id="register-confirm-password" name="confirm_password" required class="register-form-input form-input">
                        </div>

                        <!-- CAPTCHA et bouton d'inscription dans le footer -->
                        <div class="register-card-footer card-footer">
                            <div class="captcha-container">
                                <div class="g-recaptcha" data-sitekey="6LdBFvMoAAAAANFLc2pKIqEQ6leH4w-wOiw_NK00"></div>
                            </div>

                            <div class="form-footer-inscription">
                                <button type="submit">Inscription</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="register-card-footer card-footer">
                    <span>Vous avez déjà un compte ?</span> <a id="show-login-form">Connectez-vous</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Début Popup -->
    <div class="popup-overlay <?php if (isset($_SESSION['success'])) echo 'visible'; ?>" id="popupSuccess">
        <div class="popup">
            <button class="close-popup-btn" onclick="closePopup()">×</button>
            <p><?php if (isset($_SESSION['success'])) echo htmlspecialchars($_SESSION['success']); ?></p>
            <!-- Vous pouvez ajouter plus de contenu ici comme une image ou une vidéo -->
        </div>
    </div>
    <!-- Fin Popup -->

    <script>
        // Fonction pour fermer la popup
        function closePopup() {
            document.getElementById('popupSuccess').classList.remove('visible');
        }
    </script>

    <?php
    // N'oubliez pas de supprimer le message de la session après l'avoir utilisé!
    if (isset($_SESSION['success'])) {
        unset($_SESSION['success']);
    }
    ?>

</body>



<!-- navbar -->
<script>
    const menuDeroulent = document.querySelector(".menu-deroulent")
    const navLinks = document.querySelector(".nav-links")

    menuDeroulent.addEventListener('click', () => {
        navLinks.classList.toggle('mobile-menu')
    })
</script>




<script src="./js/scroll2.js"></script>
<script src="./js/script.js"></script>
<script src="./js/navbar.js"></script>

<!-- recaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- cards revolution -->
<script src="https://pagecdn.io/lib/scrollmagic/2.0.7/plugins/animation.gsap.min.js" crossorigin="anonymous"></script>

<!-- damier imag -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>

<!-- scroll animation -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


<!-- scroll animation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js" integrity="sha512-HzAEuXwhLxwm/Jj+5ecdjzrRVrjuh2ZeIxyT1Ln37TO5pWNMnKBuU7cfd1wvRQ/k86w1oC174Yk1T7aRlBpIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.js" integrity="sha512-614k4+nIB+21iS2+QUeDh7T928egRNeNcjkKCdWPYmFCA3/mub3H6KoqIHAk8Pdm07S6uAPqWvXerPFVRYVB/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/animation.gsap.js" integrity="sha512-jlbgjhSLRQsQc/bits6lHjywF3n/NLO3Sz1rwa9gsUnCOi0f0lD/yAul75UNOzIiDg35zaJJ3BKT3zo6+i9lQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js" integrity="sha512-Ey+nIg+Ue8gUAaCNjR1KHR8nwDjWn9QXoQbynR/X+V66s6u1oqynnuRQ8zSgg5f5gBNb2Bzsu1pItCi3sPkbfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js" integrity="sha512-DkPsH9LzNzZaZjCszwKrooKwgjArJDiEjA5tTgr3YX4E6TYv93ICS8T41yFHJnnSmGpnf0Mvb5NhScYbwvhn2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Scripts JS pour le fonctionnement du site -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</html>