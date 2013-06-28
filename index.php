<?php
/**
 * @package SOCD
 */

get_header(); ?>

<section class="gw">
	<section class="col--side">
		<div class="cell colour--blue">
			<h2 class="h2 h2--ruled">About</h2>
			<?php bloginfo( 'description' ); ?>
		</div>
	</section><!-- 
	--><section class="col--stream stream">
		<div class="cell colour--white">

			<div id="posts-container">
				<?php while( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'partials/post/post'); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</section><!--
	--><aside class="sidebar col--side">
		<div class="cell colour--light-grey">
			
			<div id="rss-3" class="widget widget_rss">
				<ul>
					<li><a class="rsswidget" href="http://workshops.gdnm.org/workshop/demonstration-of-the-fag-letterpress-press-and-photopolymer-plates/" title="WHAT:&nbsp;This is a demonstration on how we can use photopolymer relief plates to expose computer generated artwork onto plates which can be used to print on our FAG letterpress press.&nbsp;This is not a workshop, you will not be creating your own work in this session but you will understand how the process works and see […]">Demonstration of the FAG Letterpress press and photopolymer plates</a></li>
					<li><a class="rsswidget" href="http://workshops.gdnm.org/workshop/screen-printing-inductions-february/" title="This workshop with Liz Wilson, the campus screen printing&nbsp;technician&nbsp;will be for Year 2 and Year 3, Graphic Design: New Media students only. To use the print rooms you will need to complete this induction, and places are limited so please ensure you are there sharp by 10am so as not to miss your&nbsp;opportunity or waste […]">Screen Printing Inductions – February</a></li>
					<li><a class="rsswidget" href="http://workshops.gdnm.org/workshop/screen-printing-inductions-januar/" title="This workshop with Liz Wilson, the campus screen printing&nbsp;technician&nbsp;will be for Year 2 and Year 3, Graphic Design: New Media students only. To use the print rooms you will need to complete this induction, and places are limited so please ensure you are there sharp by 10am so as not to miss your&nbsp;opportunity or waste […]">Screen Printing Inductions – January</a></li>
					<li><a class="rsswidget" href="http://workshops.gdnm.org/workshop/laser-cutter-and-illustrator/" title="In this workshop you will learn the basics of how to use Adobe Illustrator to design for the Laser Cutter, this will conclude with a trip to the laser cutter to fabricate our small objects in the laser cutter. Requirements: The only requirement is a basic&nbsp;knowledge&nbsp;of how to use Adobe Illustrator. Image:&nbsp;John&nbsp;St Ledger &nbsp; […]">Laser Cutter and Illustrator</a></li>
					<li><a class="rsswidget" href="http://workshops.gdnm.org/workshop/arduino-and-processing/" title="In this workshop we will continue our previous train of thought where we were using the Arduino and Processing to create an interface for the 3D cube visualiser. Requirements: You will need to have attended the previous workshop where we were playing with the potentiometer attached to an Arduino which&nbsp;controls&nbsp;processing. If you didn’t attend then […]">Arduino  and Processing</a></li>
				</ul>
			</div><!-- .widget -->

			<div id="text-3" class="widget widget_text">
				<h3 class="h2">Quick Links</h3>
				<div class="textwidget">
					<a href="http://printarea.gdnm.org/">Print Area Blog</a>
					<a href="http://workshops.gdnm.org/">Workshops</a>
					
					<h1>Directory</h1>
					<a href="http://gdnm.org/directory/?course=gdnm&amp;group=1">GDNM Year One</a>
					<a href="http://gdnm.org/directory/?course=gdnm&amp;group=2">GDNM Year Two</a>
					<a href="http://gdnm.org/directory/?course=gdnm&amp;group=3">GDNM Year Three</a>
					
					<h1>Forum</h1>
					<a href="http://forum.gdnm.org/all/graphic-design-new-media/year-3/" title="forum for GDNM year 3">GDNM Year 3</a>
				</div><!-- .text-widget -->
			</div>

			<div id="pages-3" class="widget widget_pages">
				<h3 class="h2">GDNM Y3 EXTRA:</h3>
				<ul>
					<li class="page_item page-item-2358"><a href="http://year3.gdnm.org/references/">Design References</a></li>
				</ul>
			</div><!-- .widget -->
		</div><!-- .cell.colour-0grey -->
	</aside>
</section><!-- .gw -->

<?php get_footer(); ?>