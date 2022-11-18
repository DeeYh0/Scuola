let voto = prompt("INSERISCI IL VOTO")

if(parseFloat(voto)<=5.9)
{
    console.log("IL VOTO E' INSUFFICIENTE")
}
else if(parseFloat(voto)>=6 && parseFloat(voto)<=6.9)
{
    console.log("IL VOTO E' SUFFICIENTE")
}
else if(parseFloat(voto)>=7 && parseFloat(voto)<=7.9)
{
    console.log("IL VOTO E' DISCRETO")
}
else if(parseFloat(voto)>=8)
{
    console.log("IL VOTO E' BUONO")
}
