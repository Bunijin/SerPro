const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');
const app = express();

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'all-views'));
app.use(bodyParser.urlencoded({ extended: false }));

// Serve static files from the 'public' directory
app.use(express.static(path.join(__dirname, 'public')));

app.get('/', function (req, res) {
    res.redirect('/4_band_resistor');
});

app.post('/select-resistor', function (req, res) {
    const resistorType = req.body.resistorType;
    if (resistorType) {
        res.redirect(`/${resistorType}`);
    } else {
        res.redirect('/');
    }
});

app.get('/:resistorType', function (req, res) {
    const resistorType = req.params.resistorType;
    if (['4_band_resistor', '5_band_resistor', '6_band_resistor'].includes(resistorType)) {
        res.render(resistorType, { currentType: resistorType });
    } else {
        res.redirect('/');
    }
});

app.listen(3000, function () {
    console.log('Listening on port 3000');
});
