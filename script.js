
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

var menuLinks = document.querySelectorAll('#mesliens a, #mesliens button');

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
document.querySelector('#plus').addEventListener('click', function() {
    let formData = new FormData();
    formData.append('action', 'request_photos');
      const postlist= document.querySelectorAll(".image")
      const offset= postlist.length
      formData.append("offset", offset)

    fetch(script_js.ajax_url, {
      method: 'POST',
      body: formData,
    }).
    
    then(function(response) {
      if (!response.ok) {
        throw new Error('Network response error.');
      }
 
      return response.json();
    }).
    
    then(function(data) {
      console.log(data)
      data.forEach(function(post) {
        let images = document.querySelector(".lesphotos");
          images.insertAdjacentHTML('beforeend', '<div class="image"><img src="'+post.image_url+'" alt="'+post.title+'"><div class="overlay"><a href="'+post.lien+'" class="icon" title="Informations de l\'image"><i class="fa fa-eye"></i></a> <a href="#lightbox" class="icon" title="Afficher en plein écran"><i class="fa fa-expand"></i></a></div>');
       
      });  
    });  
    });
  });

  // En fonction des catégories
  document.addEventListener('DOMContentLoaded', function() {
  document.querySelector('#categories').addEventListener('change', function() {
    
    let formData = new FormData();
    formData.append('action', 'request_photos');
    formData.append('categories', this.value);

    fetch(script_js.ajax_url, {
      method: 'POST',
      body: formData,
    })
    .then(function(response) {
      if (!response.ok) {
        throw new Error('Erreur de réponse réseau.');
      }
      return response.json();
    })
    .then(function(data) {
      let images = document.querySelector(".lesphotos");
      images.innerHTML=""
      data.forEach(function(post) {
        // Vérifiez si le post appartient à la catégorie sélectionnée
        if (post.categorie === this.value) {
          
          images.innerHTML +=`
            <div class="image">
              <img src="${post.image_url}" alt="${post.title}">
              <div class="overlay">
                <a href="${post.lien}" class="icon" title="Informations de l'image"><i class="fa fa-eye"></i></a>
                <a href="#lightbox" class="icon" title="Afficher en plein écran"><i class="fa fa-expand"></i></a>
              </div>
            </div>
          `;
        }
      }, this); // Utilisez "this" pour accéder à la valeur de la catégorie sélectionnée
    });
  });
});

function getPhotos(val) {
  $.ajax({
  type: "POST",
  url: "get_photos.php",
  data:'id_categories='+val,
  success: function(data){
    $("#photos").html(data);
  }
  });
}

  // En fonction du format
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#formats').addEventListener('change', function() {
      
      let formData = new FormData();
      formData.append('action', 'request_photos');
      formData.append('format', this.value);
  
      fetch(script_js.ajax_url, {
        method: 'POST',
        body: formData,
      })
      .then(function(response) {
        if (!response.ok) {
          throw new Error('Erreur de réponse réseau.');
        }
        return response.json();
      })
      .then(function(data) {
        let images = document.querySelector(".lesphotos");
        images.innerHTML=""
        data.forEach(function(post) {
          // Vérifiez si le post appartient au format sélectionné
          if (post.format === this.value) {
            
            images.innerHTML +=`
              <div class="image">
                <img src="${post.image_url}" alt="${post.title}">
                <div class="overlay">
                  <a href="${post.lien}" class="icon" title="Informations de l'image"><i class="fa fa-eye"></i></a>
                  <a href="#lightbox" class="icon" title="Afficher en plein écran"><i class="fa fa-expand"></i></a>
                </div>
              </div>
            `;
          }
        }, this); // Utilisez "this" pour accéder à la valeur du format sélectionné
      });
    });
  });
  
  function getPhotos(val) {
    $.ajax({
    type: "POST",
    url: "get_photos.php",
    data:'id_formats='+val,
    success: function(data){
      $("#photos").html(data);
    }
    });
  }

  // En fonction de l'année
  document.addEventListener('DOMContentLoaded', function() {
    const selectAnnee = document.querySelector('#annees'); // Stockez l'élément <select> dans une variable

    selectAnnee.addEventListener('change', function() {
        const formData = new FormData();
        formData.append('action', 'request_photos');
        formData.append('date', selectAnnee.value); // Utilisez la valeur de l'année sélectionnée

        fetch(script_js.ajax_url, {
            method: 'POST',
            body: formData,
        })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Erreur de réponse réseau.');
            }
            return response.json();
        })
        .then(function(data) {
            let images = document.querySelector(".lesphotos");
            images.innerHTML = "";

            // Triez les données par date (ascendante ou descendante)
            data.sort(function(a, b) {
                // Pour un tri ascendant (plus ancienne d'abord)
                return new Date(a.date) - new Date(b.date);

                // Pour un tri descendant (plus récente d'abord)
                return new Date(b.date) - new Date(a.date);
            });

            data.forEach(function(post) {
                images.innerHTML += `
                    <div class="image">
                        <img src="${post.image_url}" alt="${post.title}">
                        <div class="overlay">
                            <a href="${post.lien}" class="icon" title="Informations de l'image"><i class="fa fa-eye"></i></a>
                            <a href="#lightbox" class="icon" title="Afficher en plein écran"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                `;
            });
        });
    });
});

  function getPhotos(val) {
    $.ajax({
    type: "POST",
    url: "get_photos.php",
    data:'id_annees='+val,
    success: function(data){
      $("#photos").html(data);
    }
    });
  }
  
 /*lightbox*/
var lightbox = document.getElementById('lightbox');

// image de la lightbox
var lightboxImage = document.getElementsByClassName('lightbox-content')[0];

// toutes les images de la galerie
var images = document.getElementsByClassName('.fa-expand');

// Parcourez toutes les images
for (var i = 0; i < images.length; i++) {
    var image = images[i];
    
// Ajoutez un écouteur d'événements click à chaque image
    image.addEventListener('click', function(e) {
        // Empêchez l'action par défaut
        e.preventDefault();
        
        // Obtenez l'URL de l'image cliquée
        var imageUrl = this.getElementsByTagName('img')[0].src;
        
        // Mettez à jour l'URL de l'image de la lightbox
        lightboxImage.src = imageUrl;
        
        // Affichez la lightbox
        lightbox.style.display = 'block';
    });
}

// élément "close" de la lightbox
var close = document.getElementsByClassName('close')[0];

// écouteur d'événements click à l'élément "close"
close.addEventListener('click', function() {
    // Cachez la lightbox
    lightbox.style.display = 'none';
});

