<!DOCTYPE html>
<html>
<head>
    <title>Composant de Compte à Rebours</title>
    <style>
        /* Style pour le composant de compte à rebours */
        #countdown-container {
            text-align: center;
            font-family: 'Arial', sans-serif;
            background-color: rgba(33,146,188,255); /* Couleur de fond */
            color: #fff; /* Couleur du texte */
            padding: 20px; /* Espace intérieur */
            border-radius: 10px; /* Coins arrondis */
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.8); /* Ombre */
        }

        /* Style pour le texte du composant de compte à rebours */
        #countdown-text {
            font-size: 24px;
            margin-bottom: 10px;
        }

        /* Style pour le composant de compte à rebours lui-même */
        #countdown-component {
            font-size: 32px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Utilisation du composant de compte à rebours -->
    <div id="countdown-container">
        <p id="countdown-text">Les Jeux Olympiques commencent dans</p>
        <div id="countdown-component"></div>
    </div>

    <script>
        // Fonction pour créer un composant de compte à rebours
        function createCountdownComponent(targetDate, elementId) {
            const targetTime = new Date(targetDate).getTime();
            const countdownElement = document.getElementById(elementId);

            function updateCountdown() {
                const currentTime = new Date().getTime();
                const timeRemaining = targetTime - currentTime;

                if (timeRemaining <= 0) {
                    countdownElement.innerHTML = 'Le compte à rebours est terminé!';
                } else {
                    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                    countdownElement.innerHTML = `${days} jours, ${hours} heures, ${minutes} minutes, ${seconds} secondes`;
                }
            }

            // Mettre à jour le compte à rebours chaque seconde
            setInterval(updateCountdown, 1000);

            // Appeler la fonction une première fois pour éviter un délai d'une seconde au chargement de la page
            updateCountdown();
        }

        // Utilisation du composant de compte à rebours en spécifiant la date cible et l'ID de l'élément
        createCountdownComponent('2024-07-26T00:00:00', 'countdown-component');
    </script>
</body>
</html>
