import React, {Component, PropTypes} from 'react';
import { bindActionCreators } from 'redux'
import { connect } from 'react-redux';
import { resolve } from "react-resolver";
import axios from 'axios';
import {map, compact} from 'lodash';

import {Header, LeftPanel, Navbar, Footer, MapLayout, ChatBox, FlashNoty} from '../components';
import {flashWarning} from '../actions/flashActions';
import * as Layout from '../utils/layout';

var initialData;
@resolve('srvData', props => {
    if(initialData) return initialData; // Fix load router

    return axios.all([
        axios.get(`maps/config`),
    ])
        .then(axios.spread((res01, res02, res03) => {
            props.dispatch({type: 'UPDATE_SERVER_DATA', payload: res01.data});

            initialData = {...res01.data};
            return initialData;
        }));
})
class App extends Component {
    static childContextTypes = {
        srvData: PropTypes.object,
    }

    getChildContext() {
        return {
            srvData: this.props.srvData,
        }
    }

    constructor(props){
        super(props);
        this.state = {
            progLayout: null,
        }
    }

    componentDidMount(){
        const {flashWarning, srvData} = this.props;

        Layout.init();
        this.setState({progLayout: 'loaded'});

        // Thông báo ca bệnh
        flashWarning(this.getInitStatSXH(srvData.thongke), 'Cảnh báo', {autoDismiss: 0})

    }

    getInitStatSXH(thongke){
        return compact(map(thongke, (val, k) => {
            let num = parseInt(val);
            if(num && k == 'chuadt') return `${val} ca chưa điều tra`;
            if(num && k == 'dangdt') return `${val} ca đang điều điều tra`;
        })).join(', ');
    }

    render() {
        const {children, chatStatus, dispatch} = this.props;


        return (
            <div id="wrapper">
                <Header id="header"></Header>
                <section id="main"> {/* onmouseover="myLayout.allowOverflow('north')" */}
                    <LeftPanel id="leftPanel">{children}</LeftPanel>
                    <div id="content">
                        <Navbar id="navbar"></Navbar>
                        <div id="map-wrapper">
                            <div id="leftMap">LEFT MAP</div>
                            <div id="mainMap">
                                {this.state.progLayout == 'loaded' ? <MapLayout /> : 'Đang tải...'}
                            </div>
                            <div id="rightMap">RIGHT MAP</div>
                        </div>
                        <div id="preview">PREVIEW</div>
                    </div>
                    <div id="rightPanel">RIGHTPANEL</div>
                </section>
                <Footer></Footer>
                {chatStatus ? <ChatBox dispatch={dispatch}/> : null}
                <FlashNoty />
            </div>
        );
    }
}

const mapStateToProps = (state, ownProps) => {
    return {
        chatStatus: state.status.chat,
    }
}

const mapDispatchToProps = (dispatch) => {
    return {...bindActionCreators({ flashWarning }, dispatch), dispatch};
}

export default connect(mapStateToProps, mapDispatchToProps, null)(App);


