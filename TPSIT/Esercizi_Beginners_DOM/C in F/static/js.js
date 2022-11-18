function CalcCelsius(degreesF)
{
    let degreesC = (degreesF-32)*5/9
    return "IN GRADI CELSIUS SONO: "+degreesC 
}


let InputDegrees = document.querySelector("#degrees")
InputDegrees.addEventListener("submit", function(e){
        e.preventDefault()
        let Celsius = document.querySelector("#user_input").value
        let output = document.querySelector("#output")
        output.innerHTML = CalcCelsius(Celsius)
})

