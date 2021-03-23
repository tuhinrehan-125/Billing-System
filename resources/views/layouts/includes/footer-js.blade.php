 <!-- JavaScript files-->
 <script src="{{asset('backend/')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('backend/')}}/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="{{asset('backend/')}}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('backend/')}}/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="{{asset('backend/')}}/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="{{asset('backend/')}}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{asset('backend/')}}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{asset('backend/')}}/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="{{asset('backend/')}}/js/front.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    {!! Toastr::message() !!}
    @yield('js')