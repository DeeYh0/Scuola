let marker;
let minTemperature;
let maxTemperature;
let map;

function getWeather(latitude, longitude) {
    return fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&daily=temperature_2m_min,temperature_2m_max`)
        .then(response => response.json());
}

function createMap(lat, lng) {
    map = L.map("map").setView([41.9027835, 12.4963655], 6);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    marker = L.marker([lat, lng]).addTo(map);
    marker.bindPopup(`POSIZIONE MARKER<br>Latitude: ${lat.toFixed(5)}<br>Longitude: ${lng.toFixed(5)}<br>Min Temperature: ${minTemperature}°C<br>Max Temperature: ${maxTemperature}°C`).openPopup(); //ho usato <br>... non sapevo fare altrimenti

    map.on("click", async function (e) {
        let { lat, lng } = e.latlng;

        try {
            let data = await getWeather(lat, lng);
            minTemperature = data.daily.temperature_2m_min[0];
            maxTemperature = data.daily.temperature_2m_max[0];

            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup(`POSIZIONE MARKER<br>Latitude: ${lat.toFixed(5)}<br>Longitude: ${lng.toFixed(5)}<br>Min Temperature: ${minTemperature}°C<br>Max Temperature: ${maxTemperature}°C`).openPopup(); //ho usato <br>... non sapevo fare altrimenti
        } catch (error) {
            console.error("Errore API:", error);
        }
    });
}

navigator.geolocation.getCurrentPosition(async function (e) {
    createMap(e.coords.latitude, e.coords.longitude);

    try {
        let data = await getWeather(e.coords.latitude, e.coords.longitude);
        minTemperature = data.daily.temperature_2m_min[0];
        maxTemperature = data.daily.temperature_2m_max[0];

        if (marker) {
            marker.bindPopup(`POSIZIONE MARKER<br>Latitude: ${e.coords.latitude.toFixed(5)}<br>Longitude: ${e.coords.longitude.toFixed(5)}<br>Min Temperature: ${minTemperature}°C<br>Max Temperature: ${maxTemperature}°C`).openPopup(); //ho usato <br>... non sapevo fare altrimenti
        }

    } catch (error) {
        console.error("Errore API:", error);
    }
}, function (e) {
    createMap(41.9027835, 12.4963655);
});


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


//grafico

document.querySelector("#show-chart-button").addEventListener('click', async () => {
    let chartContainer = document.querySelector("#chart-container");
    if (chartContainer.style.display === 'none' || chartContainer.style.display === '') {
        chartContainer.style.display = 'block';

        try {
            let latitude = document.querySelector("#latitudine").value;
            let longitude = document.querySelector("#longitudine").value;
            let url = `https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&hourly=temperature_2m,relativehumidity_2m`;
            let response = await fetch(url);
            let data = await response.json();

            let ore = data.hourly.time;
            let temperature = data.hourly.temperature_2m;
            let umidita = data.hourly.relativehumidity_2m;

            let indiceAttuale = new Date().getHours();

            let oreFiltrate = ore.slice(0, indiceAttuale + 1);
            let temperatureFiltrate = temperature.slice(0, indiceAttuale + 1);
            let umiditaFiltrata = umidita.slice(0, indiceAttuale + 1);
            
            createChart(oreFiltrate, temperatureFiltrate, umiditaFiltrata);
        } catch (error) {
            console.error("Errore API:", error);
        }
    } else {
        chartContainer.style.display = 'none';
    }
});


let myChart; 

function createChart(labels, temperatureData, humidityData) {
    let canvas = document.querySelector("canvas");

    let config = {
        type: 'line',
        data: {
            labels: labels, 
            datasets: [
                {
                    label: 'Temperatura 2m',
                    data: temperatureData, 
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    yAxisID: 'y',
                },
                {
                    label: 'Umidità',
                    data: humidityData, 
                    fill: false,
                    borderColor: 'rgb(255, 0, 0)',
                    tension: 0.1,
                    yAxisID: 'y1',
                }
            ]
        },
        scales: {
            y: {
                type: 'linear',
                position: 'left',
            },
            y1: {
                type: 'linear',
                position: 'right' 
            }
        }
    };

    myChart = new Chart(canvas, config);
}

document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault();
    let latitudine = document.querySelector("#lat").value;
    let longitudine = document.querySelector("#lng").value;

    console.log(latitudine, longitudine);

    let url = `https://api.open-meteo.com/v1/forecast?latitude=${latitudine}&longitude=${longitudine}&hourly=temperature_2m,relativehumidity_2m`;

    console.log(url);

    fetch(url)
        .then(function (resp) {
            return resp.json();
        })
        .then(function (data) {
            console.log(data.hourly.time);
            console.log(data.hourly.temperature_2m);
            console.log(data.hourly.relativehumidity_2m);

            let ore = data.hourly.time;
            let temperature = data.hourly.temperature_2m;
            let umidita = data.hourly.relativehumidity_2m;

            let indiceAttuale = new Date().getHours();

            let oreFiltrate = ore.slice(0, indiceAttuale + 1).map(time => new Date(time).getHours());
            let temperatureFiltrate = temperature.slice(0, indiceAttuale + 1);
            let umiditaFiltrata = umidita.slice(0, indiceAttuale + 1);

            createChart(oreFiltrate, temperatureFiltrate, umiditaFiltrata);
        });
});
