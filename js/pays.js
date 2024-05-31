(function () {
    let categories;
    let bouton_categorie = document.querySelectorAll(".bouton_categorie");

    // Add a click event listener to each button
    bouton_categorie.forEach ((button) => {
    button.addEventListener('click', function () {
        // Capture the category ID
        categories = this.id.split("_")[1];
        let url = `https://gftnth00.mywhc.ca/tim05/wp-json/wp/v2/posts?categories=${categories}`;

        fetch(url)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error(
                        "La requête a échoué avec le statut " + response.status
                    );
                }
                return response.json();
                console.log(response.json());
            })
            .then(function (data) {
                console.log(data);
                let restapi = document.querySelector(".contenu__restapi");
                restapi.innerHTML = "";
                console.log(restapi);
                data.forEach(function (article) {
                    let titre = article.title.rendered;
                    let contenu = article.content.rendered;
                    contenu = contenu.slice(0, 100) + "...";

                    let carte = document.createElement("div");
                    carte.classList.add("restapi__carte");
                    carte.innerHTML = `
                        <h2>${titre}</h2>
                        <p>${contenu}</p>
                    `;
                    restapi.appendChild(carte);
                });
            })
            .catch(function (error) {
            // Handle errors
            console.error("Erreur lors de la récupération des données:", error);
        });
    });
    }
)})();
