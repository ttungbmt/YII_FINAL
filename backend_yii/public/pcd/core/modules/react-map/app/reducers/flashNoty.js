import flashConst from '../constants/flashConstants';
const {ADD_FLASH} = flashConst;
const initialState = {
    level: 'success',
    title: null,
    message: null,
    position: 'tr',
};

export default (state = initialState, action = {}) => {
    const {message, title, level, options} = action;

    switch (action.type) {
        case ADD_FLASH:
            return {
                ...state,
                ...options,
                message,
                title,
                level
            }
        default:
            return state;
    }
}