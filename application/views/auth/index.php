		<div>
			<div class="login_wrapper">
				<div class="form login_form">
					<?= $this->session->flashdata('message'); ?>
					<?php if (validation_errors()) { ?>
						<div class="alert alert-danger" role="alert">
							<?= validation_errors(); ?>
						</div>
					<?php } ?>
					<section class="login_content">
						<form action="<?= base_url("Auth") ?>" method="post">
							<h1>Login </h1>
							<div>
								<input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" />
							</div>
							<div>
								<input type="password" name="password" class="form-control" placeholder="Password" />
							</div>
							<div>
								<button class="btn btn-default submit">Login </button>
							</div>
							<div class="clearfix"></div>
							<div class="separator">
								<p class="change_link">Belum Punya Akun?
									<a href="<?= base_url("Auth/registrasi") ?>"> Daftar Disini </a>
								</p>
								<div class="clearfix"></div>
								<div>
									<h1><i class="fa fa-ticket"></i> <span>E-Ticket Parkir</span></h1>
									<p>©2020 All Rights Reserved. I'm Posible</p>
								</div>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>