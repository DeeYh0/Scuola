let categoriesSelect = document.querySelector('#categories');
let loadJokeButton = document.querySelector('#load-joke');
let jokeContainer = document.querySelector('#joke');

fetch('https://api.chucknorris.io/jokes/categories')
  .then(response => response.json())
  .then(categories => {
    categories.forEach(category => {
      let option = document.createElement('option');
      option.value = category;
      option.textContent = category;
      categoriesSelect.appendChild(option);
    });
  });

loadJokeButton.addEventListener('click', () => {
  let url = 'https://api.chucknorris.io/jokes/random';
  let category = categoriesSelect.value;
  if (category) {
    url += `?category=${encodeURIComponent(category)}`;
  }

  fetch(url)
    .then(response => response.json())
    .then(data => {
      jokeContainer.innerHTML = `<p style="font-family: 'Concert One'; font-size: 19px">${data.value}</p>`;

      let jokeLink = document.createElement('a');
      jokeLink.href = data.url;
      jokeLink.target = "_blank";
      jokeLink.innerHTML = "Link alla battuta";
      let jokeLinkContainer = document.querySelector('#joke-link');
      jokeLinkContainer.innerHTML = '';
      jokeLinkContainer.appendChild(jokeLink);
    });
});

let copyButton = document.querySelector('#copyText');
let feedback = document.querySelector('.feedback');

  copyButton.addEventListener('click', () => {
    let jokeText = jokeContainer.querySelector('p').innerText;
    navigator.clipboard.writeText(jokeText);
    feedback.textContent = 'Battuta copiata!';
    setTimeout(() => {
      feedback.textContent = '';
    }, 1000);
  });


