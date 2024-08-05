// Function to get the tolerance percentage based on the band color for 4-band and 5-band resistors
function getTolerance(color) {
    const toleranceCodes = {
        brown: 1,
        red: 2,
        green: 0.5,
        blue: 0.25,
        violet: 0.1,
        gray: 0.05,
        gold: 5,
        silver: 10
    };
    return toleranceCodes[color] || 20; // Default to 20% if color is not recognized
}

// Function to get the PTC value based on the band color for 6-band resistors
function getPTC(color) {
    const ptcCodes = {
        black: 250,
        brown: 100,
        red: 50,
        orange: 15,
        yellow: 25,
        green: 20,
        blue: 10,
        violet: 5,
        gray: 1
    };
    return ptcCodes[color] || 0; // Default to 0 if color is not recognized
}

function calculateFromForm() {
    const band1 = document.getElementById('band1').value;
    const band2 = document.getElementById('band2').value;
    const band3 = document.getElementById('band3').value;
    const band4 = document.getElementById('band4').value;
    const band5 = document.getElementById('band5') ? document.getElementById('band5').value : null;
    const band6 = document.getElementById('band6') ? document.getElementById('band6').value : null;

    // Check if all colors are selected based on the number of bands
    if (!band1 || !band2 || !band3 || !band4 ||
        (document.getElementById('band5') && !band5) ||
        (document.getElementById('band6') && !band6)) {
        alert('Please select all color bands.');
        return;
    }

    try {
        let bands = [band1, band2, band3];
        let tolerance = '';
        let ptc = '';

        if (band4) {
            bands.push(band4);
        }
        if (band5) {
            tolerance = getTolerance(band5);
            bands.push(band5);
        }
        if (band6) {
            ptc = getPTC(band6);
        }

        const resistance = calculateResistance(bands);
        if (band5) {
            // For 5-band resistors
            document.getElementById('result').innerText = `Resistance: ${resistance}Ω ± ${tolerance}% ${ptc ? ptc + 'ppm' : ''}`;
        } else if (band4) {
            // For 4-band resistors
            tolerance = getTolerance(band4);
            document.getElementById('result').innerText = `Resistance: ${resistance}Ω ± ${tolerance}% ${ptc ? ptc + 'ppm' : ''}`;
        } else {
            // For 6-band resistors
            document.getElementById('result').innerText = `Resistance: ${resistance}Ω ± ${tolerance} ${ptc ? ptc + 'ppm' : ''}`;
        }
    } catch (error) {
        document.getElementById('result').innerText = `Error: ${error.message}`;
    }
}
