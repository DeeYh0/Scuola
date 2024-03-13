function VotiCalc(voto)
{
    if(voto<=5.9)
    {
        return "E' INSUFFICIENTE"
    }
    else if(voto>=6 && voto<=6.9)
    {
        return "E' SUFFICIENTE"
    }
    else if(voto>=7 && voto<=7.9)
    {
        return "E' DISCRETO"
    }
    else if(voto>=8 && voto<=10)
    {
        return "E' BUONO"
    }
    else if(voto>10)
    {
        return "NON ESISTONO VOTI MAGGIORI DI 10"
    }
     
}


let InputMark = document.querySelector("#Mark")
InputMark.addEventListener("submit", function(e){
        e.preventDefault()
        let marks = document.querySelector("#user_input").value
        let output = document.querySelector("#output")
        output.innerHTML = VotiCalc(marks)
})

