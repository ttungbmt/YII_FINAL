import {cqlSXH} from '../utils/sxh';
import {includes} from 'lodash';

const initialState = {
    model: null,
    html: null,
    showPopup: null,
    cqlSXH: null,
    filter: {},
    khoanhvung: [],
};

export default (state = initialState, action = {}) => {
    switch (action.type) {
        case 'SXH_MODEL':
            return { ...state, model: action.payload};
        case 'SXH_HTML':
            return { ...state, html: action.payload};
        case 'SXH_POPUP':
            return { ...state, showPopup: action.payload};
        case 'SXH_CQL':
            return { ...state, cqlSXH: action.payload};
        case 'SXH_FILTER':
            return { ...state, filter: action.payload};
        case 'SXH_ADD_TO_ODICH':
        case 'SXH_ADD_KHOANHVUNG':
            return {
                ...state,
                khoanhvung: [
                    ...state.khoanhvung,
                    action.payload,
                ]};
        case 'SXH_UPDATE_KV_TO_ODICH':
            return {
                ...state,
                khoanhvung: state.khoanhvung.map(feature =>
                    feature.id === action.payload.id ? action.payload : feature
                )
            };
        case 'SXH_DELETE_KHOANHVUNG':
            return {
                ...state,
                khoanhvung: state.khoanhvung.filter(feature => !includes(action.ids, feature.id))
            }
        default:
            return state;
    }
}