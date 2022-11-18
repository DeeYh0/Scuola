let hour = parseInt(prompt("INSERISCI L'ORA"))
let minutes = parseInt(prompt("INSERISCI I MINUTI"))
let ny, mosca, ty, x
x = 24-hour

alert(NY(ny))
alert(Moscow(mosca))
alert(Tokyo(ty))

function Control(hour, minutes)
{
    while(hour>23)
{
    hour = parseInt(prompt("INSERISCI L'ORA"))
}
while(minutes>59)
{
    minutes = parseInt(prompt("INSERISCI I MINUTI"))
}
}

function NY(ny)
{
    ny = hour-6
    ny = (hour+ny+x)%24
    return "A New York sono le: " +ny+":"+minutes
}

function Moscow(mosca) 
{
    mosca = hour+1
    mosca = (hour+mosca+x)%24
    return "A Mosca sono le: " +mosca+":"+minutes
}

function Tokyo(ty) 
{
    ty = hour+7
    ty = (hour+ty+x)%24
    return "A Tokyo sono le: " +ty+":"+minutes
}







