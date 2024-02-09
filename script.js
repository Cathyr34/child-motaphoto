
/*Menu*/

const menu = document.getElementById("mesliens");
const icon = document.getElementById("site-navigation_hamburger_icon");

function showResponsiveMenu() {


if (!menu.classList.contains("open")) { /*vérifie si la class open est présente*/
  menu.classList.add("open");
  icon.classList.add("open"); 
} 
else {
  menu.classList.remove("open");
  icon.classList.remove("open"); 
}
}

var menuLinks = document.querySelectorAll('.responsive-menu a');

// Parcourez chaque lien
for (var i = 0; i < menuLinks.length; i++) {
// Ajoutez un écouteur d'événements pour le clic
menuLinks[i].addEventListener('click', function(event) {
  showResponsiveMenu()
});
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//afficher les posts
document.addEventListener('DOMContentLoaded', function() {
  document.querySelector('#ajax_call').addEventListener('click', function() {
    let formData = new FormData();
    formData.append('action', 'request_photos');
 
 
    fetch(motaphoto_js.ajax_url, {
      method: 'POST',
      body: formData,
    }).then(function(response) {
      if (!response.ok) {
        throw new Error('Network response error.');
      }
 
 
      return response.json();
    }).then(function(data) {
      data.posts.forEach(function(post) {
        document.querySelector('#ajax_return').insertAdjacentHTML('beforeend', '<div class="col-12 mb-5">' + post.post_title + '</div>');
      });
    }).catch(function(error) {
      console.error('There was a problem with the fetch operation: ', error);
    });
  });
 });