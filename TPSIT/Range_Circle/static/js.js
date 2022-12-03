let ax = 0.01
let vx = 0
let ay = 0.01
let vy = 0
let y = 0
let x = 0
let W = 1000
let H = 400
let diameter = 70


let xInput = document.querySelector("[name = accelerazioneX]")
let yInput = document.querySelector("[name = accelerazioneY]")

xInput.addEventListener("input", function(x){
    console.log(`Value X changed -> ${xInput.value}`)
    ax = parseFloat(xInput.value)
})

yInput.addEventListener("input", function(y){
    console.log(`Value Y changed -> ${yInput.value}`)
   ay = parseFloat(yInput.value)

})

function setup()
{
    createCanvas(W, H)
}


function draw()
{
    background("grey")

    strokeWeight(3)
    fill("red")
    circle(x, y, diameter)
    vx = vx + ax
    x = x + vx

    vy = vy - ay
    y = y - vy
    
    if(x >= 1025)
    {
        x = 0
    }

    if(x <= -25)
    {
        x = 1025
    }

    if(y >= 425)
    {
        y = 0
    }

    if(y <= -25)
    {
        y = 425
    }
 
}


































