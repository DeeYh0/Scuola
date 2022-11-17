let angle = 0
let ampiezza = 100

function setup()
{
    createCanvas(1000, 400)
    background(220)
    frameRate(700)
    
    angleMode(DEGREES)
    line(0,200, 1000,200 )
    //line(X0,Y0, X1,Y1)  
}

function draw()
{
  //console.log(angle,sin(angle))
  SIN()
  COS()
}

function SIN()
{
  stroke("rgb(255,0,0)")
  let y = ampiezza*(sin(angle))
  point(angle, y+200)
  
  angle += 1
}

function COS()
{
  stroke("rgb(0,0,255)")
  let Ycos = ampiezza*(cos(angle))
  point(angle, Ycos+200)
}

