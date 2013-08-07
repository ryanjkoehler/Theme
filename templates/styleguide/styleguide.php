<?php
/**
 * Template Name: Styleguide
 * 
 * @package  socd
 */
get_header(); ?>

<h1>Typography</h1>
<section>
	<?php for ( $i=1; $i < 6; $i++ ) { printf( '<h%1$d class="h%1$d">Heading %1$d</h%1$d>', $i ); } ?>
</section>
<div class="wysiwyg">
	<p data-fixie class="fixie"></p>
	<ul data-fixie class="fixie">
		<li data-fixie class="fixie"></li>
		<ul data-fixie class="fixie"></ul>
	</ul>
	<ol data-fixie></ol>
	<ul class="listing__navigation" data-fixie></ul>

	<p data-fixie data-fixie-clone="2"></p>
</div>


<h1>Modules</h1>
<section>
	
	<div class="cell">
		<h1 class="h2 h2--ruled">Sample Heading</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat, felis eget eleifend porta, mi mi iaculis quam, sit amet pharetra ante massa sed magna. Morbi vulputate augue quis nibh cursus sed accumsan massa sodales. Aenean nec aliquet leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi eget pharetra tellus. Donec vitae rutrum justo. Curabitur semper, diam id congue dapibus, dolor nulla hendrerit urna, vitae commodo nulla orci eu neque. Sed eros lacus, sollicitudin ut ornare vitae, fermentum eget orci. Morbi dictum nibh et lectus suscipit pharetra vitae et ipsum.</p>
	</div>
</section>

<section>
<label for="name">Name</label>
<input class="input_full" type="text" id="name" name="name" required="required">

<label for="email">Email</label>
<input class="input_full" type="email" id="email" name="email" required="required">

<label for="cc"><abbr title="Courtesy Copy">CC</abbr></label>
<input type="checkbox" id="cc" name="cc" value="1">
<label for="cc">Send me a copy of this email</label>

<label for="tel">Phone</label>
<input class="input_full" type="tel" id="tel" name="tel" required="required">

<label for="url">URL</label>
<input class="input_full" type="text" id="url" name="url" placeholder="http://">

<label for="budget">Budget</label>
<select class="input_full" id="budget" name="budget">
  <option value="">Ballpark estimate...</option>
  <optgroup label="Small">
    <option value="1k_2k">$1,000 to 2,000</option>
    <option value="2k_3k">$2,000 to 3,000</option>
    <option value="3k_4k">$3,000 to 4,000</option>
    <option value="4k_5k">$4,000 to 5,000</option>
    <option value="5k_6k">$5,000 to 6,000</option>
  </optgroup>
  <optgroup label="Medium">
    <option value="6k_7k">$6,000 to 7,000</option>
    <option value="7k_8k">$7,000 to 8,000</option>
    <option value="8k_9k">$8,000 to 9,000</option>
    <option value="9k_1k0">$9,000 to 10,000</option>
    <option value="10k_11k">$10,000 to 11,000</option>
  </optgroup>
  <optgroup label="Large">
    <option value="11k_12k">$11,000 to 12,000</option>
    <option value="12k_13k">$12,000 to 13,000</option>
    <option value="13k_14k">$13,000 to 14,000</option>
    <option value="14k_15k">$14,000 to 15,000</option>
    <option value="15k_16k">$15,000 to 16,000</option>
  </optgroup>
  <optgroup label="Jumbo">
    <option value="16k_17k">$16,000 to 17,000</option>
    <option value="17k_18k">$17,000 to 18,000</option>
    <option value="18k_19k">$18,000 to 19,000</option>
    <option value="19k_20k">$19,000 to 20,000</option>
  </optgroup>
  <optgroup label="Ginormous">
    <option value="over_20k">over $20,000</option>
  </optgroup>
</select>

<label for="priority_normal">Priority</label>
<input type="radio" name="priority" id="priority_urgent" value="Urgent">
<label for="priority_urgent">Urgent</label>
<input type="radio" name="priority" id="priority_normal" value="Normal" checked="checked">
<label for="priority_normal">Normal</label>
<input type="radio" name="priority" id="priority_low" value="Low">
<label for="priority_low"><abbr title="Request For Proposal">RFP</abbr> <span class="mute">(low)</span></label>

<label for="description">
  Project<br>details</label>
<textarea id="description" name="description" rows="8" required="required"></textarea>

</section>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/javascript/libs/fixie/fixie.js"></script>
<?php get_footer();