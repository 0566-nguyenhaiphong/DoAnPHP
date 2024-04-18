</div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/chieu2/public/vendor/jquery/jquery.min.js"></script>
    <script src="/chieu2/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/chieu2/public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/chieu2/public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/chieu2/public/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/chieu2/public/js/demo/chart-area-demo.js"></script>
    <script src="/chieu2/public/js/demo/chart-pie-demo.js"></script>
    <script>
        $(document).ready(function(){
            $(".delete-btn").click(function(){
                var id = $(this).data('id');
                var row = $(this).closest("tr");

                var conf = confirm("Bạn có muốn xoá sản phẩm này không ?")
                if(conf){
                    $.ajax({
                    url: '/chieu2/product/delete',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if(response === 'success') {
                            row.remove();
                            alert('Xóa sản phẩm thành công!');
                        } else {
                            alert('Đã xảy ra lỗi, vui lòng thử lại sau.');
                        }
                    }
                });
                }
                
            });
        });
    
    $(document).ready(function(){
        $(".delete-btn-category").click(function(){
            var id = $(this).data('id');
            var type = $(this).data('type');
            var row = $(this).closest("tr");

            var confirmMessage = "Bạn có muốn xoá " + type + " này không ?";
            
            var conf = confirm(confirmMessage);
            if(conf){
                $.ajax({
                    url: '/chieu2/' + type + '/delete',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if(response === 'success') {
                            row.remove();
                        } else {
                            alert('Đã xảy ra lỗi, vui lòng thử lại sau.');
                        }
                    }
                });
            }
        });
    });
    $(document).ready(function(){
        $(".delete-btn-voucher").click(function(){
            var id = $(this).data('id');
            var type = $(this).data('type');
            var row = $(this).closest("tr");

            var confirmMessage = "Bạn có muốn xoá " + type + " này không ?";
            
            var conf = confirm(confirmMessage);
            if(conf){
                $.ajax({
                    url: '/chieu2/' + type + '/delete',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        if(response === 'success') {
                            row.remove();
                        } else {
                            alert('Đã xảy ra lỗi, vui lòng thử lại sau.');
                        }
                    }
                });
            }
        });
    });
    </script>

</body>

</html>