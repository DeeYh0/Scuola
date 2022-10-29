let x=600
let y=300
let diametro=100
let raggio= diametro/2

function setup()
{
    createCanvas(600, 300)
}

function draw()
{
    background(0, 255, 0)
    
    drawFlower(x/2, y/2 , diametro, raggio)
    drawFlower(x, y/2 , diametro, raggio)
    drawFlower(0, y/2, diametro, raggio)

function drawFlower(w, h , diametro , raggio)
{
    strokeWeight(3)
    fill(255,117,20)
    circle(w+raggio, h-raggio, diametro)

    strokeWeight(3)
    fill(255,117,20)
    circle(w+raggio, h+raggio, diametro)
    
    strokeWeight(3)
    fill(255,117,20)
    circle(w-raggio, h-raggio, diametro)

    strokeWeight(3)
    fill(255,117,20)
    circle(w-raggio, h+raggio, diametro)

    strokeWeight(3)
    fill(255,0,0)
    circle(w, h, diametro)

  }
}