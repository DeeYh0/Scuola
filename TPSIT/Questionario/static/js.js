function calculateScore() {
  let answers = document.querySelectorAll('input[type="radio"]:checked');
  let totalScore = 0;
  answers.forEach(answer => {
    totalScore += parseInt(answer.value);
  });
  return totalScore;
}

function determinePiatto(score) {
  let piatti = [
    {
      nome: "Popizze",
      descrizione: "Sei un fan delle popizze! Questo piatto ti piace croccante e saporito.",
      valore: 30
    },
    {
      nome: "Sgagliozze",
      descrizione: "Sei un fan delle sgagliozze! Questo piatto ti piace salato e croccante.",
      valore: 60
    },
    {
      nome: "Panzerotto",
      descrizione: "Sei un fan dei panzerotti! Questo piatto ti piace morbido e cotto al punto giusto.",
      valore: 90
    }
  ];

  let closestPiatto = piatti[0];
  piatti.forEach(piatto => {
    if (Math.abs(piatto.valore - score) < Math.abs(closestPiatto.valore - score)) {
      closestPiatto = piatto;
    }
  });

  return closestPiatto;
}

let submitButton = document.getElementById("submit-button");
submitButton.addEventListener("click", function(event) {
  event.preventDefault(); 

  let numQuestions = 5;
  let numAnswers = document.querySelectorAll('input[type="radio"]:checked').length;
  if (numAnswers < numQuestions) {
    document.getElementById("result").innerHTML = "OPS! HAI SALTATO QUALCHE DOMANDA E NON RIESCO A CAPIRE CHE PIATTO SEI!";
    return;
  }

  let score = calculateScore();

  let piatto = determinePiatto(score);

  let resultElement = document.getElementById("result");
  resultElement.innerHTML = `Sei un ${piatto.nome}! ${piatto.descrizione}`;

  submitButton.disabled = true;
});

let resetButton = document.getElementById("reset-button");
resetButton.addEventListener("click", function() {

  let answers = document.querySelectorAll('input[type="radio"]');
  answers.forEach(answer => {
    answer.checked = false;
  });

  document.getElementById("result").innerHTML = "";
  submitButton.disabled = false;
});

