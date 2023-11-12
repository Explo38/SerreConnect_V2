document.addEventListener("DOMContentLoaded", function () {
    AOS.init();
    const intro = document.querySelector(".intro");
    const logo = intro.querySelector("#logo");
    const video = intro.querySelector("video");
    const text = intro.querySelector("h1");

    video.addEventListener('canplaythrough', function () {
        // La vidéo est prête à être jouée, vous pouvez initialiser vos animations ou autres logiques ici
        video.play();
    }, false);

    // SCROLLMAGIC
    const controller = new ScrollMagic.Controller();

    // Créer une scène pour la durée totale du défilement
    let scene = new ScrollMagic.Scene({
        duration: 10000,
        triggerElement: intro,
        triggerHook: 0
    })
        //.addIndicators() // Ajouter des indicateurs pour faciliter le débogage
        .setPin(intro)   // Fixer l'élément intro lors du défilement
        .addTo(controller);

    // Animation du texte
    const textAnim = TweenMax.fromTo(text, 5, { opacity: 1 }, { opacity: 0 });

    // Animation du logo
    const logoAnim = TweenMax.fromTo(logo, 3, { opacity: 0 }, { opacity: 1 });

    // Créer une timeline GSAP
    const tl = new TimelineMax()
        .add(textAnim)   // Ajouter l'animation du texte à la timeline
        .to({}, 1, {})   // Ajouter un délai de 3 secondes
        .add(logoAnim);  // Ajouter l'animation du logo à la timeline après le délai

    // Associer la timeline à une scène ScrollMagic
    let scene2 = new ScrollMagic.Scene({
        duration: 11000, // Durée combinée de textAnim, du délai et de logoAnim
        triggerElement: intro,
        triggerHook: 0
    })
        .setTween(tl)  // Utiliser la timeline comme animation pour la scène
        .addTo(controller);

    // Variables pour l'animation de la vidéo
    let accelamount = 0.1;
    let scrollpos = 0;
    let delay = 0;
    let lastScrollPos = 0;

    // Mettre à jour la position de défilement pour l'animation de la vidéo
    scene.on('update', e => {
        scrollpos = e.scrollPos / 800;  // Ajuster le diviseur pour ralentir la vitesse de défilement de la vidéo
    });

    function update() {
        delay += (scrollpos - delay) * accelamount;

        // Lisser les sauts en limitant la différence maximale entre les positions de défilement successives
        let diff = scrollpos - lastScrollPos;
        if (Math.abs(diff) > 0.2) {
            scrollpos = lastScrollPos + 0.2 * Math.sign(diff);
        }

        video.currentTime = delay;
        lastScrollPos = scrollpos;
        requestAnimationFrame(update); // Conservez requestAnimationFrame pour une mise à jour continue
    }
    update();


    // ************************ Texte Animation ********************************
    const mainSection = document.querySelector(".main-section");
    const animatedTexts = mainSection.querySelectorAll(".animated-text");

    let sceneText = new ScrollMagic.Scene({
        duration: '1800vh',
        triggerElement: mainSection,
        triggerHook: 0
    })
        .setPin(mainSection)
        .on('progress', function (event) {
            let progress = event.progress;

            // Animation pour le premier texte
            if (progress <= 0.2) {
                // Apparition du texte 1
                let adjustedProgress = progress * 5;
                let gradientStart = (1 - adjustedProgress) * 100;
                let gradientEnd = gradientStart + adjustedProgress * 200;
                animatedTexts[0].style.backgroundImage = `linear-gradient(-45deg, transparent ${gradientStart}%, lightgreen ${gradientStart + (10 * adjustedProgress)}%, green ${gradientEnd - (10 * adjustedProgress)}%, transparent ${gradientEnd}%)`;
                animatedTexts[1].style.backgroundImage = 'none';
            }
            else if (progress > 0.2 && progress <= 0.5) {
                // Texte 1 entièrement visible
                animatedTexts[0].style.backgroundImage = `linear-gradient(-45deg, lightgreen, green)`;
            }
            else if (progress > 0.5 && progress <= 0.7) {
                // Disparition du texte 1
                let adjustedProgress = (progress - 0.5) * 5;
                let gradientEnd = (1 - adjustedProgress) * 100;
                animatedTexts[0].style.backgroundImage = `linear-gradient(-45deg, transparent 0%, lightgreen ${gradientEnd - 10}%, transparent ${gradientEnd}%)`;
                animatedTexts[1].style.backgroundImage = 'none';
            }
            // Animation pour le second texte
            else if (progress > 0.7 && progress <= 0.8) {
                // Apparition du texte 2
                let adjustedProgress = (progress - 0.7) * 10;
                let gradientStart = (1 - adjustedProgress) * 100;
                let gradientEnd = gradientStart + adjustedProgress * 200;
                animatedTexts[1].style.backgroundImage = `linear-gradient(-45deg, transparent ${gradientStart}%, lightgreen ${gradientStart + (10 * adjustedProgress)}%, green ${gradientEnd - (10 * adjustedProgress)}%, transparent ${gradientEnd}%)`;
                animatedTexts[0].style.backgroundImage = 'none';
            }
            /*else if (progress > 0.8 && progress <= 0.95) {
                // Texte 2 entièrement visible
                animatedTexts[1].style.backgroundImage = `linear-gradient(-45deg, lightgreen, green)`;
            }
            else {
                // Disparition du texte 2
                let adjustedProgress = (progress - 0.95) * 20;
                let gradientEnd = (1 - adjustedProgress) * 100;
                animatedTexts[1].style.backgroundImage = `linear-gradient(-45deg, transparent 0%, lightgreen ${gradientEnd - 10}%, transparent ${gradientEnd}%)`;
            }*/
        })
        .addTo(controller);


    // ************************ Scroll horizontal ********************************
    const scrollImages = document.querySelector(".scroll-images");
    scrollImages.classList.add("no-select");

    // Cette fonction détermine combien d'indicateurs sont nécessaires
    function getNumberOfIndicators() {
        const viewportWidth = window.innerWidth;
        if (viewportWidth <= 600) {
            return 2;  // pour les téléphones
        } else if (viewportWidth <= 900) {
            return 2;  // pour les tablettes
        } else {
            return 2;  // pour les desktops
        }
    }

    const indicatorsContainer = document.createElement("div");
    indicatorsContainer.classList.add("indicators");
    scrollImages.parentNode.insertBefore(indicatorsContainer, scrollImages.nextSibling);

    // Supprimez les anciens indicateurs avant d'en créer de nouveaux
    const oldIndicators = document.querySelectorAll(".indicator");
    oldIndicators.forEach(ind => ind.remove());

    const numberOfIndicators = getNumberOfIndicators();
    for (let i = 0; i < numberOfIndicators; i++) {
        const indicator = document.createElement("div");
        indicator.classList.add("indicator");
        indicatorsContainer.appendChild(indicator);
    }

    function checkScroll() {
        const currentScroll = scrollImages.scrollLeft;
        const indicatorWidth = 200; // Ajustez cette valeur en fonction de la largeur de vos éléments défilants
        const activeIndicator = Math.floor(currentScroll / indicatorWidth);
        document.querySelectorAll(".indicator").forEach((indicator, index) => {
            if (index === activeIndicator) {
                indicator.classList.add("active");
            } else {
                indicator.classList.remove("active");
            }
        });
    }

    scrollImages.addEventListener("scroll", checkScroll);
    window.addEventListener("resize", checkScroll);
    checkScroll();

    function leftScroll() {
        scrollImages.scrollBy({
            left: -200,
            behavior: "smooth"
        });
    }

    function rightScroll() {
        scrollImages.scrollBy({
            left: 200,
            behavior: "smooth"
        });
    }

    let isDown = false;
    let startX;
    let scrollLeft;

    scrollImages.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - scrollImages.offsetLeft;
        scrollLeft = scrollImages.scrollLeft;
    });

    scrollImages.addEventListener('mouseleave', () => {
        isDown = false;
    });

    scrollImages.addEventListener('mouseup', () => {
        isDown = false;
    });

    scrollImages.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        const x = e.pageX - scrollImages.offsetLeft;
        const walk = (x - startX);
        scrollImages.scrollLeft = scrollLeft - walk;
    });


    // ************************ Scroll cards apparition ********************************

    const section = document.querySelector('.revolution');
    const end = section.querySelector('h1');
    const card = section.querySelector('.card');
    
    // Créez une nouvelle scène qui déclenche lorsque l'utilisateur fait défiler vers l'élément 'end'
    let scene3 = new ScrollMagic.Scene({
        triggerElement: end,    // L'élément qui déclenche l'apparition de la carte
        triggerHook: 0.8,       // La carte apparaîtra lors du défilement vers cet élément
        duration: "100%"        // La carte reste visible pour toute la durée de l'élément
    })
    .setClassToggle(card, "visible") // Bascule la classe 'visible' pour montrer/cacher la carte
    .addTo(controller);
    
    // Pour s'assurer que la carte disparaît seulement quand elle n'est plus à la vue
    let scene4 = new ScrollMagic.Scene({
        triggerElement: section,    // Utilisez le début de la section comme élément déclencheur pour la disparition
        triggerHook: "onLeave",     // La carte disparaîtra lorsque la section commence à quitter la vue
        duration: 0                 // Pas besoin de durer puisqu'elle disparaîtra instantanément
    })
    .on("leave", function (e) {
        if (e.scrollDirection === 'FORWARD') {
            card.classList.remove("visible");
        }
    })
    .addTo(controller);
    
    // ************************ PopUP apparition **************************************
    var openPopupButton = document.getElementById('openPopupBtn');
    var closePopupButton = document.getElementById('closePopupBtn');
    var popupOverlay = document.getElementById('popupOverlay');
    var popup = popupOverlay.querySelector('.popup');
    var body = document.body;

    // La fonction de définition du currentTime à la fin de la vidéo si on scroll directement vers le haut
    function setVideoToEnd() {
        var videoPopupContent = document.getElementById('videoPopupContent');
        if (videoPopupContent.readyState >= 4) {
            videoPopupContent.currentTime = videoPopupContent.duration; // Mettre la vidéo à la fin si elle est déjà chargée
        } else {
            videoPopupContent.addEventListener('loadedmetadata', function () {
                videoPopupContent.currentTime = videoPopupContent.duration; // Mettre la vidéo à la fin
            }, { once: true });
        }
    }

    openPopupButton.addEventListener('click', function () {
        popupOverlay.style.display = 'block';
        popup.classList.add('visible');
        body.style.overflow = 'hidden'; // Désactive le défilement sur le body
        setVideoToEnd(); // Prépare la vidéo à partir de la fin si l'utilisateur scroll vers le haut
    });

    closePopupButton.addEventListener('click', function () {
        popup.classList.remove('visible');
        setTimeout(() => {
            popupOverlay.style.display = 'none';
            body.style.overflow = ''; // Réactive le défilement sur le body
        }, 1000); // Correspond à la durée de votre animation
    });

    // ************************ PopUP vue 3D **************************************

    const videoPopupContent = document.getElementById('videoPopupContent');

    // Une variable pour suivre si l'utilisateur a scrollé pour la première fois
    let firstScrollHasOccurred = false;

    videoPopupContent.addEventListener('wheel', (e) => {
        e.preventDefault();

        const scrollSpeed = 0.005;

        if (videoPopupContent.duration) {
            if (!firstScrollHasOccurred) {
                if (e.deltaY < 0) {
                    // Si l'utilisateur scroll vers le haut pour la première fois, on commence à la fin
                    videoPopupContent.currentTime = videoPopupContent.duration;
                } else {
                    // Si l'utilisateur scroll vers le bas pour la première fois, on commence au début
                    videoPopupContent.currentTime = 0;
                }
                firstScrollHasOccurred = true; // On marque que le premier scroll a eu lieu
            } else {
                // Après le premier scroll, on avance ou on recule la vidéo selon le scroll
                let newTime;

                if (e.deltaY > 0) {
                    // Défilement vers le bas - faire avancer la vidéo
                    newTime = videoPopupContent.currentTime + Math.abs(e.deltaY * scrollSpeed);
                } else {
                    // Défilement vers le haut - faire reculer la vidéo
                    newTime = videoPopupContent.currentTime - Math.abs(e.deltaY * scrollSpeed);
                }

                // Assurez-vous que le temps est dans les limites de la vidéo
                videoPopupContent.currentTime = Math.max(0, Math.min(newTime, videoPopupContent.duration));
            }
        }
    });



    // ************************ Scroll Box apparition ********************************

    // Sélectionnez tous les éléments .box
    const boxes = document.querySelectorAll('.box');

    // Boucle sur chaque .box pour créer une scène ScrollMagic pour chacun
    boxes.forEach((box, index) => {
        // Ajoutez la classe 'initial-state' pour définir l'état initial de l'animation
        box.classList.add('initial-state');

        // Déterminez la direction de départ basée sur si l'index est pair ou impair
        const fromDirection = index % 2 === 0 ? -50 : 50;

        // Créez l'animation GSAP pour cette direction
        const tween = gsap.fromTo(box, { x: fromDirection, opacity: 0 }, { duration: 1, x: 0, opacity: 1, ease: "power1.out" });

        // Créez une scène ScrollMagic pour chaque .box
        new ScrollMagic.Scene({
            triggerElement: box,
            offset: -300, 
            triggerHook: 0.8, 
        })
            .setTween(tween) // Appliquez l'animation tween créée avec GSAP
            .addTo(controller); // Ajoutez la scène au contrôleur ScrollMagic
    });

    // Optionnel: Appeler refresh si la hauteur de la page change après le chargement initial
    window.addEventListener('load', () => {
        controller.refresh();
    });

});

