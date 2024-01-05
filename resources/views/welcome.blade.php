<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Real Time Notification</title>


</head>

<body>
    <h5zzz>User Data : <span id="event-data"></span></h5zzz>
</body>
<script src="{{ asset('build/assets/app-AJTRl3Cv.js') }}"></script>
<script>
    Echo.channel('testChannel').listen('TestEvent', (e) => {
        document.getElementById('event-data').innerText = e.test
    })
</script>

</html>
