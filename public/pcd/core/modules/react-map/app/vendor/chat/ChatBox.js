import React, {Component, PropTypes} from 'react';
import { findDOMNode } from 'react-dom';
import axios from 'axios';
import {isEmpty} from 'lodash';

import io from 'socket.io-client';
import Pusher from 'pusher-js';

import Progress from '../../views/progress';
import ChatForm from './ChatForm';
import MessageList from './MessageList';

export default class ChatBox extends Component {
    static contextTypes = {
        srvData: PropTypes.object,
    };

    constructor(props, context){
        super(props);

        this.state = {
            showChat: true,
            status: 'disconnected',
            messages: [
                // {
                //     user: {username: 'Trợ lý ảo'},
                //     id: 1,
                //     text: 'Welcome to PCD'
                // }
            ],
            users: [],
            user: context.srvData.user
        };
    }

    componentWillMount(){
        Pusher.logToConsole = true;
        this.pusher = new Pusher('551bd6803b901334d7ff', {
            encrypted: true
        });

        this.channel = this.pusher.subscribe('CHAT_CHANNEL');

        this.channel.bind('addMessage', ::this.onAddMessage);


        // this.socket = io('http://pcd.hcmgis.vn/socket');
        // this.socket.emit('userJoined', this.state.user);
        // this.socket.on('connect', ::this.onConnect);
        // this.socket.on('addMessage', ::this.onAddMessage);
        // this.socket.on('disconnect', ::this.onDisconnect);
    }


    componentDidMount(){



        var self = this;
        $(this.nBody).perfectScrollbar();
        axios.get('/dichte/chat/view?id=1').then(res => {
            self.setState({messages: res.data})
        });

    }

    componentWillUpdate(){

    }

    componentDidUpdate(prevProps, prevState){
        let node = this.nBody;
        let shouldScrollBottom = node.scrollHeight != node.scrollTop + node.offsetHeight;

        if(shouldScrollBottom){
            node.scrollTop = node.scrollHeight;
        }
    }

    onConnect(){
        this.setState({status: 'connected'});
        console.log(`Connected: ${this.socket.id}`);
    }

    onDisconnect(users){
        this.setState({users: users});
        this.setState({status: 'disconnected'})
    }

    onUserJoined(users){
        this.setState({users: users});
    }

    onAddMessage(message) {
        this.setState({messages: this.state.messages.concat(message)});
    }

    emit(name, payload) {
        // this.socket.emit(name, payload);
    }

    setUser(user){
        this.setState({user: user});
    }

    getChatBox(){
        if(!this.state.showChat) return;

        const {messages} = this.state;

        return (
            <div>
                <div className="box-body" ref={c => this.nBody = c}>
                    {!isEmpty(messages) ? messages.map((message, i) => (
                        <MessageList key={i} message={message} user={this.state.user}  />
                    )): <Progress.L01 />}

                </div>
                <ChatForm emit={::this.emit} {...this.state} />

            </div>
        )
    }

    hideChat(){
        this.setState({showChat: false});
    }

    showChat(){
        this.setState({showChat: true});
    }

    closeChat(){
        this.props.dispatch({type: 'CHAT_STATUS', payload: false})
    }

    render() {12
        const {showChat} = this.state;

        return (
            <div className="box box-warning direct-chat direct-chat-warning">
                <div className="box-header with-border" onClick={showChat ? ::this.hideChat : ::this.showChat}>
                    <h3 className="box-title">Chat - Group PCD</h3>
                    <div className="box-tools pull-right">
                        <span data-toggle="tooltip" title="3 New Messages" className="badge bg-yellow">3</span>
                        <button type="button" className="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"> <i className="fa fa-comments"/></button>
                        <button onClick={::this.closeChat} type="button" className="btn btn-box-tool" data-widget="remove"><i className="fa fa-times"/></button>
                    </div>
                </div>

                {this.getChatBox()}
            </div>
        )
    }
}