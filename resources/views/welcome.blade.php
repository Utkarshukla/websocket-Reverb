<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="messages">
        <!-- Messages will be displayed here -->
    </div>
    @vite('resources/js/app.js')
</body>
<script>
    setTimeout(() => {
        window.Echo.channel('testBroadcast')
        
        .listen('TestBroad', (e)=>{
            console.log(e);
            const { data, message } = e.dataa;
            // const { data, message } = e.dataa;
        const messagesDiv = document.getElementById('messages');
        const messageElement = document.createElement('div');
        messageElement.textContent = `${data}: ${message}`;
        messagesDiv.appendChild(messageElement);
        })
    }, 50);
</script>
</html>