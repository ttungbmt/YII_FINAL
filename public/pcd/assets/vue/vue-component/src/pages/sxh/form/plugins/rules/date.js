import moment from 'moment'

const validate = function (value, {format = 'D/M/Y'}) {
    return moment(value, format, true).isValid()
}

export default {
    validate,
    params: ['format'],
    message: '{_field_} không hợp lệ'
}