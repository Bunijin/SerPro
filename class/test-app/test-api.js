const axios = require("axios");
const apiUrl = "http://api.openweathermap.org/data/2.5/weather";
const apiKey = "8fcab2e11c31f4ddad67c1d7b4eaf2e9";
const zipCode = 12150;
const countryCode = "th";
axios
.get(`${apiUrl}?zip=${zipCode},${countryCode}&appid=${apiKey}&un
its=metric`)
.then(res => console.log(res.data))
.catch(err => console.log(err));
