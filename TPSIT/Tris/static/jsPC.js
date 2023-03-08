let cells = document.querySelectorAll('.cell');
let board = [
  ["", "", ""],
  ["", "", ""],
  ["", "", ""],
];

let count = 0;

function getEmptyCells(board) {
  let emptyCells = [];
  for (let row = 0; row < 3; row++) {
    for (let col = 0; col < 3; col++) {
      if (board[row][col] === "") {
        emptyCells.push([row, col]);
      }
    }
  }
  return emptyCells;
}

function getBestMove(board) {
  let emptyCells = getEmptyCells(board);
  return emptyCells[0];
}

function minimax(board, player) {
  if (GameOver(board)) {
    if (isWinner(board, "O")) {
      return 1;
    } else if (isWinner(board, "X")) {
      return -1;
    } else {
      return 0;
    }
  }

  let bestScore = player === "O" ? -Infinity : Infinity;
  let emptyCells = getEmptyCells(board);

  for (let [row, col] of emptyCells) {
    board[row][col] = player;
    let score = minimax(board, player === "O" ? "X" : "O");
    board[row][col] = "";

    if (player === "O") {
      bestScore = Math.max(score, bestScore);
    } else {
      bestScore = Math.min(score, bestScore);
    }
  }

  return bestScore;
}

cells.forEach(cell => {
  cell.addEventListener("click", () => {
    if (cell.innerHTML === "") {

    //PLAYER
      cell.innerHTML = "X";
      let row = cell.parentNode.rowIndex; //riferito al <tr>
      let col = cell.cellIndex; //riferito al <td>
      board[row][col] = "X";
      count++;
      
      if (GameOver(board)) {
        alert("HAI VINTO!");
        document.getElementById("p1").innerHTML = parseInt(document.getElementById("p1").textContent) + 1
        count = 0;
        return;
      }

    //PC
      let [rowIndex, colIndex] = getBestMove(board);
      let computerCell = cells[rowIndex * 3 + colIndex];
      computerCell.innerHTML = "O";
      board[rowIndex][colIndex] = "O";
      count++;

      if (GameOver(board)) {
        alert("GAME OVER! PC HA VINTO!");
        document.getElementById("p2").innerHTML = parseInt(document.getElementById("p2").textContent) + 1
        count = 0;
        return;
      }
    }
  });
});

function GameOver(board) {
  //Righe
  for (let row = 0; row < 3; row++) {
    if (board[row][0] !== "" && board[row][0] === board[row][1] && board[row][1] === board[row][2]) {
      return true;
    }
  }

  //Colonne
  for (let col = 0; col < 3; col++) {
    if (board[0][col] !== "" && board[0][col] === board[1][col] && board[1][col] === board[2][col]) {
      return true;
    }
  }

  //Diagonali
  if (board[0][0] !== "" && board[0][0] === board[1][1] && board[1][1] === board[2][2]) {
    return true;
    }
    if (board[0][2] !== "" && board[0][2] === board[1][1] && board[1][1] === board[2][0]) {
    return true;
    }

    //Celle vuote
    for (let row = 0; row < 3; row++) {
    for (let col = 0; col < 3; col++) {
    if (board[row][col] === "") {
    return false;
     }
  }
}

if(count == 9){
  alert("Pareggio!");
} 

  return true;
}


let resetBtn = document.querySelector(".reset")
resetBtn.addEventListener("click", function(event){ 
event.preventDefault(); 
for (let i = 0; i < cells.length; i++) {
  cells[i].innerHTML = ""; 
}
  board = [
    ['', '', ''],
    ['', '', ''],
    ['', '', ''],
  ];

  count = 0;
});
