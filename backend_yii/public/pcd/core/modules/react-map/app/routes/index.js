import React from 'react';
import {Route, Redirect, IndexRoute, IndexRedirect} from 'react-router';

import {App} from '../containers';
import Home from './Home';
import SXH from './SXH';

export default (
    <Route path="/" component={App}>
        <IndexRoute component={Home}> </IndexRoute>
        <Route path="/sxh" component={SXH}></Route>
        {/*<IndexRedirect to="/sxh" />*/}
        {/*<Route path="about" component={About}/>*!/*/}
        {/* <Redirect path="*" to="/" /> */}
    </Route>
);