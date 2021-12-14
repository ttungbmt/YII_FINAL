import React, {Component, PropTypes} from 'react';
import { bindActionCreators } from 'redux';
import {connect} from 'react-redux';
import Geosuggest from 'react-geosuggest';
import {geocodeGoogle} from '../actions/mapActions';

class Header extends Component {
    static defaultProps = {id: 'header'}

    static contextTypes = {
        srvData: PropTypes.object,
    }

    constructor(props, context) {
        super(props, context);
        this.srvData = context.srvData;
    }

    onSuggestSelect(suggest) {
        this.props.geocodeGoogle(suggest);
        // this.props.geocodeGoogle(suggest);
        // const {map} = context.map;
        // const {location} = suggest;
        //
        // map.getZoom() < 12 ? map.flyTo(location, 15) : map.flyTo(location);
        // let marker = L.marker(location, {icon: L.icon.wave({heartbeat: 2})}).addTo(map);
        // setTimeout(() => {map.removeLayer(marker)}, 10000)
    }

    onActivateSuggest(suggest) {
        console.log(suggest);
        this.props.geocodeGoogle(suggest);
    }

    getElevation = () => {
        let elevator = new google.maps.ElevationService;
        let locElevation = {
            //'locations': [location]
        }

        elevator.getElevationForLocations(locElevation, (results, status) =>{
            if (status === google.maps.ElevationStatus.OK) {
                // Retrieve the first result
                if (results[0]) {
                    console.log(results[0]);

                } else {
                    console.warn('No results found');
                }
            } else {
                console.warn(`Elevation service failed due to: ${status}`);
            }
        });
    }

    openChat(){
        this.props.dispatch({type: 'CHAT_STATUS', payload: true})
    }


    render() {
        const {id} = this.props;
        const {settings, user} = this.srvData;

        let fixtures = [
            {label: 'TTYTDP TP.HCM', location: [10.755831, 106.683514]},
        ];

        return (
            <header id={id}> {/*onMouseOut={() => appLayout.allowOverflow('north')}*/}
                <div className="navbar navbar-inverse bg-primary"
                     style={{backgroundImage: 'url('+url_home('core/modules/react-map/assets/images/bg-btn.png')+')'}}>

                    <div id="navHeader" className="navbar-header">
                        <a className="navbar-brand" href={url_home('maps')} style={{'padding': '7px 20px'}}><img
                            src={url_home('core/modules/react-map/assets/images/logo-site.png')}
                            style={{'height': '29px'}}
                            alt=""/></a>

                        <ul className="nav navbar-nav visible-xs-block">
                            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i
                                className="icon-tree5"></i></a></li>
                            <li><a className="sidebar-mobile-main-toggle" onClick={() => appLayout.main.toggle('west')}><i
                                className="icon-paragraph-justify3"></i></a></li>
                        </ul>
                    </div>

                    <div className="navbar-collapse collapse" id="navbar-mobile">
                        <ul className="nav navbar-nav">
                            <li><a className="sidebar-control sidebar-main-toggle hidden-xs"
                                   onClick={() => appLayout.main.toggle('west')}><i
                                className="icon-paragraph-justify3"></i></a></li>
                            <li className="ml-10 visible-lg">
                                <h2 className="text-uppercase"
                                    style={{textAlign: 'center!important', textTransform: 'uppercase!important', fontWeight: 700, margin: '2px 0', color: '#FEF15E', textShadow: '2px 2px 2px rgba(150, 150, 150, 1)'}}>
                                    {settings.app.app_name}
                                </h2>
                            </li>
                        </ul>
                        <ul className="nav navbar-nav navbar-right">
                            <li>
                                <div className="form-group has-feedback" style={{'minWidth': 260}}>
                                    <Geosuggest
                                        country="vn"
                                        fixtures={fixtures}
                                        inputClassName="form-control text-primary"
                                        placeholder="Tìm kiếm vị trí..."
                                        onSuggestSelect={::this.onSuggestSelect}
                                        onActivateSuggest={::this.onActivateSuggest}
                                    />
                                    {/*<input type="search" className="form-control" placeholder="Tìm kiếm vị trí..." />*/}
                                    <div className="form-control-feedback">
                                        <i className="icon-search4 text-muted text-size-base"></i>
                                    </div>
                                </div>
                            </li>
                            <li className="dropdown dropdown-user">
                                <a className="dropdown-toggle" data-toggle="dropdown">
                                    <img src={url_home('core/modules/react-map/assets/images/person-flat.png')} alt=""/>
                                    <span>{user.username}</span> &nbsp;
                                    <i className="caret"></i>
                                </a>

                                <ul className="dropdown-menu dropdown-menu-right">
                                    {/*<li><a href={url_home('auth/taikhoan/capnhat')}><i className="icon-user-plus"></i> Tài khoản</a></li>*/}
                                    {/*<li><a href="#"><i className="icon-coins"></i> Lược sử</a></li>*/}
                                    <li><a onClick={::this.openChat}><span
                                        className="badge bg-teal-400 pull-right">5</span> <i
                                        className="icon-comment-discussion"></i> Tin nhắn</a></li>
                                    <li className="divider"></li>
                                    <li><a href="#"><i className="icon-cog5"></i> Cài đặt</a></li>
                                    <li><a href={url_home('site/logout')}><i className="icon-switch2"></i> Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
        );
    }
}

const mapStateToProps = (state) => {
    return {
        googleAddr: state.map.googleAddr
    };
}

const mapDispatchToProps = (dispatch) => {
    return {...bindActionCreators({ geocodeGoogle }, dispatch), dispatch};
}

export default connect(mapStateToProps, mapDispatchToProps)(Header);
