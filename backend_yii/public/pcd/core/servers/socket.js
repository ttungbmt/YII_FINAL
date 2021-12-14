var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var connections = [];
var users = [];

// console.info("==> 🌎  Listening on port %s. Open up http://localhost:%s/ in your browser.", port, port)

const logData = (message) => {
    var d = new Date();
    var time = '[' + d.getHours() + ':'+ d.getMinutes() + ':' + d.getSeconds()  + ']';
    console.log(time + ' ' +message);
}

logData('Server has booted...');
io.on('connection', socket => {
    connections.push(socket);
    logData(`Connected: ${connections.length} sockets connected`);

    socket.once('disconnect', () => {
        for(let i = 0; i < users.length; i++){
            if(users[i].id == this.id){
                users.splice(i, 1);
            }
        }

        connections.splice(connections.indexOf(socket), 1)
        socket.disconnect();
        logData(`Disconnected: ${connections.length} sockets connected`);
        io.emit('disconnect', users)
    })

    socket.on('userJoined', payload => {
        users.push(payload);
        io.emit('userJoined', payload);
        logData(`User joined: ${payload.username}`);
    })

    socket.on('addMessage', payload => {
        io.emit('addMessage', payload);
    })
})


app.get('/', function(req, res){
    res.send('Hello World!');
});

server.listen(3010, function(){
    logData('Listening on *:3010');
});





// io.on('connection', function(socket){
//
//     socket.on('addMessage', payload => {
//         console.log(payload);
//     });
// });






//
// // app.use(cors());
// // app.use(express.static('./public'))
// app.get('/', (req, res) => {
//     res.send('Hello World!');
// });
//
// logData('Chat server has booted...');
// app.listen(3000, () => {
//
// });
//
// var connections = [];
// io.on('connection', socket => {
//     connections.push(socket);
//     logData(`Connected: ${connections.length} sockets connected`)
// })
//
//






