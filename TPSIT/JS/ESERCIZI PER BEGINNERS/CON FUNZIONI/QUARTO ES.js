let degreesF = prompt("INSERISCI UNA TEMPERATURA IN GRADI FARENHEIT:")
alert(CalcCelsius(degreesF))

function CalcCelsius(degreesF)
{
    let degreesC = (degreesF-32)*5/9
    return "IN GRADI CELSIUS SONO: "+degreesC
}
