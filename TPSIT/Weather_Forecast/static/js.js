let marker;  //marker con coordinate
let minTemperature;
let maxTemperature;
let map; 

function getWeather(latitude, longitude) {
    return fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&daily=temperature_2m_min,temperature_2m_max`)
        .then(response => response.json());
    }

function createMap (lat,lng)
{
    map = L.map("map").setView([41.9027835, 12.4963655], 6);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

marker = L.marker([lat, lng]).addTo(map);  //POPUP MARKER
marker.bindPopup(`POSIZIONE MARKER<br>Latitude: ${lat.toFixed(5)}<br>Longitude: ${lng.toFixed(5)}<br>Min Temperature: ${minTemperature}°C<br>Max Temperature: ${maxTemperature}°C`).openPopup(); //non sapevo come fare oltre al <br>

map.on("click", async function (e){
    let { lat, lng } = e.latlng;

    try {
        let data = await getWeather(lat, lng);
            minTemperature = data.daily.temperature_2m_min[0];
            maxTemperature = data.daily.temperature_2m_max[0];

        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([lat, lng]).addTo(map);  //POPUP MARKER
        marker.bindPopup(`POSIZIONE MARKER<br>Latitude: ${lat.toFixed(5)}<br>Longitude: ${lng.toFixed(5)}<br>Min Temperature: ${minTemperature}°C<br>Max Temperature: ${maxTemperature}°C`).openPopup(); //non sapevo come fare oltre al <br>
    } catch (error) {
        console.error("Errore API:", error);
    }
})
}

navigator.geolocation.getCurrentPosition(function(e){

createMap(e.coords.latitude, e.coords.longitude) //accept
},(function(e){
    createMap(41.9027835, 12.4963655) //reject
    }),

),


document.querySelector("#coordinates-form").addEventListener("submit", async function (event) {
    event.preventDefault();

    let latitude = document.querySelector("#latitudine").value;
    let longitude = document.querySelector("#longitudine").value;

    try {
        let data = await getWeather(latitude, longitude);
        let minTemperature = data.daily.temperature_2m_min[0];
        let maxTemperature = data.daily.temperature_2m_max[0];

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([latitude, longitude]).addTo(map);
        marker.bindPopup(`Latitude: ${latitude}<br>Longitude: ${longitude}<br>Min Temperature: ${minTemperature}°C<br>Max Temperature: ${maxTemperature}°C`).openPopup(); //ho usato <br>... non sapevo fare altrimenti
        map.setView([latitude, longitude], 6);

        document.querySelector("#min-temperature").innerHTML = `${minTemperature}°C`;
        document.querySelector("#max-temperature").innerHTML = `${maxTemperature}°C`;

    } catch (error) {
        console.error("Errore API:", error);
        document.querySelector("#min-temperature").innerHTML = "N/A";
        document.querySelector("#max-temperature").innerHTML = "N/A";
    }
})


let resetButton = document.querySelector("#reset-button").addEventListener('click', ()=>{
    document.querySelector("#latitudine").value="";
    document.querySelector("#longitudine").value="";
    document.querySelector("#min-temperature").innerHTML = "";
    document.querySelector("#max-temperature").innerHTML = "";
    if (marker) {
        map.removeLayer(marker);
    }

})

