import React, {Component} from 'react';

const L01 = () => (
    <div className="sk-three-bounce" style={{'marginTop': '100px'}}>
        <div className="sk-child sk-bounce1" style={{'background': '#F3ED44'}}></div>
        <div className="sk-child sk-bounce2" style={{'background': '#FFCA2D'}}></div>
        <div className="sk-child sk-bounce3" style={{'background': '#F89B20'}}></div>
    </div>
)

const L02 = () => (
    <div className='clear-loading loading-effect-1' style={{'marginTop': '100px'}}><span></span><span></span><span></span></div>
)

export default class Progress extends Component{};

Progress.L01 = L01;
Progress.L02 = L02;