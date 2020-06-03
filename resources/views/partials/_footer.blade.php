

<footer class="main-footer fixed-btm">
  © Copyright <?php echo date('Y'); ?> School Revenue. All rights reserved.
</footer>
<!-- END: .main-footer -->
</div>
<!-- END: .app-wrap -->

<!-- jQuery first, then Tether, then other JS. -->
<script src="{{ asset('assets/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/unifyMenu/unifyMenu.js') }}"></script>
<script src="{{ asset('assets/vendor/onoffcanvas/onoffcanvas.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>

<!-- Slimscroll JS -->
<script src="{{ asset('assets/vendor/slimscroll/slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/vendor/slimscroll/custom-scrollbar.js') }}"></script>


<!-- Common JS -->
<script src="{{ asset('assets/js/common.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.js') }}"></script>
<script src="{{ asset('assets/js/jquery.datetimepicker.full.min.js') }}"></script>

<script src="{{ asset('assets/vendor/gallery/baguetteBox.js') }}"></script>
<script src="{{ asset('assets/vendor/gallery/plugins.js') }}"></script>
<script src="{{ asset('assets/vendor/gallery/custom-gallery.js') }}"></script>

<script src="{{ asset('assets/vendor/d3/d3.min.js') }}"></script>
<script src="{{ asset('assets/vendor/c3/c3.min.js') }}"></script>
<script src="{{ asset('assets/vendor/c3/custom/area-spline-graph.js') }}"></script>
<script src="{{ asset('assets/vendor/c3/custom/bar-graph.js') }}"></script>
<script src="{{ asset('assets/vendor/c3/custom/pie-chart.js') }}"></script>


{{-- Basic DataTable --}}
<script>
  $(function(){
    $('#basicExample').DataTable({
      'iDisplayLength': 10,
    });
  });

  $(document).ready(function () {

    //Prevent characters or string asides number in ohone number input field 
    $("#phone_no, #amount, #card_number, #expiry_year, #expiry_month, #ccv_code, #account_number, #course_unit").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });  

    $(document).on('click', '#dob, #date_joined, #registration_date', function(){
      // Url for more info on datepicker options https://xdsoft.net/jqplugins/datetimepicker/
        $('#dob, #date_joined, #registration_date').datetimepicker({
            // format: 'L', //LT for time only
            // inline: true,
            // sideBySide: true,
            format:'Y/m/d',
            formatDate:'Y/m/d',
            //minDate:'-1970/01/02', // yesterday is minimum date
            maxDate: '+1970/01/02', // yesterday is minimum date
            timepicker: false, //Only date should be displayed
            // datepicker: false, //Only time should be displayed
        });
      });

    

});
</script>