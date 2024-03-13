let x = 0
let y = 0
let j = 10 //spazio tra le linee


let lineInput = document.querySelector("[name = linea]")
lineInput.addEventListener("input", function(y){
    console.log(`Line changed -> ${lineInput.value}`)
    j = parseInt(lineInput.value)
    reset()
})

function setup()
{
    createCanvas(300, 300)
    background("black")
}

function draw()
{
    if(random(10) < 5)
    {
        stroke(255)
        line(x, y, x+j, y+j)
    }
    else
    {
        stroke(255)
        line(x, y+j, x+j, y)
    }
    x += j
    if(x > width)
    {
        x = 0
        y = y+j
    }
}

function reset()
{
    x = 0
    y = 0
    j = 10
    background("black")
}