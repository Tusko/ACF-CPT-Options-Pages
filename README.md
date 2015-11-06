# ACF CPT Options Pages
Small addon for ACF Options.

Adds ACF options page per custom post type

## Installation
+ Upload the **cpt-acf.php** file to the `/wp-content/plugins/` directory

+ Activate the plugin through the **Plugins** menu in WordPress

+ Find options page for each custom post type, it will be as sumenu, named as **CPT Name ACF**

## Usage

The default functions of [ACF plugin](http://www.advancedcustomfields.com/ "Advanced Custom Fields") (`get_field, the_field, etc.`) can be used to load values from a CPT Options Pages, but second parameter is required to target the CPT options.

This is similar to passing through a `$post_id` parameter to target a specific post object.

The $post_id parameter needed is a string containing the `cpt_` and CPT name in the following format; `"cpt_{CPT_NAME}"`

## Examples
>In examples `projects` is a Custom Post Type name.

So, let's go!

#### Display a field

    <p><?php the_field('field_name', 'cpt_projects'); ?></p>

#### Retrieve a field

    <?php
          $field = get_field('field_name', 'cpt_projects');
          // do something with $field
    ?>

#### Display a sub field

    <?php if( have_rows('repeater_name', 'cpt_projects') ): ?>
	    <ul>
	        <?php while( have_rows('repeater_name', 'cpt_projects') ): the_row(); ?>
		        <li><?php the_sub_field('the_title'); ?></li>
	        <?php endwhile; ?>
	    </ul>
    <?php endif; ?>

## License

Copyright (c) 2015, Tusko Trush

> See LICENSE for more info.

---------------
If you have any questions on this please post an issue/question: https://github.com/Tusko/ACF-CPT-Options-Pages/issues