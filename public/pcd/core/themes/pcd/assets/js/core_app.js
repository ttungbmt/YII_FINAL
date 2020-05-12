import URI from 'urijs';
window._ = require('lodash');
window.moment = require('moment');


window.url_home = function (url = '', params = {}) {
    var uri = URI(window.BASE_URL + '/' + url) ;

    uri = _.isEmpty(params) ? uri : uri.addSearch(params);

    return uri.normalize().readable().toString();
}
//
