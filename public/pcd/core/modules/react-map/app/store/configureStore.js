import { applyMiddleware, compose, createStore, combineReducers } from 'redux'
import { persistState } from 'redux-devtools';
import { browserHistory } from 'react-router'
import invariant from 'redux-immutable-state-invariant';
import thunk from 'redux-thunk';
import logger from 'redux-logger';
import rootReducer from '../reducers';
import * as actionCreators from '../actions';
import DevTools from '../containers/DevTools';




const middleware = [
    // logger(),
    thunk,
    invariant()
];


const enhancer = compose(
    applyMiddleware(...middleware),
    window.devToolsExtension ? window.devToolsExtension({actionCreators}) : DevTools.instrument(),
);

export default function configureStore(initialState) {
    const store = createStore(rootReducer, initialState, enhancer);


    if (module.hot) {
        // Enable Webpack hot module replacement for reducers
        module.hot.accept('../reducers', () => {
            const nextRootReducer = require('../reducers').default
            store.replaceReducer(nextRootReducer)
        })
    }

    return store;
}


// export default function configureStore(preloadedState) {
//     const store = createStore(
//         rootReducer,
//         preloadedState,
//         applyMiddleware(thunkMiddleware)
//     )
//
//     if (module.hot) {
//         // Enable Webpack hot module replacement for reducers
//         module.hot.accept('../reducers', () => {
//             const nextRootReducer = require('../reducers').default
//             store.replaceReducer(nextRootReducer)
//         })
//     }
//
//     return store;
// }