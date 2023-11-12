document.addEventListener("DOMContentLoaded", function () {

    // ************************ switch btn menu ******************************** 

    var menuButton = document.querySelector('.menu-deroulent');
    var navLinks = document.querySelector('.nav-links');
    var isOpen = false;

    menuButton.addEventListener('click', function () {
        isOpen = !isOpen; // Inverser l'état du menu à chaque clic

        // Appliquer ou retirer la classe mobile-menu selon l'état du menu
        if (isOpen) {
            navLinks.classList.add('mobile-menu');
            menuButton.src = './assets/img/close_menu-btn.png';
        } else {
            navLinks.classList.remove('mobile-menu');
            menuButton.src = './assets/img/menu-btn.png';
        }
    });

    // ************************ box ********************************

    const boxes = document.querySelectorAll('.box');

    window.addEventListener('scroll', animateBoxes);

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.left <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function animateBoxes() {
        boxes.forEach(box => {
            if (isInViewport(box)) {
                gsap.to(box, { opacity: 1, x: 0, duration: 1.5, ease: "power4.out" });
            }
        });
    }


    // ************************ Popup login & register ********************************

    function resetFormFields(containerSelector) {
        const formFields = document.querySelectorAll(containerSelector + ' input[type="text"], ' + containerSelector + ' input[type="email"], ' + containerSelector + ' input[type="password"]');
        formFields.forEach(field => {
            field.value = '';
        });
    }
    
    document.getElementById('open-login-modal').addEventListener('click', function () {
        document.getElementById('login-modal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
        resetFormFields('#login-modal'); // Ajout pour réinitialiser les champs lors de l'ouverture
    });
    
    document.querySelector('.close-popup-btn-connexion').addEventListener('click', function () {
        this.closest('.modal-container').style.display = 'none';
        document.body.style.overflow = '';
        resetFormFields('.modal-container'); // Ajout pour réinitialiser les champs lors de la fermeture
    });
    
    document.querySelector('.close-popup-btn-connexion-inscription').addEventListener('click', function () {
        this.closest('.register-modal-dialog').style.display = 'none';
        document.body.style.overflow = '';
        resetFormFields('.register-modal-dialog'); // Ajout pour réinitialiser les champs lors de la fermeture
    });
    
    document.getElementById('show-register-form').addEventListener('click', function (event) {
        event.preventDefault();
        document.getElementById('login-modal').style.display = 'none';
        resetFormFields('#login-modal'); // Réinitialise les champs lors du changement de pop-up
        document.getElementById('registerModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });
    
    document.getElementById('show-login-form').addEventListener('click', function () {
        document.getElementById('registerModal').style.display = 'none';
        resetFormFields('#registerModal'); // Réinitialise les champs lors du changement de pop-up
        document.getElementById('login-modal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });
    


    // robustesse mots de passe 
    document.getElementById("register-password").addEventListener("keyup", checkPasswordStrength);
    function checkPasswordStrength() {
        var strengthBar = document.getElementById("password-strength-meter");
        var strengthText = document.getElementById("password-strength-text");
        var passwordStrengthContainer = document.getElementById("password-strength");
        var password = document.getElementById("register-password").value;
        var strength = 0;
    
        if (password.length === 0) {
            passwordStrengthContainer.style.display = "none";
            return; // Early exit if the password is empty.
        }
    
        passwordStrengthContainer.style.display = "block"; // Only display the indicator if the password is not empty.
        
        // Check for the presence of numbers and letters.
        if (password.match(/[a-zA-Z]/) && password.match(/[0-9]/)) {
            strength += 1;
        }
        // Check for the presence of lower and upper case letters.
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
            strength += 1;
        }
        // Check for the presence of special characters.
        if (password.match(/[!@#$%^&*(),.?":{}|<>]/)) {
            strength += 1;
        }
        // Check for password length.
        if (password.length >= 8) {
            strength += 1;
        }
        // Additional strength for extra-long passwords.
        if (password.length >= 12) {
            strength += 1;
        }
    
        switch (strength) {
            case 0:
            case 1:
                strengthText.innerHTML = "Faible";
                strengthBar.value = 33.3;
                strengthBar.style.backgroundColor = '#ff3e36'; // Red color for weak password.
                break;
            case 2:
            case 3:
                strengthText.innerHTML = "Moyen";
                strengthBar.value = 66.6;
                strengthBar.style.backgroundColor = '#ffa500'; // Orange color for medium password.
                break;
            case 4:
            case 5:
                strengthText.innerHTML = "Fort";
                strengthBar.value = 100;
                strengthBar.style.backgroundColor = '#28a745'; // Green color for strong password.
                break;
        }
    }

    function connected(username, profilePicPath) {
        // Affichez un message de bienvenue ou effectuez toute autre action nécessaire
        alert("Bienvenue, " + username + "!");
        // Modifier l'image de profil si nécessaire
        // document.getElementById('profilePic').src = profilePicPath;
    }

});

