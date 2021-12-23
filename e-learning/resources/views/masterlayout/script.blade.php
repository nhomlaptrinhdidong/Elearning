<script src={{ asset('js/jquery-3.3.1.min.js') }}></script>
<!-- Plugins js -->
<script src={{ asset('js/plugins.js') }}></script>
<!-- Popper js -->
<script src={{ asset('js/popper.min.js') }}></script>
<!-- Bootstrap js -->
<script src={{ asset('js/bootstrap.min.js') }}></script>
<!-- Counterup Js -->
<script src={{ asset('js/jquery.counterup.min.js') }}></script>
<!-- Moment Js -->
<script src={{ asset('js/moment.min.js') }}></script>
<!-- Waypoints Js -->
<script src={{ asset('js/jquery.waypoints.min.js') }}></script>
<!-- Scroll Up Js -->
<script src={{ asset('js/jquery.scrollUp.min.js') }}></script>
<!-- Full Calender Js -->
<script src={{ asset('js/fullcalendar.min.js') }}></script>
<!-- Chart Js -->
<script src={{ asset('js/Chart.min.js') }}></script>
<!-- Custom Js -->
<script src={{ asset('js/main.js') }}></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
        var type="{{ Session::get('alert-type', 'info') }}"
    
        switch(type){
        case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;
        case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;
        case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;
        case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;
        }
    @endif
</script>
