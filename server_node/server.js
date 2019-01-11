var io=require('socket.io')(6001)
console.log('Connect to port 6001')
io.on('error',function(socket){
    console.log('error')
})
io.on('connection',function(socket) {
    console.log('co nguoi ket noi '+socket.id);

    socket.on('createMessage', (message, callback) => {
        // m lay du lieu o day 
        console.log(message);
        io.emit('newMessage', {
            from: message.from, 
            text: message.text,
            time: message.time,
            id:message.id
        });
        callback();
    });
     
    socket.on('productchange' , function(data){
            console.log(data);
            io.emit('productHaschange', {
          id:data.id,
          name : data.name,
          price: data.price,
          pricepromotion :data.pricepromotion,
          img :data.img,
        });
    });

    socket.on('productadd' , function(data){
            console.log(data);
            io.emit('producthasAdd', {
            name : data.name,
            img :data.img,
            price: data.price,
            pricepromotion :data.pricepromotion,
            txtDescription:data.txtDescription,
            txtIntro:data.txtIntro,
            txtContent:data.txtContent,
            txtKeywords:data.txtKeywords
        });
    });
     socket.on('message', (message, callback) => {
        // m lay du lieu o day 
        console.log(message);
        io.emit('message', {
            from: message.from, 
            content: message.content,
            idRecive:message.id,
            time: message.time
          
        });
     
    });

})

