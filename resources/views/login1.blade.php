<html>
    <head>
    </head>
    <body>
        <form action="{{url('/login1')}}" method="post">
            @csrf
            <input type="text" name="mobile">
            <button type="submit">Submit</button>
        </form>
    </body>
</html>