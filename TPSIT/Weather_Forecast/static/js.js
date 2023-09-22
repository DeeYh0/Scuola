let marker;
let minTemperature;
let maxTemperature;
let map;
let chartData = {
    labels: [],
    temperature: [],
    humidity: [],
};

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

document.querySelector("#show-chart-button").addEventListener('click', () => {
    let chartContainer = document.querySelector("#chart-container");
    if (chartContainer.style.display === 'none' || chartContainer.style.display === '') {
        chartContainer.style.display = 'block';

        let currentTime = new Date();
        let currentHour = currentTime.getHours();

        let labels = [];
        let temperaturePoints = [];
        let humidityPoints = [];

        for (let i = 0; i <= currentHour; i++) {
            labels.push(i + ":00");
            temperaturePoints.push(chartData.temperature[i]);
            humidityPoints.push(chartData.humidity[i]);
        }

        if (myChart) {
            myChart.destroy();
        }

        createChart(labels, temperaturePoints, humidityPoints);
    } else {
        chartContainer.style.display = 'none';
    }
});




let myChart; 

function createChart(labels, temperatureData, humidityData) {
    let ctx = document.getElementById("myChart").getContext("2d");

    myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Temperatura (°C)",
                    data: temperatureData,
                    borderColor: "rgba(255, 99, 132, 1)",
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    yAxisID: "temperature-y-axis",
                },
                {
                    label: "Umidità (%)",
                    data: humidityData,
                    borderColor: "rgba(75, 192, 192, 1)",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    yAxisID: "humidity-y-axis",
                },
            ],
        },
        options: {
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: "Ore",
                    },
                },
                y: {
                    position: "left",
                    display: true,
                    title: {
                        display: true,
                        text: "Temperatura (°C) / Umidità (%)",
                    },
                },
            },
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                },
            },
        },
    });
}


document.querySelector("#coordinates-form").addEventListener("submit", async function (event) {
    event.preventDefault();

    let latitude = document.querySelector("#latitudine").value;
    let longitude = document.querySelector("#longitudine").value;

    try {
        let data = await getWeather(latitude, longitude);
        let temperatureData = data.daily.temperature_2m_min;
        let humidityData = data.daily.temperature_2m_max;

        let currentTime = new Date();
        let currentHour = currentTime.getHours();
        let totalHours = 24; 
        let labels = [];
        let temperaturePoints = [];
        let humidityPoints = [];

        for (let i = 0; i <= totalHours; i++) {
            labels.push(i + ":00");

            if (i <= currentHour) {
                temperaturePoints.push(temperatureData[i]);
                humidityPoints.push(humidityData[i]);
            } else {
                temperaturePoints.push(null);
                humidityPoints.push(null);
            }
        }

        chartData.labels = labels;
        chartData.temperature = temperaturePoints;
        chartData.humidity = humidityPoints;

        if (myChart) {
            myChart.destroy();
        }
        createChart();

    } catch (error) {
        console.error("Errore API:", error);
    }
});