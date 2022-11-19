let ampiezza = 100
let frequenza = 0.1
let fase = 0 
let angle = 0 
let increment = 0.01
let W = 1000
let H = 400


let amplitudeInput = document.querySelector("[name = ampiezza]")
let frequencyInput = document.querySelector("[name = frequenza]")
let phaseInput = document.querySelector("[name = fase]")

amplitudeInput.addEventListener("input", function(y){
    console.log(`Amplitude changed -> ${amplitudeInput.value}`)
    ampiezza = parseInt(amplitudeInput.value)
})

frequencyInput.addEventListener("input", function(j){
    console.log(`Frequency changed -> ${frequencyInput.value}`)
    frequenza = parseInt(frequencyInput.value)

})

phaseInput.addEventListener("input", function(h){
    console.log(`Phase changed -> ${phaseInput.value}`)
    fase = parseInt(phaseInput.value)

})


function setup()
{
    createCanvas(W, H)
    background(220)

    angleMode(DEGREES)
    stroke("black")
    strokeWeight(1)
    line(0,200, 1000,200 )
    //line(X0,Y0, X1,Y1)  
}


function draw()
{
    strokeWeight(5)

    //SIN
    stroke("red")
    let y = ampiezza*sin(2*PI*frequenza*angle+fase)
    point(angle,y+200)

    //COS
    stroke("blue")
    let y2 = ampiezza*cos(2*PI*frequenza*angle+fase)
    point(angle,y2+200)
    angle += 1
    
    if (angle > W)
    {
        background(220)
        stroke("black")
        strokeWeight(1)
        line(0,200, 1000,200 )
        angle = 0
    }
    
}


