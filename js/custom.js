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
        // D'abord récupérer l'ID de la catégorie note-panier
        fetch('/wp-json/wp/v2/categories?slug=note-panier')
            .then(response => response.json())
            .then(categories => {
                if (categories.length > 0) {
                    const categoryId = categories[0].id;
                    // Ensuite récupérer les posts avec cet ID de catégorie
                    return fetch(`/wp-json/wp/v2/posts?categories=${categoryId}`);
                }
            })
            .then(response => response.json())
            .then(posts => {
                if (posts && posts.length > 0) {
                    // Créer un élément temporaire pour décoder le HTML
                    const temp = document.createElement('div');
                    temp.innerHTML = posts[0].content.rendered;
                    
                    // Récupérer le texte décodé et le nettoyer
                    const placeholderText = temp.textContent
                        .replace(/\s*\n\s*/g, '\n') // Garde les retours à la ligne en supprimant les espaces superflus
                        .replace(/\s+/g, ' ') // Remplace les espaces multiples par un seul
                        .trim(); // Enlève les espaces au début et à la fin
                        
                    customerNotesTextarea.placeholder = placeholderText;
                }
            })
            .catch(error => console.error('Erreur lors de la récupération du post:', error));
    }

    // Réorganiser le menu principal et ajouter le lien de retour
    const mainMenu = document.getElementById('sunshine--main-menu');
    if (mainMenu) {
        // Créer un conteneur flex
        const menuContainer = document.createElement('div');
        menuContainer.className = 'sunshine--menu-container';
        
        // Créer le lien de retour
        const returnToOrders = document.createElement('div');
        returnToOrders.className = 'return-to-orders';
        returnToOrders.innerHTML = `
            <nav aria-label="Return navigation">
                <ul>
                    <li class="sunshine--orders">
                        <a href="/commandes/">
                            <i class="fas fa-arrow-left"></i>
                            <span class="sunshine--main-menu--name">Retour à la liste des commandes</span>
                        </a>
                    </li>
                </ul>
            </nav>
        `;

        // Déplacer les éléments dans le nouveau conteneur
        mainMenu.parentNode.insertBefore(menuContainer, mainMenu);
        menuContainer.appendChild(returnToOrders);
        menuContainer.appendChild(mainMenu);
    }

    // Ajouter une icône de panier à sunshine--cart
    const cartLink = document.querySelector('.sunshine--cart a');
    if (cartLink) {
        const cartIcon = document.createElement('i');
        cartIcon.className = 'fas fa-shopping-cart';
        cartLink.insertBefore(cartIcon, cartLink.firstChild);
    }
});