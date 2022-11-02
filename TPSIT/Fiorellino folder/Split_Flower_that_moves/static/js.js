let x = 600;
let y = 300;

let diameter = 50;
let radius = diameter/2;

let i=diameter;
let k=diameter;

function setup()
{
    createCanvas(600, 300);
    background(0, 210, 0);
    frameRate(3);
}


function draw()
{
    
    if (i < (x / diameter) * diameter === true)
    {
        drawFlower(i, k, diameter);
        i = i+(diameter * 2);
    }
    
    else
    {
        i = diameter;
        k = k+(diameter * 2);
    }
    
    if (k > (y / diameter) * diameter === true)
    {
        noLoop();
    }
}


function drawFlower(x, y, diameter)
{

    strokeWeight(3);

    fill(255, 140, 0); //cerchi attorno 
    circle(x - radius, y - radius, diameter);
    circle(x + radius, y + radius, diameter);
    circle(x - radius, y + radius, diameter);
    circle(x + radius, y - radius, diameter);

    fill(255, 0, 0); //cerchio centrale
    circle(x, y, diameter);

}