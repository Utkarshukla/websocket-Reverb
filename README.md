# Real-Time Chat Application with Laravel and React

This is a simple real-time chat application built with Laravel for the backend API and React for the frontend.

## Installation

1. Run the following command to install broadcasting support in Laravel:

    ```bash
    php artisan install:broadcasting
    ```

2. Generate an event class named `TestBroad`:

    ```bash
    php artisan make:event TestBroad
    ```

3. Implement the `ShouldBroadcast` interface in the `TestBroad` class and update the `broadcastOn` method as follows:

    ```php
    <?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestBroad implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $eventData;
    public function __construct($data)
    {
        $this->eventData= $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastWith():array 
    {
        return [
            'dataa'=>$this->eventData
        ];

    }
    public function broadcastOn(): array
    {
        return [
            new Channel('testBroadcast'),
        ];
    }
}

    ```

4. Create a Blade template for broadcasting messages:

    ```blade
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
    ```
```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish Message</title>
</head>
<body>
    <form method="POST" action="{{ route('publishmessage.post') }}">
        @csrf
        <label for="data">Data:</label><br>
        <input type="text" id="data" name="data"><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message"></textarea><br>
        <button type="submit">Publish</button>
    </form>
</body>
</html>

```

```routes
Route::get('/publish', function(){
    return view('send');
})->name('publish');

Route::post('/publish', function(){
    $data = [
        'data' => request('data'),
        'message' => request('message'),
    ];
    event(new TestBroad($data));
    
    return redirect()->route('publish')->with('success', 'Message published successfully!');
})->name('publishmessage.post');
```
## Usage

- Start Reverb and the queue worker in separate terminals:

    ```bash
    php artisan reverb:start
    php artisan queue:work
    ```

- Access the `/publish` route in your browser to send messages.

## Routes

- **GET** `/publish`: Displays the form to send messages.
- **POST** `/publish`: Sends the message data to the backend and broadcasts it.

## Views

- `send.blade.php`: Form to send messages.
- `display.blade.php`: Display area for received messages.

## Contributing

Contributions are welcome! Fork the repository and submit a pull request.

## License

This project is open-source and available under the [MIT License](LICENSE).