// import Header from '../components/Header';
// import LeftPanel from '../components/LeftPanel';
// import Navbar from '../components/Navbar';
// import Footer from '../components/Footer';
// import MapLayout from '../components/MapLayout';
// import ChatBox from '../vendor/chat/ChatBox';
//
// @resolve('resData', props => {
//     return axios.all([axios.get(`/maps/config`)])
//         .then(axios.spread((res01) => {
//             return {...res01.data};
//         }));
// })
// class App extends Component {
//     state = {
//         layout: 'Loading...',
//     }
//
//     constructor() {
//         super();
//         this.state = {
//             openChat : false
//         }
//     }
//
//     static childContextTypes = {
//         resData: PropTypes.object,
//         map: PropTypes.object,
//     }
//
//     getChildContext() {
//         return {
//             resData: this.props.resData,
//             map: this.props.map,
//         }
//     }
//
//     componentDidMount() {
//         const {thongke} = this.props.resData;
//
//         let updateMap = () => {
//             setTimeout(() => { this.props.map.map.invalidateSize(); })
//         }
//
//         let defaults = {
//             resizeWhileDragging: true,
//             spacing_open: 5,
//             spacing_closed: 5,
//             resizerDragOpacity: 0.3, // Độ mờ resize(Tắt resizeWhileDragging),
//             // onshow_end: updateMap,
//             // onhide_end: updateMap,
//             onresize_end: updateMap,
//             // onclose_end: updateMap,
//             // onopen_end: updateMap,
//         };
//
//
//         var myLayout = $('body').layout({
//             defaults,
//             north: {
//                 paneSelector: '#header',
//                 size: 46,
//                 spacing_open: 0,			// cosmetic spacing
// //                togglerLength_open: 0,			// HIDE the toggler button
// //                resizable: false,
// //                slidable: true,
//                 spacing_closed: 0,
// //                     showOverflowOnHover: true,
//             },
//             center: {
//                 paneSelector: '#main',
//                 childOptions: {
//                     defaults: defaults,
//                     west: {
//                         paneSelector: '#leftPanel',
//                         size: 550,
//                         // showOverflowOnHover: true,
//                     },
//                     center: {
//                         defaults: defaults,
//                         paneSelector: '#content',
//
//                         childOptions: {
//                             defaults: defaults,
//                             north: {
//                                 paneSelector: '#navbar',
//                                 size: 42,
//                                 spacing_open: 0,			// cosmetic spacing
//                                 spacing_closed: 0,
//                                 // showOverflowOnHover: true,
//                             },
//                             center: {
//                                 paneSelector: '#map-wrapper',
//                                 childOptions: {
//                                     defaults: defaults,
//                                     west: {
//                                         paneSelector: '#leftMap',
//                                         spacing_closed: 0,
//                                         initClosed: true,
//                                     },
//                                     center: {
//                                         paneSelector: '#mainMap',
//                                     },
//                                     east: {
//                                         paneSelector: '#rightMap',
//                                         initClosed: true,
//                                         spacing_closed: 0,
//                                     },
//                                 }
//                             },
//
//                             south: {
//                                 paneSelector: '#preview',
//                                 size: 140,
//                                 initClosed: true,
//                                 spacing_closed: 0,
//                             }
//                         }
//                     },
//                     east: {
//                         paneSelector: '#rightPanel',
//                         initClosed: true,
//                         spacing_closed: 0,
//                     },
//                 }
//             },
//             south: {
//                 paneSelector: '#footer',
//                 initClosed: true,
//                 spacing_closed: 0,
//             }
//         });
//
//
//         let appLayout = myLayout,
//             mainLayout = myLayout.center.children.layout1,
//             contentLayout = mainLayout.center.children.layout1,
//             mapLayout = contentLayout.center.children.layout1;
//
//         window.appLayout = {root: myLayout, main: mainLayout, content: contentLayout, map: mapLayout};
//
//         this.setState({layout: 'loaded'});
//
//         $('#leftPanel').perfectScrollbar();
//         $('.table-responsive').perfectScrollbar();
//
//
//         var sbToggled = document.getElementById('navHeader');
//         var gesture = new Hammer(sbToggled);
//         gesture.on('swipeleft swiperight', function(e) {
//             const {type} = e;
//             if(type == 'swipeleft') window.appLayout.main.close('west');
//             if(type == 'swiperight') window.appLayout.main.open('west');
//         });
//
//
//
//
//
//
//         // $(".load-ajax-content").each(function () {
//         //     let self = $(this);
//         //     let url = $(this).attr('data-url');
//         //     let progress = `<div class="progress m-5"> <div class="progress-bar progress-bar-striped active" style="width: 100%"><span class="sr-only">100% Đang tải</span> </div> </div>`;
//         //
//         //     self
//         //         .html(progress)
//         //         .load(url, (res, status, xhr) => {
//         //             xhr
//         //                 .done(() => {
//         //                     self.html(res);
//         //                 })
//         //                 .fail(() => {
//         //                     self.html('Tải dữ liệu thất bại')
//         //                 })
//         //         })
//         // });
//
//
//
//         // Thống kê ca bệnh
//         if(parseInt(thongke.chuadt) || parseInt(thongke.dangdt)){
//             this.refs.noty.addNotification({
//                 title: 'Cảnh báo',
//                 level: 'warning',
//                 message: this.getMessage(thongke),
//                 autoDismiss: 0,
//                 action: {
//                     label: 'Cập nhật ngay',
//                     callback: function() {
//                         window.open(url_home('/dichte/cabenh/index'));
//                     }
//                 }
//             });
//         }
//     }
//
//     getMessage(thongke){
//         let arr = [];
//         if(parseInt(thongke.chuadt)) arr.push(`${thongke.chuadt} ca chưa điều tra`);
//         if(parseInt(thongke.dangdt)) arr.push(`${thongke.dangdt} ca đang điều tra`);
//         return arr.join(', ');
//     }
//
//
//
//     componentDidUpdate(prevProps, prevState) {
//         const {noty} = this.props
//
//         if(noty && noty != prevProps.noty){
//             this.refs.noty.addNotification(noty);
//         }
//
//     }
//
//
//     openChat(){
//         this.setState({openChat: true})
//     }
//
//     closeChat(){
//         this.setState({openChat: false})
//     }
//
//     render() {
//
//
//         return (
//             <div id="wrapper">
//                 <Header openChat={::this.openChat}></Header>
//                 <section id="main"> {/* onmouseover="myLayout.allowOverflow('north')" */}
//                     <LeftPanel></LeftPanel>
//                     <div id="content">
//                         <Navbar></Navbar>
//                         <div id="map-wrapper">
//                             <div id="leftMap">LEFT MAP</div>
//                             <div id="mainMap">
//                                 {this.state.layout == 'loaded' ? <MapLayout /> : 'Đang tải...'}
//                             </div>
//                             <div id="rightMap">RIGHT MAP</div>
//                         </div>
//                         <div id="preview">PREVIEW</div>
//                     </div>
//                     <div id="rightPanel">RIGHTPANEL</div>
//                 </section>
//                 <Footer></Footer>
//
//                 {this.state.openChat ? <ChatBox closeChat={::this.closeChat} /> : null}
//                 <Noty ref="noty" allowHTML/>
//             </div>
//         )
//     }
// }
//
// const mapStateToProps = (state) => {
//     return {
//         server: state.server,
//         noty: state.dichte.noty,
//         map: state.map,
//     }
// }
//
//
// export default connect(mapStateToProps, null, null)(App);