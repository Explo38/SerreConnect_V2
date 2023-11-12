<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre serre</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/logo_rond.png" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/votre_serre.css" />
    <link rel="stylesheet" href="/css/script.css" />
</head>

<body>
    <nav class="navbar">
        <a href="#" class="logo">
            <img src="/assets/img/logo-grand.png" alt="Logo SerreConnect">
        </a>
        <div class="nav-links">
            <ul>
                <li><a href="#">Application</a></li>
                <li><a href="#">Qui sommes-nous ?</a></li>
                <li><a href="#" class="btn-login">Login</a></li>
            </ul>
        </div>
        <img src="/assets/img/menu-btn.png" alt="menu déroulant" class="menu-deroulent">
    </nav>

    

    <section>

    </section>

        <!-- pied de page du site -->
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
                <li class="menu__item"><a class="menu__link" href="#">Services</a></li>
                <li class="menu__item"><a class="menu__link" href="#">Team</a></li>
                <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>
    
            </ul>
            <p class="center">&copy; 2023 SerreConnect | All Rights Reserved</p>
        </footer>
</body>


<!-- navbar -->
<script>
    const menuDeroulent = document.querySelector(".menu-deroulent")
    const navLinks = document.querySelector(".nav-links")

    menuDeroulent.addEventListener('click', () => {
        navLinks.classList.toggle('mobile-menu')
    })
</script>
<script src="/js/serre.js"></script>

<!-- Scripts JS pour le fonctionnement du site -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>


</html>