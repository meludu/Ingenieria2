<div class="container">
        <hr class="originf">
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-sm-12">
                    <center><p>Copyright &copy; Your Website 2014</p></center>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
    <!-- script para la validacion del registro-->
    <script type="text/javascript" src="<?php echo $concat;?>public/js/parsley.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $concat;?>public/js/bootstrap.min.js"></script>
    <!-- Menu Toggle Script -->
    <script src="<?php echo $concat;?>public/js/parsley.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        $("#addCat").click(function() {
            if(!($("#modifCategForm").find('.hidden') === [])){
               $("#modifCategForm").addClass('hidden'); 
            }
            $("#addCategForm").removeClass('hidden');
            $("#categoriaAlta").focus();
        });
        $(".editCategClass").click(function() {
            if(!($("#addCategForm").find('.hidden') === [])){
               $("#addCategForm").addClass('hidden'); 
            }
            $("#modifCategForm").removeClass('hidden');
            $("#categoriaEdit").focus();
        });
    </script>
</body>

</html>