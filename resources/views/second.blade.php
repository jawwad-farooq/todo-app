<html>
 <body>
    <x-header componentName="secondS" />
    <h1>secong page</h1>
    <a href="/welcome">first page</a>
    <h4>{{URL::previous()}}</h4>
    <a href="{{URL::to('/welcome')}}"></a>
    @include('message')
 </body>
</html>