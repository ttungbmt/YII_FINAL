import {isEmpty, compact} from 'lodash';

export default class Util {
    pjaxReload(selector, pjaxURL) {
        let backUrl = document.URL;
        history.pushState(null, null, pjaxURL)
        $.pjax.reload(selector).complete((res) =>{
            history.pushState(null, null, backUrl)
        });
    }
}

export const convGeoDate = (dateInp) =>{
    if(!dateInp) return;
    return moment(dateInp, moment.ISO_8601).add(1, 'days').format('DD/MM/YYYY');
}


export const arrToCQL = (arr, keyJ = 'and') => {
    return arr.map(v => v.join(' ')).join(` ${keyJ} `)
}

export const cqlJoin = (arr, delimiter = ' and ', def = '') => {
    let cql = compact(arr).map(val => '(' + val +')').join(delimiter);
    return isEmpty(cql) ? def : cql;
}

export const last3Month = (during = 3, outFormat = 'YYYY-MM-DD') => {
    return moment().add(-1 * during, 'months').format(outFormat);
}

export const paramJoin = (arr, delimiter = ';', def = '') => {
    let paramStr = arr
        .filter(val => val.length >= 2 && val[1] != undefined)
        .map(val => val.join(':'))
        .join(delimiter);

    return isEmpty(paramStr) ? def : paramStr;
}



export const formatNumber = (num) => {
    return parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,')
}
