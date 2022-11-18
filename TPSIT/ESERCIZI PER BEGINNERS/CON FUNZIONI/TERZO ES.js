let hours = prompt("INSERISCI LE ORE:")
let min = prompt("INSERISCI I MINUTI:")
console.log(CalcHM(hours,min))


function CalcHM(hours,min)
{
    hours = hours*3600000
min = min*60000 
let MStimes = hours + min
return"I MILLISECONDI SONO: " +MStimes
}


