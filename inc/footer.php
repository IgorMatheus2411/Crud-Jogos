
	<hr>
	</main> <!-- /container -->

	<footer class="container">
		<?php $hoje = new DateTime("now", new DateTimeZone("America/Sao_Paulo")); ?>
		<p class="pn">&copy;2023 a <?php echo $hoje->format("Y"); ?> - Projeto PW Higor e Igor</p>
	</footer>

	<script src="<?php echo BASEURL; ?>js/jquery.js"></script>
	<script src="<?php echo BASEURL; ?>js/popper.js"></script>
    <script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
	<script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/main.js"></script>
</body>
</html>