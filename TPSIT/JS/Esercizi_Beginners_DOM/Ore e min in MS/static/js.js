function CalcHM(hours, min)
{
    hours = hours*3600000
    min = min*60000 
    let MStimes = hours + min
    return "I MILLISECONDI SONO: " +MStimes
}

let Converter = document.querySelector("#Ore_min")
Converter.addEventListener("submit", function(e){
        e.preventDefault()
        let hours = document.querySelector("#hours").value
        let min = document.querySelector("#min").value
        document.querySelector("#output").innerHTML = CalcHM(hours, min)
})
