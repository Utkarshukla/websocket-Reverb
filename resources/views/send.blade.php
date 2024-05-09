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
