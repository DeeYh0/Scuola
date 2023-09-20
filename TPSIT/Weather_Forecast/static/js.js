let map = L.map("map").setView([41.9027835, 12.4963655], 6);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

function getWeather(latitude, longitude) {
    return fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&daily=temperature_2m_min,temperature_2m_max`)
        .then(response => response.json());
}

let marker;  //marker con coordinate

map.on("click", async function (e) {
    let { lat, lng } = e.latlng;

    try {
        let data = await getWeather(lat, lng);
        let minTemperature = data.daily.temperature_2m_min[0];
        let maxTemperature = data.daily.temperature_2m_max[0];

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);  //POPUP MARKER
        marker.bindPopup(`POSIZIONE MARKER<br>Latitude: ${lat.toFixed(5)}<br>Longitude: ${lng.toFixed(5)}<br>Min Temperature: ${minTemperature}°C<br>Max Temperature: ${maxTemperature}°C`).openPopup();
    } catch (error) {
        console.error("Errore API:", error);
    }
});

document.getElementById("coordinates-form").addEventListener("submit", async function (event) {
    event.preventDefault();

    let latitude = document.getElementById("latitudine").value;
    let longitude = document.getElementById("longitudine").value;

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

        document.getElementById("min-temperature").innerHTML = `${minTemperature}°C`;
        document.getElementById("max-temperature").innerHTML = `${maxTemperature}°C`;

    } catch (error) {
        console.error("Errore API:", error);
        document.getElementById("min-temperature").innerHTML = "N/A";
        document.getElementById("max-temperature").innerHTML = "N/A";
    }
});

let resetButton = document.getElementById("reset-button");  //Fatto ciò perchè non resettava i 2 input ma solo 1 😢
resetButton.addEventListener("click", function () {
    location.reload();
});
