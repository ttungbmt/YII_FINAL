import { combineReducers } from 'redux';
import { routerReducer } from 'react-router-redux';
import {reducer as formReducer} from 'redux-form';
import * as reducers from './root';

const rootReducer = combineReducers({
    ...reducers,
    form: formReducer,
    routing: routerReducer,
})

export default rootReducer;