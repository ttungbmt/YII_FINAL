import 'babel-polyfill';
import React from 'react';
import { render } from 'react-dom';
import { Provider } from 'react-redux';
import { Router, Route, browserHistory } from 'react-router';
import { syncHistoryWithStore, routerReducer } from 'react-router-redux';
import axios from 'axios';
import moment from 'moment';

import configureStore from './store/configureStore';
import Util from './utils';
import App from './containers/App';

const store = configureStore();
window.util = new Util();
axios.defaults.baseURL = window.BASE_URL ? window.BASE_URL : 'http://dichte.dev:82';
moment.locale('vi');

// GLOBAL VARIABLE
window.map = null;


render(
    <Provider store={store}>
        <App />
    </Provider>,
    document.getElementById('rootApp')
);

// http://magic.reactjs.net/htmltojsx.htm

