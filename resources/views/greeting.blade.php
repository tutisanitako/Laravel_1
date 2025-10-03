<!DOCTYPE html>
<html>
<head>
    <title>Greeting Generator</title>
</head>
<body>
    <h1>Personalized Greeting Generator</h1>

    <form action="/greeting" method="POST">
        @csrf  <!-- Security token - Laravel requires this! -->

        <p>
            <label>Your name:</label><br>
            <input type="text" name="user_name">
        </p>

        <p>
            <label>Favorite color:</label><br>
            <input type="text" name="favorite_color">
        </p>

        <p>
            <label>What do you like to do the most?</label><br>
            <textarea name="favorite_activity"></textarea>
        </p>

        <button type="submit">Generate Greeting</button>
    </form>
</body>
</html>
