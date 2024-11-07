// Sélectionnez tous les boutons "Like" et "Dislike" ainsi que les compteurs de votes
const likeButtons = document.querySelectorAll('.like-button');
const dislikeButtons = document.querySelectorAll('.dislike-button');
const likeCounts = document.querySelectorAll('.like-count');
const dislikeCounts = document.querySelectorAll('.dislike-count');

// Ajoutez des gestionnaires d'événements pour les boutons "Like"
likeButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    // Incrémente le compteur de likes
    likeCounts[index].textContent = parseInt(likeCounts[index].textContent) + 1;
    
    // Vous pouvez également envoyer le vote au serveur ici pour le stocker
  });
});

// Ajoutez des gestionnaires d'événements pour les boutons "Dislike"
dislikeButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    // Incrémente le compteur de dislikes
    dislikeCounts[index].textContent = parseInt(dislikeCounts[index].textContent) + 1;
    
    // Vous pouvez également envoyer le vote au serveur ici pour le stocker
  });
});
