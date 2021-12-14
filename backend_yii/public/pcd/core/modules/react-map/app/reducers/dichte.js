const initialState = {
    cabenh: null,
    odich: null,
    filter: null, filter_cql: null,
    noty: null,

    kvGroup : null,
    kvCabenh : null,
    zoomCabenh: null,
};

export default function DichteData(state = initialState, action) {
    switch (action.type) {
        case 'CABENH_HTML':
            return Object.assign({}, state, {cabenh: action.payload});
        case 'ODICH_HTML':
            return Object.assign({}, state, {odich: action.payload});
        case 'FILTER':
            return Object.assign({}, state, {filter: action.payload});
        case 'FILTER_CQL':
            return Object.assign({}, state, {filter_cql: action.payload});
        case 'HELLO':
            return Object.assign({}, state, {hello: action.payload});
        case 'NOTY_WARNING':
            action.payload.level = 'warning';
            return Object.assign({}, state, {noty: action.payload});
        case 'NOTY_INFO':
            action.payload.level = 'info';
            return Object.assign({}, state, {noty: action.payload});
        case 'ADD_KHOANHVUNG':
            return Object.assign({}, state, {kvGroup: action.payload});
        case 'ADD_KVCABENH':
            return Object.assign({}, state, {kvCabenh: action.payload});
        case 'ZOOM_CABENH':
            return Object.assign({}, state, {zoomCabenh: action.payload});
        default:
            return state;
    }
}

