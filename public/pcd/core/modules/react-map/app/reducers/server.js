const initialState = {

};

export default (state = initialState, action = {}) => {
    switch (action.type) {
        case 'UPDATE_SERVER_DATA':
            return { ...state, ...action.payload}
        default:
            return state;
    }
}

