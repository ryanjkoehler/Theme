<?php 
/**
 * The footer for our theme
 * 
 * @package SOCD
 */
?></section><!-- .site-wrap -->
<footer class="footer">
	<div class="site-wrap">
		<div class="gw">
			<div class="col one-half palm--one-whole">
				<h3 class="h4">Site Information</h3>
				<?php socd_network_footer(); ?>
			</div><!-- 
		 --><div class="col lap--one-half push--desk--one-sixth desk--one-third beta--box">
				<div class="cell">
					<h3 class="h3 heading--ruled">Beta Information</h3>
					<p>The site is currently under <a href="http://make.socd.io">active devlopment</a>. If you should encounter any bugs them please let us know via the <a href="<?php socd_beta_link(); ?>">&beta;</a> tab.</p>

					<p>If you're interested in the code behind all of this please take a look via <a href="http://github.com/socd-io/">Github</a>.</p>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>