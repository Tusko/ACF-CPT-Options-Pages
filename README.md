# ACF CPT Options Pages

Small addon for ACF Options. Adds ACF location for each custom post type archive

## Installation

+ Upload 'acf-cpt-options-pages' to the `/wp-content/plugins/` directory.
+ Activate the plugin through the`Plugins` menu in WordPress.
+ Create your Custom Field Group, set location rule `Options Page` and choose your `Custom Post Type`
+ Read the documentation to display your data.

![Preview](http://devpreview.xyz/cpt-acf-options.png)

## Usage

The default functions of [ACF plugin](http://www.advancedcustomfields.com/ "Advanced Custom Fields") (`get_field, the_field, etc.`) can be used to load values from a CPT Options Pages, but second parameter is required to target the CPT options.

This is similar to passing through a `$post_id` parameter to target a specific post object.

The $post_id parameter needed is a string containing the `cpt_` and CPT name in the following format; `"cpt_{CPT_NAME}"`

## Examples

>In examples `projects` is a Custom Post Type name.

So, let's go!

#### Display a field
```php
<p><?php the_field('field_name', 'cpt_projects'); ?></p>
```

#### Retrieve a field
```php
<?php
    $field = get_field('field_name', 'cpt_projects');
    // do something with $field
?>
```
#### Display a sub field
```php
<?php if( have_rows('repeater_name', 'cpt_projects') ): ?>
    <ul>
        <?php while( have_rows('repeater_name', 'cpt_projects') ): the_row(); ?>
            <li><?php the_sub_field('the_title'); ?></li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>
```
#### Display with shortcode

```
[acf field="field_name" post_id="cpt_cpt"]
```

> Please read documentation about [shortcodes with ACF](http://www.advancedcustomfields.com/resources/shortcode/ "ACF Shortcode")

## License

Copyright (c) 2016, [Tusko Trush](https://frontend.im/?github "Front-End Developer")

> See LICENSE for more info.

## Requirements

You must buy ACF PRO or ACF Options Page Addon.

---------------
If you have any questions on this please post an issue/question: https://github.com/Tusko/ACF-CPT-Options-Pages/issues
