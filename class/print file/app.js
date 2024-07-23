// module
const fs = require('fs');
// create file and write text
fs.writeFileSync('text.txt','privet ya nina');
// add text after
fs.appendFileSync('text.txt','// semagute');

// function for diplaying text
function displayText() {
    var number = 1;
    console.log(`hello number ${number++}`);
}

// display text every 1 seconds
setInterval(displayText, 1000);

// display file location
console.log(__filename);