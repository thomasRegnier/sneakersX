<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>Sneakers-X</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            .fade-enter-active, .fade-leave-active{
                transition: ease-in-out  .4s;
            }

            .fade-enter, .fade-leave-to{
                opacity: 0;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <Navbar></Navbar>
            <vue-snotify></vue-snotify>

            {{--<router-link :to="{ name: 'Home' }">Home</router-link> |--}}
            {{--<router-link :to="{ path: '/' }">Hello World</router-link>--}}
            <div>
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </div>
            <My-foot></My-foot>
        </div>
        <script src="https://kit.fontawesome.com/6462e1d77a.js" crossorigin="anonymous"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
