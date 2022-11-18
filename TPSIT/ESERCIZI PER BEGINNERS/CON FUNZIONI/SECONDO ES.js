let voto = prompt("INSERISCI IL VOTO")
console.log(VotiCalc(voto))

function VotiCalc(voto)
{
    if(parseFloat(voto)<=5.9)
    {
        return "IL VOTO E' INSUFFICIENTE"
    }
    else if(parseFloat(voto)>=6 && parseFloat(voto)<=6.9)
    {
        return "IL VOTO E' SUFFICIENTE"
    }
    else if(parseFloat(voto)>=7 && parseFloat(voto)<=7.9)
    {
        return "IL VOTO E' DISCRETO"
    }
    else if(parseFloat(voto)>=8)
    {
        return "IL VOTO E' BUONO"
    }
     
}
