function setup()
{
    createCanvas(600, 300)
    background(0, 210, 0)
    frameRate(5)
}


function draw()
{
    let witdh = random(600)
    let height = random(300)
    let diameter = random(30 , 90)
    let r = random(0 , 255)
    let g = random(0 , 255)
    let b = random(0 , 255)
    
    fill(r, g, b)
    circle(witdh, height, 100)
}



function drawFlower(x, y, diameter, radius)
{
    
    
    strokeWeight(3)

    fill(r, g, b) //cerchi intorno 
    circle(width - radius, height - radius, diameter)
    circle(width + radius, height + radius, diameter)
    circle(width - radius, height + radius, diameter)
    circle(width + radius, height - radius, diameter)

    fill(r, g, b)  //cerchio centrale
    circle(width, height, diameter)


}