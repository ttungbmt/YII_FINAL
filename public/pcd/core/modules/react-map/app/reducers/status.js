const initialState = {
    chat: null
};

export default (state = initialState, action) => {
    switch (action.type) {
        case 'CHAT_STATUS':
            return {...state, chat: action.payload};
        default:
            return state;
    }
}
