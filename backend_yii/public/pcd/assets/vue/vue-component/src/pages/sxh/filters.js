import Vue from 'vue'

Vue.filter('or', function (val1, val2) {
    if (val1) return val1
    if (val2) return val2
    return ''
})