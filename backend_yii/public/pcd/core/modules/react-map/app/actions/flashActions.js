import flashConst from '../constants/flashConstants';
const {ADD_FLASH} = flashConst;


export function flashMessage(message, level = null, title = null, options = null){
    return {
        type: ADD_FLASH,
        title,
        level,
        message,
        options,
    }
}

export function flashInfo(message, title = null, options = null){
    return flashMessage(message, 'info', title, options);
}

export function flashSuccess(message, title = null, options = null){
    return flashMessage(message, 'success', title, options);
}

export function flashWarning(message, title = null, options = null){
    return flashMessage(message, 'warning', title, options);
}

export function flashError(message, title = null, options = null){
    return flashMessage(message, 'error', title, options);
}



