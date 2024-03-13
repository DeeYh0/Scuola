let colorButtons = document.querySelectorAll('.button');

colorButtons.forEach(button => {
    button.addEventListener('click', function(event) {
      document.querySelectorAll(".color-square").forEach(s => s.style.border = "none");
      
      event.target.parentElement.style.border = "3px solid black";
      document.querySelector("body").style.background = event.target.parentElement.dataset.color;
    });
});