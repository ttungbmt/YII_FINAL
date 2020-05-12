const initialState = {
    googleAddr: null,

    flyTo: null,
};

export default (state = initialState, action) => {
    switch (action.type) {
        case 'GEOCODE_GOOGLE':
            return {...state, googleAddr: action.payload};
        case 'MAP_FLYTO':
            return {...state, flyTo: action.payload};
        default:
            return state;
    }
}

