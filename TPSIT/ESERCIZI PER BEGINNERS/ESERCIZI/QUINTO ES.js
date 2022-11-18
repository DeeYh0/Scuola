let hour = parseInt(prompt("INSERISCI L'ORA"))
while(hour>23)
{
    hour = parseInt(prompt("INSERISCI L'ORA"))
}

let minutes = parseInt(prompt("INSERISCI I MINUTI"))
while(minutes>59)
{
    minutes = parseInt(prompt("INSERISCI I MINUTI"))
}

let ny, mosca, ty, x

x = 24-hour
ny = hour-6
ny = (hour+ny+x)%24
alert ("A New York sono le: " +ny+":"+minutes)

mosca = hour+1
mosca = (hour+mosca+x)%24
alert ("A Mosca sono le: " +mosca+":"+minutes)

ty = hour+7
ty = (hour+ty+x)%24
alert ("A Tokyo sono le: " +ty+":"+minutes)

