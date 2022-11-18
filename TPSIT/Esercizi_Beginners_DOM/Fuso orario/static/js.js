function NW(NewYork, min)
{
    if( NewYork < 24 && NewYork > 0 )
    {
        NewYork = NewYork - 6 

        if( NewYork < 0 )
        {
            NewYork = 24 + NewYork
            return "A NEW YORK SONO LE "+ NewYork+ ":"+min
        }
        
        else
        {
            return "A NEW YORK SONO LE "+ NewYork+ ":"+min
        }
    }
}

function TY(Tokyo, min)
{
    if( Tokyo < 24 && Tokyo > 0 )
    {
        Tokyo = Tokyo + 7

        if( Tokyo >= 24 )
        {
            Tokyo = Tokyo - 24
            return "A TOKYO SONO LE "+ Tokyo+ ":"+min
        }

        else
        {
            return "A TOKYO SONO LE "+ Tokyo+ ":"+min
        }
    }
}
    
function MO(Mosca, min)
{
    if( Mosca < 24 && Mosca > 0 )
    {
        Mosca = Mosca + 1

        if( Mosca >= 24 )
        {
            Mosca = Mosca - 24
            return "A MOSCA SONO LE "+ Mosca+ ":"+min
        }

        else
        {
            return "A MOSCA SONO LE "+ Mosca+ ":"+min
        }
    }
}


let Input = document.querySelector("#time_zone")
Input.addEventListener("submit", function(e){
        e.preventDefault()
        let hours = document.querySelector("#hours").value
        let min = document.querySelector("#min").value
        document.querySelector("#NEWYORK").innerHTML = NW(hours, min)
        document.querySelector("#TOKYO").innerHTML = TY(hours, min)
        document.querySelector("#MOSCA").innerHTML = MO(hours, min)
})
