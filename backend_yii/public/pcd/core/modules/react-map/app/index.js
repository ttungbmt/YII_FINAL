import 'babel-polyfill';
import React from 'react';
import { render } from 'react-dom';
import { Provider } from 'react-redux';
import { Resolver } from "react-resolver";
import { Router, useRouterHistory, browserHistory, hashHistory } from 'react-router';
import { syncHistoryWithStore } from 'react-router-redux';
import createHashHistory from 'history/lib/createHashHistory';
import { renderToString } from 'react-dom/server';
import axios from 'axios';
import moment from 'moment';

import configureStore from './store/configureStore';
import { DevTools } from './containers';
import routes from './routes';
import Util from './utils';

const appHashHistory = useRouterHistory(createHashHistory)({ queryKey: false, }) // history v3 k tương thích React router
export const store = configureStore();
const history = syncHistoryWithStore(appHashHistory, store);

// Khi k có Chrome Devtools thì dùng DevTools npm (phải dùng module.hot)
const devTools = !window.devToolsExtension && module.hot ? <DevTools /> : null;

axios.defaults.baseURL = window.BASE_URL ? window.BASE_URL : 'http://dichte.dev:82';
moment.locale('vi');
window.util = new Util();


render((
    <Provider store={store}>
        <div>
            <Router history={history} routes={routes} />
            { devTools }
        </div>
    </Provider>
), document.getElementById('rootApp'));

