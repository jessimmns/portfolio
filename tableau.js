// Container des articles
let articlesContainer = document.getElementById("articlesContainer");

// Liste des articles (initiale avec un article)
let articles = [
  {
    title: "L'Impact de la Technologie",
    author: "Jean Dupont",
    source: "Le Journal Technologique",
    date: "2025-02-12",
    summary: "Cet article explore l'impact de la technologie sur notre quotidien..."
  }
];

// Fonction pour afficher un article
function renderArticles() {
  articlesContainer.innerHTML = ""; // Vider le container des articles

  articles.forEach((article, index) => {
    let articleCard = document.createElement("div");
    articleCard.classList.add("card");

    articleCard.innerHTML = `
      <h2 class="title">${article.title}</h2>
      <p class="author">Auteur: ${article.author}</p>
      <p class="source">Source: ${article.source}</p>
      <p class="date">Date: ${article.date}</p>
      <div class="summary">
        <p><strong>Résumé:</strong> ${article.summary}</p>
      </div>
      <button class="button" onclick="editArticle(${index})">Modifier</button>
      <button class="delete-button" onclick="deleteArticle(${index})">Supprimer</button>
    `;

    articlesContainer.appendChild(articleCard);
  });
}

// Afficher les articles au démarrage
renderArticles();

// Bouton Ajouter un article
document.getElementById("addArticleBtn").addEventListener("click", function() {
  // Ouvrir l'éditeur vide pour ajouter un article
  document.getElementById("editor").style.display = 'block';
  document.getElementById("newTitle").value = '';
  document.getElementById("newAuthor").value = '';
  document.getElementById("newSource").value = '';
  document.getElementById("newDate").value = '';
  document.getElementById("saveButton").onclick = saveNewArticle;
});

// Sauvegarder un nouvel article
function saveNewArticle() {
  let newTitle = document.getElementById("newTitle").value;
  let newAuthor = document.getElementById("newAuthor").value;
  let newSource = document.getElementById("newSource").value;
  let newDate = document.getElementById("newDate").value;

  let newArticle = {
    title: newTitle,
    author: newAuthor,
    source: newSource,
    date: newDate,
    summary: "Résumé non ajouté."
  };

  articles.push(newArticle); // Ajouter l'article à la liste
  renderArticles(); // Re-rendre les articles
  closeEditor();
}

// Modifier un article
function editArticle(index) {
  let article = articles[index];

  document.getElementById("newTitle").value = article.title;
  document.getElementById("newAuthor").value = article.author;
  document.getElementById("newSource").value = article.source;
  document.getElementById("newDate").value = article.date;

  document.getElementById("saveButton").onclick = function() {
    saveEditedArticle(index);
  };

  document.getElementById("editor").style.display = 'block';
}

// Sauvegarder les modifications d'un article
function saveEditedArticle(index) {
  articles[index].title = document.getElementById("newTitle").value;
  articles[index].author = document.getElementById("newAuthor").value;
  articles[index].source = document.getElementById("newSource").value;
  articles[index].date = document.getElementById("newDate").value;

  renderArticles(); // Re-rendre les articles
  closeEditor();
}

// Supprimer un article
function deleteArticle(index) {
  // Supprimer l'article de la liste
  articles.splice(index, 1);
  
  // Re-rendre la liste mise à jour
  renderArticles();
}

// Fermer l'éditeur
document.getElementById("cancelButton").addEventListener("click", closeEditor);

function closeEditor() {
  document.getElementById("editor").style.display = 'none';
}
