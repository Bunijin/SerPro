const express = require('express');
const app = express();
app.set('view engine', 'ejs');
app.set('views', 'test-view');
app.get('/', function(req, res){
res.send('Hello, Home page');
});
app.get('/api/forcast', function(req, res){
res.send('Weather Forecast result');
});
app.get('/api/coordinate', function(req, res){
res.render('test-template', {data: 'Hello Weather Forecast'});
});
app.get('/api/city', function(req, res){
res.send(`<h1>WeatherForcast from city</h1>`);
});
const port = process.env.port || 3000;
app.listen(port, function(){
console.log('Listioning on port', port);
});
