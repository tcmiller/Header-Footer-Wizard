<link rel="stylesheet" href="http://depts.washington.edu/uweb/inc/css/header.css" type="text/css" media="screen" />
<link rel="stylesheet" href="http://depts.washington.edu/uweb/inc/css/print.css" type="text/css" media="print" />
<link rel="stylesheet" href="http://depts.washington.edu/uweb/inc/css/footer.css" type="text/css" media="screen" />
<script type="text/javascript">
  // clear out the global search input text field
  window.onload = function() {

     if (document.getElementById("searchInput")) {

       var query = document.getElementById("searchInput");

       query.onfocus = function() {
         if (query.value == query.defaultValue) {
           query.value = "";
         }
       }

       query.onblur = function() {
         if (query.value == "") {
           query.value = query.defaultValue;
         }
       }

     }
  }
</script>

