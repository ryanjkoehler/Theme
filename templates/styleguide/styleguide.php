<?php
/**
 * Template Name: Styleguide
 * 
 * @package  socd
 */
get_header(); ?>
<style>
    
    /**
     * Styleguide Only
     */
    
    .styleguide section {
      position: relative;
      padding-bottom: 2em;
      margin-bottom: 2em;
    }
    
    .styleguide section:after {
      left: 50%;
    }

    body {
      position: relative;
      height: auto;
    }
    
    /**
     * Thanks to --> http://basehold.it/
     */
    body:after {
      position: absolute;
      width: auto;
      height: auto;
      z-index: 9999;
      content: '';
      display: none;
      pointer-events: none;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/baseline.png') repeat top left;
    }

    body:hover:after {
      display: block;
    }

</style>
<header class="header">
	<h1 class="h1 site--title">Styleguide</h1>
  <p>Intended to cover the styling and markup conventions used on the site.</p>
</header>
<div class="styleguide">
  
  <section>
  <h1 class="h2">Typography</h1>

  <?php

  /**
   * Headings
   * 
   */
  

  
  for ( $i=1; $i < 6; $i++ ) {

    printf( '<h%1$d class="h%1$d">Heading %1$d</h%1$d><h%1$d class="h%1$d">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat, felis eget eleifend porta, mi mi iaculis quam, sit amet pharetra ante massa sed magna.</h%1$d>', $i );

  } ?>

  <h2 class="h2">Special Cases</h2>

  <div class="header"><h1 class="h1 site--title">Page Title</h1></div>

  <div class="header">
    <h1 class="h1 site--title">Page Title</h1>
    <h2 class="blog--title">with Subheading</h2>
  </div>

</section>

<section>
  <h1 class="h2"><abbr title="What You See Is What You Get">WYSIWYG</abbr> Output</h1>
  <div class="wysiwyg">
  <p class="fixie"></p>
  <ul>
    <li class="fixie"></li>
    <ul class="fixie"></ul>
  </ul>
  <ol class="fixie"></ol>
  <ul class="fixie listing__navigation"></ul>

  <p class="fixie" data-fixie-clone="2"></p>
</div>

</section>

<section>
  <h1 class="h2">Modules</h1>  
  <div class="cell colour--white">
    <h1 class="h2 h2--ruled">Sample Heading</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse feugiat, felis eget eleifend porta, mi mi iaculis quam, sit amet pharetra ante massa sed magna. Morbi vulputate augue quis nibh cursus sed accumsan massa sodales. Aenean nec aliquet leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi eget pharetra tellus. Donec vitae rutrum justo. Curabitur semper, diam id congue dapibus, dolor nulla hendrerit urna, vitae commodo nulla orci eu neque. Sed eros lacus, sollicitudin ut ornare vitae, fermentum eget orci. Morbi dictum nibh et lectus suscipit pharetra vitae et ipsum.</p>
  </div>
</section>

<section id="form">
  <h1 class="h2">Form</h1>
  <form action="">

    <label for="name">Name</label>
    <input class="fixie" type="text" id="name" name="name" required="required">

    <label for="email">Email</label>
    <input class="fixie" type="email" id="email" name="email" required="required">

    <label for="cc"><abbr title="Courtesy Copy">CC</abbr></label>
    <input type="checkbox" id="cc" name="cc" value="1">
    <label for="cc">Send me a copy of this email</label>

    <label for="tel">Phone</label>
    <input class="fixie" type="tel" id="tel" name="tel" required="required">

    <label for="url">URL</label>
    <input class="fixie" type="text" id="url" name="url" placeholder="http://">

    <label for="budget">Budget</label>
    <select class="fixie" id="budget" name="budget">
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
        <option value="13k_14k">$13,000 to 14,000</option>_
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
  
    <input type="submit"/>

    <h2 class="h2">Input States</h2>
    <label for="">Pseudo: Hover</label><input type="text" class="s__hover"/>
    <label for="">Pseudo: Focus</label><input type="text" class="s__focus"/>
</form>

<p>Used in client side validation to alert the user to any issues with the supplied information.</p>
<label for="name">Statuses</label><input id="statuses" type="text"/>
<label for="name">Status: Checking</label><input type="text" class="s__checking"/>
<label for="name">Status: Error</label><input type="text" class="s__error"/>
<label for="name">Status: OK</label><input type="text" class="s__ok"/>

