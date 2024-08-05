const colorCodes = {
    black: { digit: 0, multiplier: 1 },
    brown: { digit: 1, multiplier: 10 },
    red: { digit: 2, multiplier: 100 },
    orange: { digit: 3, multiplier: 1000 },
    yellow: { digit: 4, multiplier: 10000 },
    green: { digit: 5, multiplier: 100000 },
    blue: { digit: 6, multiplier: 1000000 },
    violet: { digit: 7, multiplier: 10000000 },
    gray: { digit: 8, multiplier: 100000000 },
    white: { digit: 9, multiplier: 1000000000 }
};

function calculateResistance(bands) {
    if (bands.length < 3 || bands.length > 6) {
        throw new Error('Invalid number of bands. Expected 4, 5, or 6 bands.');
    }

    let [band1, band2, band3, band4, band5, band6] = bands;

    if (bands.length === 4) {
        // 4-band resistor
        const digit1 = colorCodes[band1]?.digit;
        const digit2 = colorCodes[band2]?.digit;
        const multiplier = colorCodes[band3]?.multiplier;
        if (digit1 === undefined || digit2 === undefined || multiplier === undefined) {
            throw new Error('Invalid color code.');
        }
        return (digit1 * 10 + digit2) * multiplier;
    }
    else if (bands.length === 5) {
        // 5-band resistor
        const digit1 = colorCodes[band1]?.digit;
        const digit2 = colorCodes[band2]?.digit;
        const digit3 = colorCodes[band3]?.digit;
        const multiplier = colorCodes[band4]?.multiplier;
        if (digit1 === undefined || digit2 === undefined || digit3 === undefined || multiplier === undefined) {
            throw new Error('Invalid color code.');
        }
        return ((digit1 * 100 + digit2 * 10 + digit3) * multiplier);
    }
    else if (bands.length === 6) {
        // 6-band resistor
        const digit1 = colorCodes[band1]?.digit;
        const digit2 = colorCodes[band2]?.digit;
        const digit3 = colorCodes[band3]?.digit;
        const digit4 = colorCodes[band4]?.digit;
        const multiplier = colorCodes[band5]?.multiplier;
        if (digit1 === undefined || digit2 === undefined || digit3 === undefined || digit4 === undefined || multiplier === undefined) {
            throw new Error('Invalid color code.');
        }
        return ((digit1 * 1000 + digit2 * 100 + digit3 * 10 + digit4) * multiplier);
    }
}
