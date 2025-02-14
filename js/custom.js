document.addEventListener('DOMContentLoaded', function() {
    // Find preloader element
    const preloader = document.querySelector('.preloader');
    
    if (preloader) {        
        // Remove preloader after animation
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    }
    
    document.querySelectorAll('.category-bienvenue > .entry-content').forEach(category => {
        // Créer un nouveau div pour envelopper les figures
        let wrapperbienvenue = document.createElement('div');
        wrapperbienvenue.className = 'bienvenue-images';

        // Trouver toutes les figures et les déplacer dans le nouveau div
        let figures = category.querySelectorAll('figure');

        figures.forEach(figure => {
            wrapperbienvenue.appendChild(figure);

        });

        // Ajouter le nouveau div au début de la catégorie
        category.insertBefore(wrapperbienvenue, category.firstChild);


        // Créer un nouveau div pour envelopper les paragraphes
        let wrapperparagraph = document.createElement('div');
        wrapperparagraph.className = 'bienvenue-paragraphs';

        // trouver le titre de la catégorie
        let title = category.querySelector('header.entry-header');
        wrapperparagraph.appendChild(title);

        // Trouver toutes les figures et les déplacer dans le nouveau div
        let paragraphs = category.querySelectorAll('p');
        paragraphs.forEach(paragraph => {
            wrapperparagraph.appendChild(paragraph);
        });

        // Ajouter le nouveau div au début de la catégorie
        category.insertBefore(wrapperparagraph, category.firstChild);
    });
    // for every empty .tarifs-detail .wp-block-column background color is set to transparent
    document.querySelectorAll('.tarifs-detail .wp-block-column').forEach(column => {
        if (column.innerHTML.trim() !== '') {
            column.style.backgroundColor = '#D9D4CC';
        }
    });
    
    // Add a "Return to Cart" link inside the checkout
    const checkoutElement = document.getElementById('sunshine--checkout--standalone');
    if (checkoutElement) {
        const checkoutH1 = checkoutElement.querySelector('h1');
        if (checkoutH1) {
            const returnLink = document.createElement('div');
            returnLink.className = 'return-to-cart';
            returnLink.innerHTML = '<a href="/commandes/panier/">Retour au panier</a>';        
            checkoutElement.insertBefore(returnLink, checkoutH1);
        }
    }

    // Récupérer le textarea des notes client
    const customerNotesTextarea = document.getElementById('customer_notes');
    
    if (customerNotesTextarea) {
        // Appel à l'API WordPress pour récupérer les posts publiés de la catégorie note-panier
        fetch('/wp-json/wp/v2/posts?categories=note-panier')
            .then(response => response.json())
            .then(posts => {
                if (posts.length > 0) {
                    // Utiliser le contenu du premier post trouvé
                    const placeholderText = posts[0].content.rendered
                        .replace(/<[^>]*>/g, '') // Enlever les balises HTML
                        .trim(); // Enlever les espaces
                    customerNotesTextarea.placeholder = placeholderText;
                }
            })
            .catch(error => console.error('Erreur lors de la récupération du post:', error));
    }
});