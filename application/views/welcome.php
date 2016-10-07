<div class="layout">

    <?php $this->load->view('templates/nav'); ?>

	<div class="layout-content">
<!--        <figure class="cover-photo"></figure>-->
        <?php
            if($this->session->_get('id')) {
//                $this->load->view('login/login-form');
                //echo 'user already login';
            } else {
                $this->load->view('login/login-form');
            }
        ?>

		<main class="main" role="main">
			<article class="article">

			</article>
		</main>

	</div>

</div>