<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sneakers-X</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">

        <!-- Styles -->
    </head>
    <body>
        <div id="app">
            <Navbar></Navbar>
            {{--<router-link :to="{ name: 'Home' }">Home</router-link> |--}}
            {{--<router-link :to="{ path: '/' }">Hello World</router-link>--}}

            <div>
                <router-view></router-view>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/6462e1d77a.js" crossorigin="anonymous"></script>

        <script src="/js/app.js"></script>
    </body>
</html>
