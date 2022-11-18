let mese = prompt("INSERISCI UN MESE")

if(mese.toLowerCase()=="gennaio" || mese.toLowerCase()=="marzo" || mese.toLowerCase()=="maggio" || mese.toLowerCase()=="luglio" ||mese.toLowerCase()=="agosto" ||mese.toLowerCase()=="ottobre" ||mese.toLowerCase()=="dicembre")
{
    alert("IL MESE E' DI 31 GIORNI")
}
else if(mese.toLowerCase()=="aprile" || mese.toLowerCase()=="giugno" || mese.toLowerCase()=="settembre" || mese.toLowerCase()=="novembre")
{
    alert("IL MESE E' DI 30 GIORNI")
}
else if(mese.toLowerCase()=="febbraio")
{
    alert("FEBBRAIO E' L'UNICO MESE DI 28 GIORNI")
}