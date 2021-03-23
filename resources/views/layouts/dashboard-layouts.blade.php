<!DOCTYPE html>
<html>
@include('layouts.includes.header')
  <body>
      @include('layouts.includes.sidebar')
      <div class="page">
      @include('layouts.includes.top')
      
      @yield('content')

      @include('layouts.includes.footer')
      </div>
      @include('layouts.includes.footer-js')
  </body>
</html>