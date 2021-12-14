import React, {Component, PropTypes} from 'react';
import {connect} from 'react-redux';
import Noty from 'react-notification-system';

class FlashNoty extends Component {
    componentWillReceiveProps(nextProps){
        const {flashNoty} = nextProps;
        if (flashNoty != this.props.flashNoty) {
            this.noty.addNotification(flashNoty)
        }
    }

    render(){
        return (
            <Noty ref={c => this.noty = c} allowHTML/>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        flashNoty: state.flashNoty
    }
}
export default connect(mapStateToProps)(FlashNoty);
