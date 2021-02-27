<html>
    <head>
    </head>
    <body>
        <form action="{{url('/otp')}}" method="post">
            @csrf
            <input type="text" name="otp">
            <button type="submit">Submit</button>
        </form>
    </body>
</html>