<!DOCTYPE html>
<html>
<head>
    <title>Create Country</title>
</head>
<body>
    <h2>Add New Country</h2>
    <form action="{{ route('countries.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="iso">ISO:</label>
        <input type="text" name="iso" id="iso" required>
        <br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
