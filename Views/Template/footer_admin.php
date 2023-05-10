 <!-- Essential javascripts for application to work-->
  <script>
    const baseurl="<?= base_url(); ?>";
  </script>
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="<?= media() ?>/js/jquery-3.3.1.min.js"></script>
    
    <script src="<?= media() ?>/js/popper.min.js"></script>
    <script src="<?= media() ?>/js/bootstrap.min.js"></script>
    <script src="<?= media() ?>/js/main.js"></script>
   
    <script src="<?= media(); ?>/js/functionsadmin.js"></script>
    <script src="<?= media() ?>/js/plugins/pace.min.js"></script>
    <script src="<?= media() ?>/js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="<?= media() ?>/js/plugins/sweetalert.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="<?= media() ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= media() ?>/js/plugins/dataTables.bootstrap.min.js"></script>
  
    <script type="text/javascript" src="<?= media() ?>/js/plugins/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="<?= media() ?>/js/plugins/moment.min.js"></script>



    <script src="<?= media() ?>/js/printThis.js"></script>
    <script src="<?= media() ?>/js/<?= $data['page_js'] ?>"></script>
    

    <!-- The javascript plugin to display page loading on top-->
  
  </body>
</html>