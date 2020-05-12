import React, {Component, PropTypes} from 'react';
import moment from 'moment';

export default class ChatForm extends Component {

    onSubmit(e){
        e.preventDefault();
        const {emit, user} = this.props;

        let message = {
            user,
            text: this.refs.message.value.trim(),
            // datetime: moment().format('YYYY MM DD HH:mm:ss'),
            datetime: '',
        };

        emit('addMessage', message);

        $.post(url_home('dichte/message/create'), message);

        // Clear form
        this.refs.message.value = '';

    }

    render() {
        return (
            <div className="box-footer">
                <form onSubmit={::this.onSubmit}>
                    <div className="input-group">
                        <input ref="message" type="text" name="message" placeholder="Nhập tin nhắn ..." className="form-control"/>
                        <span className="input-group-btn">
                            <button type="submit" className="btn btn-warning">Send</button>
                        </span>
                    </div>
                </form>
            </div>
        )
    }
}