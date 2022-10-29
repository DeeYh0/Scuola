let diameter = 50;
let height = 300;
let width = diameter;
let radius = diameter/2;
let delta = 5;

function setup()
{
    createCanvas(600, 300);
}



function draw()
{
    background(0, 210, 0); // esegue il background all' infinito

    drawFlower(width, height/2, diameter, radius);

    if(width < diameter)
    {
        delta = Math.abs(delta);
    }

    else if(width > 600 - diameter)
    {
        delta = delta * (-1);
    }

    width = delta + width;

}



function drawFlower(width, height , diameter, radius)
{

strokeWeight(3);

fill(255, 140, 0); //cerchi intorno 
circle(width - radius, height - radius, diameter);
circle(width + radius, height + radius, diameter);
circle(width - radius, height + radius, diameter);
circle(width + radius, height - radius, diameter);

fill(255, 0, 0); //cerchio centrale
circle(width, height, diameter);

}