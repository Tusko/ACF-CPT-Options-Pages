# ACF CPT Options Pages

Small addon for ACF Options. Adds ACF location for each custom post type.

**New feature** in the major version 2!

Now you can activate/deactivate CPTs and create custom options pages for each CPT.
By default, options pages are activated for all custom post types.

## Installation

+ Upload 'acf-cpt-options-pages' to the `/wp-content/plugins/` directory.
+ Activate the plugin through the`Plugins` menu in WordPress.
+ Go to `Custom fields` submenu `CPT Options page` and activate CPTs what you need or create subpages for that.
+ Create your Custom Field Group, set location rule `Options Page` and choose your CPT options page or subpage.
+ Read the documentation to display your data.

![Preview](http://arsmoon.stream/cpt-acf-options.png)

## Usage

The default functions of [ACF plugin](http://www.advancedcustomfields.com/ "Advanced Custom Fields") (`get_field, the_field, etc.`) can be used to load values from a CPT Options Pages, but second parameter is required to target the CPT options.

This is similar to passing through a `$post_id` parameter to target a specific post object.

The `$post_id` parameter needed is a string containing the `cpt_` and CPT name in the following format; `"cpt_{CPT_NAME}"` and for subpages you can copy generated ID while creating subpages.

## Examples

>In examples `projects` is a Custom Post Type name.

So, let's go!

#### Display a field
```php
<p><?php the_field('field_name', 'cpt_projects'); ?></p>
```

and the subpage field

```php
<p><?php the_field('field_name', 'cpt_projects_testpage'); ?></p>
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
[acf field="field_name" post_id="cpt_projects"]
```

> Please read documentation about [shortcodes with ACF](http://www.advancedcustomfields.com/resources/shortcode/ "ACF Shortcode")

## Customization

Add in your `functions.php`

```
function cpt_projects_customize($cptmenu) {
    $cptmenu['page_title'] = 'Dev Custom title';
    $cptmenu['menu_title'] = 'Dev Custom title';
    return $cptmenu;
}

add_filter('cpt_projects_acf_page_args', 'cpt_projects_customize');
```

Don't forget to replace `cpt_projects_` to your custom post type name :)
It works only for first level options pages, not for subpages.

## License

Copyright (c) 2018, [Tusko Trush](https://frontend.im/?github "Front-End Developer")

> See LICENSE for more info.

## Requirements

You must buy ACF PRO or ACF Options Page Addon.


## Translation

**qTanslate-X**

> If you are using Qtranslate-X, you must install [ACF Qtranslate](https://uk.wordpress.org/plugins/acf-qtranslate/ "ACF Qtranslate").

**WPML/Polylang**

> If you are using WPML or Polylang, you must add constant `ICL_LANGUAGE_CODE` to `post_id`,
for example: `get_field('archive_title', 'cpt_projects_' . ICL_LANGUAGE_CODE)`.

## Contributors

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
 [<img src="https://avatars.githubusercontent.com/u/2039259" width="100px;"/><br /><sub>Tusko Trush</sub>](https://github.com/tusko?github)<br /> Chief :D | [<img src="https://avatars.githubusercontent.com/u/1512067" width="100px;"/><br /><sub>Máté Farkas</sub>](https://github.com/wolfika)<br /> i18n Support | [<img src="https://avatars.githubusercontent.com/u/5536354" width="100px;"/><br /><sub>Sauli Rajala</sub>](https://github.com/saulirajala)<br /> Customizations
--- | --- | ---
<!-- ALL-CONTRIBUTORS-LIST:END -->

---------------
If you have any questions on this please post an issue/question: https://github.com/Tusko/ACF-CPT-Options-Pages/issues