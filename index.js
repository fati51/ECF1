
const btn = document.querySelector('#btn');
const text = document.querySelector('#text');


window.addEventListener('load', () => {
  
  const isTextVisible = localStorage.getItem('textVisible');

  
  if (isTextVisible === 'true') {
    text.style.display = 'block';
  } else {
    text.style.display = 'none';
  }
});

btn.addEventListener('click', () => {
  text.style.display = 'block';
  localStorage.setItem('textVisible', 'true');
});


window.addEventListener('beforeunload', () => {
  localStorage.setItem('textVisible', 'false');
});


const recipeCards = document.querySelectorAll("#recipe-cards .card");

recipeCards.forEach((card) => {
  card.addEventListener("click", () => {
    const title = card.querySelector(".card-title").textContent;
    const description = card.querySelector(".card-text").textContent;
    const imagePath = card.querySelector(".card-img-top").getAttribute("src");

    const newWindow = window.open("", "_blank");
    newWindow.document.write(`
      <html>
      <head>
        <title>Détails de la recette</title>
      </head>
      <body>
        <h2>${title}</h2>
        <img src="${imagePath}" alt="${title}">
        <p>${description}</p>
        <script>
          window.addEventListener('beforeunload', () => {
            window.opener.postMessage('recipeDetailsClosed', '*');
          });
        </script>
      </body>
      </html>
    `);
  });
});

window.addEventListener('message', (event) => {
  if (event.data === 'recipeDetailsClosed') {
    text.style.display = 'none';
  }
});








