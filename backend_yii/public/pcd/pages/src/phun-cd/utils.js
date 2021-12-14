const natsort = (arr) => {
    return arr.sort(function (a,b) {
        if ( isNaN(a) && isNaN(b) ) {
            if (a<=b) { return false; } else { return true; }
        }
        if (isNaN(a)) { return true; }
        if (isNaN(b)) { return false; }
        return a-b;
    });
}