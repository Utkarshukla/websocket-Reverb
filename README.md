installation 

1. php artisan install:broadcasting
2. php artisan make:event TestBroad
3. implements ShouldBroadcast add to your TestBroad class and change your broadcast function like this 
public function broadcastOn(): array
    {
        return [
            new Channel('testBroadcast'),
        ];
    }
4. lets create a blade template for broadcast 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @vite('resources/js/app.js')
</body>
<script>
    setTimeout(() => {
        window.Echo.channel('testBroadcast')
        .listen('TestBroad', (e)=>{
            console.log(e);
        })
    }, 200);
</script>
</html>

5. start reverb and queue in 2 terminal
 php artisan reverb:start
 php artisan queue:work
 