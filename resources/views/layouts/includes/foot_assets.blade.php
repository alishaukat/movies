<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Common JavaScript -->
<script src="{{ asset('assets/js/common.js') }}"></script>

<script>
$(function(){
    $('.back-btn').click(function(){
        window.location = '{{ URL::previous()  }}';
    });
});
</script>