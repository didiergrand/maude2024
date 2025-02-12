
  // Fonction pour récupérer les paramètres de l'URL
  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  // Récupérer l'email depuis l'URL
  const emailFromUrl = getQueryParam('email');

  // Si un email est présent dans l'URL, le pré-remplir dans le champ du formulaire
  if (emailFromUrl) {
    const emailInput = document.getElementById('email');
    if (emailInput) {
      emailInput.value = emailFromUrl;
    }
  }