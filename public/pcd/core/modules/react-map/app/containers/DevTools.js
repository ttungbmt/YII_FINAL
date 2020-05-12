import React from 'react';
import { createDevTools } from 'redux-devtools';
import LogMonitor from 'redux-devtools-log-monitor';
import DockMonitor from 'redux-devtools-dock-monitor';
// import Inspector from 'redux-devtools-inspector';
import ChartMonitor from 'redux-devtools-chart-monitor';
import FilterableLogMonitor from 'redux-devtools-filterable-log-monitor';
import DiffMonitor from 'redux-devtools-diff-monitor';
import Dispatcher from 'redux-devtools-dispatch';
import MultipleMonitors from 'redux-devtools-multiple-monitors';

export default createDevTools(
    <DockMonitor toggleVisibilityKey='ctrl-h'
                 changePositionKey='ctrl-q'
                 changeMonitorKey='ctrl-m'
                 defaultPosition='right'
                 defaultIsVisible={false}
                 preserveScrollTop={false}
                 defaultSize={0.25}>
        <MultipleMonitors>
            <LogMonitor />
            <Dispatcher initEmpty={true} />
        </MultipleMonitors>
    </DockMonitor>
);

//<FilterableLogMonitor/>
//<ChartMonitor />
//<DiffMonitor />





