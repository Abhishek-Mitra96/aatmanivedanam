    <!-- jQuery 2.2.0 -->
<!-- <script src="../assets/plugins/jQuery/jQuery-2.2.0.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Dropzone for multiple file upload -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
<!-- SlimScroll -->
<!-- <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script> -->
<!-- FastClick -->
<!-- <script src="../assets/plugins/fastclick/fastclick.js"></script> -->
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js"></script>
<script src="../assets/js/scripts.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../assets/dist/js/demo.js"></script> -->

<script src="../assets/plugins/chosen/chosen.jquery.js" type="text/javascript"></script>

<script src="../assets/plugins/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

var config = {

  '.chosen-select'           : {},

  '.chosen-select-deselect'  : {allow_single_deselect:true},

  '.chosen-select-no-single' : {disable_search_threshold:10},

  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},

  '.chosen-select-width'     : {width:"95%"}

}

for (var selector in config) {

  $(selector).chosen(config[selector]);

}

</script>