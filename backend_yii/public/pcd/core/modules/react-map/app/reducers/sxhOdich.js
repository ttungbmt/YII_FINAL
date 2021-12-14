const initialState = {
    model: null,
    html: null,
    showPopup: null,
    sxhs: [],
    flytoBounds: null,
};

export default (state = initialState, action = {}) => {
    switch (action.type) {
        case 'ODICH_SXH_MODEL':
            return { ...state, model: action.payload};
        case 'ODICH_SXH_HTML':
            return { ...state, html: action.payload};
        case 'ODICH_SXH_POPUP':
            return { ...state, showPopup: action.payload};
        case 'ODICH_SXH_ADD':
            let {sxhs, ...model} = action.payload;
            return { ...state, sxhs, model};
        case 'ODICH_SXH_DELETE':
            return { ...state, sxhs: []};
        case 'ODICH_SXH_FLYTO':
            return { ...state, flytoBounds: action.payload};
        default:
            return state;
    }
}