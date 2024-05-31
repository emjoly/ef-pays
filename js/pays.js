(function () {
    document.addEventListener('DOMContentLoaded', function () {
        let bouton_categorie = document.querySelectorAll(".bouton_categorie");

        bouton_categorie.forEach((button) => {
            button.addEventListener('click', function () {
                let keyword = this.getAttribute("data-keyword");
                let url = `https://gftnth00.mywhc.ca/tim05/wp-json/wp/v2/posts?search=${encodeURIComponent(keyword)}`;

                fetch(url)
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error("La requête a échoué avec le statut " + response.status);
                        }
                        return response.json();
                    })
                    .then(function (data) {
                        let restapi = document.querySelector(".contenu__restapi");
                        restapi.innerHTML = "";

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
                        console.error("Erreur lors de la récupération des données:", error);
                    });
            });
        });
    });
})();