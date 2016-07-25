<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- including metas -->
        @section('metas')
            @include('layouts.includes.meta')
        @show
        
        <!-- including title -->
        <title>
        @section('title')
            Movies
        @show
        </title>
        
        <!-- including assets -->
        @section('head_asset')
            @include('layouts.includes.head_assets')
        @show
        
    </head>
    <body>
            @include('layouts.includes.nav')
            <!-- Page Content -->
            <div class="container">
                @include('layouts.includes.header')
                @yield('content')
                @include('layouts.includes.footer')
            </div>
        
        <!-- including assets -->
        @section('foot_asset')
            @include('layouts.includes.foot_assets')
        @show
    </body>
</html>
