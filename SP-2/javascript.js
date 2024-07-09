var wave = (str) => {
    if (str.length >= 10) {
        let temp = str.split('');
        let result = [];
        for (let c = 0; c < str.length; c++) {
            temp[c] = str[c].toUpperCase();
            result.push(temp.join(''));
            temp[c] = str[c].toLowerCase();
        }
        return result;
    } else {
        return "Error: String is less than 10 characters!";
    }
}