let x = 600;
let y = 300;
let i, k;

let diameter = 30;
let radius = diameter/2;


function setup()
{
    createCanvas(600, 300);
    background(0, 210, 0);
}



function draw()
{
    drawFlower(10, 10); //fiore basic

    for (i=diameter; i<(x / diameter)*diameter; i=i+(diameter * 2))
    {
        for (k=diameter; k<(y / diameter)*diameter; k=k+(diameter * 2))
        {
            drawFlower(i, k, diameter, radius)
        }
    }

}



function drawFlower(x, y, diameter, radius)
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