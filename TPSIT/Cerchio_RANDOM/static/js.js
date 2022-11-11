function setup()
{
    createCanvas(600, 300)
    background(0, 210, 0)
    frameRate(70)
    
}


function draw()
{
    if(frameCount<=1000)
    {
        fill("white")
        rect(520,120, 64,40 );
        let witdh = random(450)
        let height = random(300)
        let diameter = random(30 , 90)
        let r = random(0 , 255)
        let g = random(0 , 255)
        let b = random(0 , 255)
        
        fill(r, g, b)
        circle(witdh, height, 100)


        //frame counter
        textSize(30);
        textAlign(CENTER);
        fill("black");
        text(frameCount, 550, 150);
        
    }
    
    else
    {
        frameCount=0
        background(0, 210, 0)
    }
}