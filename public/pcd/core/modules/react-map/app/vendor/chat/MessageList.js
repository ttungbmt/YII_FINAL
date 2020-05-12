import React, {Component, PropTypes} from 'react';
import moment from 'moment';

export default class MessageList extends Component {

    formatTime(datetime) {
        // return moment(datetime).format('D MMMM H:mm').toUpperCase();
        return '';
    }

    render() {
        const {message, user} = this.props;

        if (message.user.username != user.username) {
            return (
                <div className="direct-chat-msg left">
                    <div className="direct-chat-info clearfix">
                        <span className="direct-chat-name pull-left">{message.user.username}</span>
                        <span className="direct-chat-timestamp pull-right">{this.formatTime(message.datetime)}</span>
                    </div>
                    <img className="direct-chat-img" src="http://bootdey.com/img/Content/user_1.jpg"
                         alt="Message User Image"/>{/* /.direct-chat-img */}
                    <div className="direct-chat-text">
                        {message.text}
                    </div>
                </div>
            )
        } else {
            return (
                <div className="direct-chat-msg right">
                    <div className="direct-chat-info clearfix">
                        <span className="direct-chat-name pull-right">{message.user.username}</span>
                        <span className="direct-chat-timestamp pull-left">{this.formatTime(message.datetime)}</span>
                    </div>
                    <img className="direct-chat-img" src="http://bootdey.com/img/Content/user_2.jpg" alt="Message User Image" />{/* /.direct-chat-img */}
                    <div className="direct-chat-text">
                        {message.text}
                    </div>
                </div>
            )
        }


    }
}
// 23 Jan 2:00 pm
