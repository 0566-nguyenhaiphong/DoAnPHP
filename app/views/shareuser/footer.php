<!-- Newsletter -->

<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h4>Newsletter</h4>
						<p>Subscribe to our newsletter and get 20% off your first purchase</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<!-- Footer -->

<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
						<ul class="footer_nav">
							<li><a href="#">Blog</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="contact.html">Contact us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="footer_nav_container">
						<div class="cr">©2018 All Rights Reserverd. Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#">Colorlib</a> &amp; distributed by <a href="https://themewagon.com">ThemeWagon</a></div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<script src="/chieu2/public/js/jquery-3.2.1.min.js"></script>
<script src="/chieu2/public/styles/bootstrap4/popper.js"></script>
<script src="/chieu2/public/styles/bootstrap4/bootstrap.min.js"></script>
<script src="/chieu2/public/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="/chieu2/public/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="/chieu2/public/plugins/easing/easing.js"></script>
<script src="/chieu2/public/js/custom.js"></script>
<!-- <script src="/chieu2/public/js/cart.js"></script> -->
<script>
    $(document).ready(function () {
        $('body').on('click', '.btn-save', function () {
            var id = $(this).data("id");
            var btn = $(this);

            $.ajax({
                url: '/chieu2/voucher/saveVoucher',
                type: 'POST',
                data: { id: id },
                success: function (rs) {
                    if (!rs.Success) {
                        alert(rs.Message);
                    } else {
                        // Chuyển màu và hiển thị thông báo đã lưu
                        btn.removeClass('btn-primary').addClass('btn-success').html('<i class="fa fa-check btn-icon" aria-hidden="true"></i>Đã lưu');
                        btn.prop('disabled', true); // Disable nút sau khi đã lưu
                    }
                }
            });
        });
    });
</script>

</body>