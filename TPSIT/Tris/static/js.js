let cells = document.querySelectorAll(".cell");
let currentPlayer = 0;
let Combinations = [  [0, 1, 2],
  [3, 4, 5],
  [6, 7, 8],
  [0, 3, 6],
  [1, 4, 7],
  [2, 5, 8],
  [0, 4, 8],
  [2, 4, 6]
];
let counter = 0;
for(let i = 0; i < cells.length; i++) {
    cells[i].addEventListener("click", function(e) {
        e.preventDefault();

        if(!cells[i].innerHTML) { 
            if(currentPlayer === 0) { 
                cells[i].innerHTML = "X"; 
                currentPlayer = 1;
            } else {
                cells[i].innerHTML = "O"; 
                currentPlayer = 0;
            }
            win();
            tie();
            counter++;
        }
    });
}

function win() {
    for (let i = 0; i < Combinations.length; i++) {
        let combination = Combinations[i];
        let a = cells[combination[0]].innerHTML;
        let b = cells[combination[1]].innerHTML;
        let c = cells[combination[2]].innerHTML;
        if (a === b && b === c && a === "X") {
            alert("Player 1 ha vinto!");
        }
        else if (a === b && b === c && a === "O"){
            alert("Player 2 ha vinto!");        
        }
    }
}

function tie() {
    if(counter === 9 && !win()){
        alert("Pareggio!");
    }
}

let resetBtn = document.querySelector(".reset")
    resetBtn.addEventListener("click", function(event){ 
        event.preventDefault(); 
        for (let i = 0; i < cells.length; i++) {
            cells[i].innerHTML = ""; 
        }
        currentPlayer = 0;
        counter = 0;
    });

