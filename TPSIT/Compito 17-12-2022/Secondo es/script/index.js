let w = 400
let h = 400
let Xo = 0
let Yo = 0


function setup()
{
    createCanvas(w, h);
    background(220)
}


function draw()
{
    let r = random()

    if (r < 0.5)
    {
        tri(Xo, Yo, 20, 0, 0)
    }
        else if (r >= 0.25 && r <= 0.50)
    {
        tri(Xo, Yo, 20, 0, 1)
    }
        else if(r > 0.50 && r <= 0.75)
    {
        tri(Xo, Yo, 20, 1, 0)
    }
        else
    {
        tri(Xo, Yo, 20, 1, 1)
    }

    Xo += 20

        if (Xo >= w)
        {
            Xo = 0;
            Yo += 20;
        }
}

function tri(x, y, lenght, t, c) //t = tipo di quadrato      c = colore dei triangoli
{
    noStroke()
    if (t === 0)
    {
        if (c === 0)
        {
            fill(255,255,255)
        }
        else if (c === 1)
        {
            fill(0,0,0);
        }
        triangle(x, y, x + lenght, y, x, y + lenght)
        if (c === 0)
        {
            fill(0,0,0);
        }
        else if (c === 1)
        {
            fill(255,255,255);
        }
        triangle(x, y + lenght, x + lenght, y + lenght, x + lenght, y)
        } 
        else
        {
        if (c === 0)
        {
            fill(0,0,0)
        }
        else if (c === 1)
        {
            fill(255,255,255);
        }
        triangle(x, y, x + lenght, y, x + lenght, y + lenght)

        if (c === 0)
        {
            fill(255,255,255)
        }
        else if (c === 1)
        {
            fill(0,0,0)
        }
        triangle(x, y, x, y + lenght, x + lenght, y + lenght)
    }

}