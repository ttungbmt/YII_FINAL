const initialState = {
    status: 'OK',
};

export default function DichteData(state = initialState, action) {
    switch (action.type) {
        case 'CABENH_OK':
            return Object.assign({}, state, action.cabenh);
        default:
            return state;
    }
}

