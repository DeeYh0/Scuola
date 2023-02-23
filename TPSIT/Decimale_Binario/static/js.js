let output = document.getElementById("input")
output.addEventListener("change",(e) => {
  document.querySelector(".output").innerHTML = DecBin(parseInt(output.value))
})


function DecBin(num)
{
    if (num === 0)
    {
      return "0";
    }
    else if (num === 1)
    {
      return "1";
    }
    else
    {
      let resto = num % 2;
      let quo = Math.floor(num / 2); //quoziente della divisione per 2
      return DecBin(quo) + resto.toString();
    }
  }
  

  