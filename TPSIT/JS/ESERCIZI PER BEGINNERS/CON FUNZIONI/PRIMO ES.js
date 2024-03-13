let meseI = prompt("INSERISCI UN MESE")
alert(Mesi(meseI));



function Mesi(mese)
{
    if(mese.toLowerCase()=="gennaio" || mese.toLowerCase()=="marzo" || mese.toLowerCase()=="maggio" || mese.toLowerCase()=="luglio" ||mese.toLowerCase()=="agosto" ||mese.toLowerCase()=="ottobre" ||mese.toLowerCase()=="dicembre")
{
    return "IL MESE E' DI 31 GIORNI"
}
else if(mese.toLowerCase()=="aprile" || mese.toLowerCase()=="giugno" || mese.toLowerCase()=="settembre" || mese.toLowerCase()=="novembre")
{
    return "IL MESE E' DI 30 GIORNI"
}
else if(mese.toLowerCase()=="febbraio")
{
    return "FEBBRAIO E' L'UNICO MESE DI 28 GIORNI"
}
}


