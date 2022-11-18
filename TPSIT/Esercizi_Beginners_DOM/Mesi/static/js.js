function Mesi(mese)
{
     if(mese.value.toLowerCase()=="gennaio" || mese.value.toLowerCase()=="marzo" || mese.value.toLowerCase()=="maggio" || mese.value.toLowerCase()=="luglio" ||mese.value.toLowerCase()=="agosto" ||mese.value.toLowerCase()=="ottobre" ||mese.value.toLowerCase()=="dicembre")
    {
        return "IL MESE E' DI 31 GIORNI"
    }
     else if(mese.value.toLowerCase()=="aprile" || mese.value.toLowerCase()=="giugno" || mese.value.toLowerCase()=="settembre" || mese.value.toLowerCase()=="novembre")
    {
        return "IL MESE E' DI 30 GIORNI"
    }
     else if(mese.value.toLowerCase()=="febbraio")
    {
        return "FEBBRAIO E' L'UNICO MESE DI 28 GIORNI"
    }
}

let InputMonths = document.querySelector("#days")
InputMonths.addEventListener("submit", function(e){
        e.preventDefault()
        let Months = document.querySelector("#user_input")
        let output = document.querySelector("#output")
        output.innerHTML = Mesi(Months)
})