</section>
<section>
  <h1 class="h2">Notifications</h1>
  <div class="notifications-message"><p class="fixie"></p><a href="#" class="notifications-message--dismiss">&times;</a></div>
  <div class="notifications-message notifications-message__ambivalent"><p class="fixie"></p><a href="#" class="notifications-message--dismiss">&times;</a></div>
  <div class="notifications-message notifications-message__positive"><p class="fixie"></p><a href="#" class="notifications-message--dismiss">&times;</a></div>
  <div class="notifications-message notifications-message__negative"><p class="fixie"></p><a href="#" class="notifications-message--dismiss">&times;</a></div>
</section>

<section>
  <h1 class="h2">Grid System</h1>
  <div class="gw">
    <div class="col one-half">
      <div class="cell colour--blue">
        <h1 class="h2 h2--ruled fixie">Column Half</h1>
      </div>
    </div><!-- 
 --><div class="col one-half">
      <div class="cell colour--yellow">
        <h1 class="h2 h2--ruled fixie">Column Half</h1>
      </div>
    </div>
    <!-- Row -->
    <div class="col one-third">
      <div class="cell colour--red">
        <h1 class="h2 h2--ruled">Column Third</h1>
      </div>
    </div><!-- 
 --><div class="col one-third">
      <div class="cell colour--green">
        <h1 class="h2 h2--ruled">Column Third</h1>
      </div>
    </div><!-- 
 --><div class="col one-third">
      <div class="cell colour--blue">
        <h1 class="h2 h2--ruled">Column Third</h1>
      </div>
    </div>

    <!-- Row -->
    <div class="col one-quarter">
      <div class="cell colour--yellow">
        <h1 class="h2 h2--ruled">Column Quarter</h1>
      </div>
    </div><!--
    --><div class="col one-quarter">
      <div class="cell colour--green">
        <h1 class="h2 h2--ruled">Column Quarter</h1>
      </div>
    </div><!--
    --><div class="col one-quarter">
      <div class="cell colour--blue">
        <h1 class="h2 h2--ruled">Column Quarter</h1>
      </div>
    </div><!--
    --><div class="col one-quarter">
      <div class="cell colour--red">
        <h1 class="h2 h2--ruled">Column Quarter</h1>
      </div>
    </div>

    <!-- Row -->
    <div class="col one-sixth">
      <div class="cell colour--blue">
        <h1 class="h2 h2--ruled">Column Sixth</h1>
      </div>
    </div><!-- 
 --><div class="col one-sixth">
      <div class="cell colour--red">
        <h1 class="h2 h2--ruled">Column Sixth</h1>
      </div>
    </div><!-- 
 --><div class="col one-sixth">
      <div class="cell colour--yellow">
        <h1 class="h2 h2--ruled">Column Sixth</h1>
      </div>
    </div><!-- 
 --><div class="col one-sixth">
      <div class="cell colour--blue">
        <h1 class="h2 h2--ruled">Column Sixth</h1>
      </div>
    </div><!-- 
 --><div class="col one-sixth">
      <div class="cell colour--red">
        <h1 class="h2 h2--ruled">Column Sixth</h1>
      </div>
    </div><!-- 
 --><div class="col one-sixth">
      <div class="cell colour--yellow">
        <h1 class="h2 h2--ruled">Column Sixth</h1>
      </div>
    </div>
  </div><!-- .gw -->
</section>

<section>
  <h1 class="h2">Layout Snippets</h1>
  <div class="gw">
    <article class="type-page page h-center">
      <header class="header">
        <h1 class="h1 site--title">Page Layout</h1>
      </header>
      <div class="page--main">
        <div class="cell colour--white">
          <p>Used on the Profile's and static page templates.</p>
        </div>
      </div>
    </article><!-- .type-page.page.h-center -->
  </div><!-- .gw -->

  <div class="gw">
    <article class="type-page page h-center">
      <header class="header">
        <h1 class="h1 site--title">Profile Layout</h1>
      </header>
      <div class="profile--wrap">
        <div class="page--main">
          <div class="cell colour--white">
            <h2 class="h2 h2--ruled">Ruled Heading</h2>
            <p class="fixie"></p>
          </div>
        </div><!-- .page--main -->
        
        <img src="http://placekitten.com/1024/540" class="profile--headshot"/>

      </div><!-- .profile--wrap -->
    </article><!-- .type-page.page.h-center -->
  </div><!-- .gw -->
</section>

</div>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/javascript/libs/fixie/fixie.js"></script>
<script>
  
  (function() {
    var input = document.getElementById('statuses'),
        classes = ['s__focus', 's__checking', 's__error', 's__focus', 's__checking', 's__ok' ],
        i = 0;

    setInterval(function() {
      
      if (classes[i]) input.className = classes[i]
      
      if (i >= classes.length) {
        i = 0
      } else {
        i++;
      }

    }, 2000);

  })();  

</script>
<?php get_footer();