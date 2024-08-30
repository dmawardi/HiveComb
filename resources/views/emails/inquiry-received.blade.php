<!DOCTYPE html>
<html>
<head>
    <title>New Inquiry Received</title>
</head>
<body>
    <h1>New Inquiry Received</h1>
    <p><strong>Name:</strong> {{ $inquiry->name }}</p>
    <p><strong>Email:</strong> {{ $inquiry->email }}</p>
    <p><strong>Phone:</strong> {{ $inquiry->phone }}</p>
    <p><strong>Company Name:</strong> {{ $inquiry->company_name }}</p>
    <p><strong>Website:</strong> {{ $inquiry->website }}</p>
    <p><strong>Type:</strong> {{ $inquiry->type }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $inquiry->message }}</p>
</body>
</html>
