<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h2>Insert Student</h2>
    <form action="/add-student" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Age:</label>
        <input type="number" name="age" required><br><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
