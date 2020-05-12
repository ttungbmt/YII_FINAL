import React, {Component, PropTypes} from 'react';
import { Link, IndexLink } from 'react-router'

export default class Navbar extends Component {
    static defaultProps = {id: 'navbar'}

    render(){
        const {id} = this.props;
        const activeClass = 'active';

        return (
            <nav id={id} className="navbar navbar-default">
                <ul className="nav navbar-nav">
                    <li><IndexLink to="/" activeClassName={activeClass} title="Trang chủ"><i className="icon-home2"></i> <span className="hidden-xs">Trang chủ</span></IndexLink></li>
                    <li><Link to="/sxh" activeClassName={activeClass} title="Sốt xuất huyết"><i className="icon-brain"></i> <span className="hidden-xs">Sốt xuất huyết</span></Link></li>
                    <li><a href={url_home("dieutra/sxh")} title="Quản lý ca bệnh"> <i className="icon-bookmark"></i> <span className="hidden-xs">Quản lý ca bệnh</span></a> </li>
                </ul>
                <ul className="nav navbar-nav navbar-right">
                    <li className="dropdown">
                        <a href="#" className="dropdown-toggle" data-toggle="dropdown">
                            <i className="icon-share4"></i>
                            <span className="visible-xs-inline-block position-right">Share</span>
                            <span className="caret"></span>
                        </a>

                        <ul className="dropdown-menu dropdown-menu-right">
                            <li><a onClick={() => appLayout.root.toggle('north')}><i className="icon-move-vertical"></i> Bật/ tắt Header</a></li>
                            <li><a onClick={() => {appLayout.root.toggle('north'); appLayout.main.toggle('west');}}><i className="icon-enlarge"></i> Mở rộng bản đồ</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        )
    }
}