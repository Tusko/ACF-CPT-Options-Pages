=== Plugin Name ===

Contributors: tusko-trush
Donate link: https://send.monobank.com.ua/QMnpw2tn
Tags: Advanced Custom Fields, ACF Options, Custom Post Type, Archive
Requires at least: 3.0
Tested up to: 4.9.6
Stable tag: 2.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Small addon for ACF Options. Adds ACF location for each custom post type.

**New feature** in the major version 2!<br>
<span style="color:red">Important!</span><br>
**After update to v2+ you must reconnect Field Groups to Options Pages**


Now you can activate/deactivate CPTs and create custom options pages for each CPT.
By default, options pages are activated for all custom post types.


== Description ==

Small addon for ACF Options. Adds ACF location for each custom post type.

**New feature** in the major version 2!<br>
<span style="color:red">Important!</span><br>
**After update to v2+ you must reconnect Field Groups to Options Pages**


Now you can activate/deactivate CPTs and create custom options pages for each CPT.
By default, options pages are activated for all custom post types.

= Usage =

The default functions of [ACF plugin](http://www.advancedcustomfields.com/ "Advanced Custom Fields") (`get_field, the_field, etc.`) can be used to load values from a CPT Options Pages, but second parameter is required to target the CPT options.

This is similar to passing through a `$post_id` parameter to target a specific post object.

The `$post_id` parameter needed is a string containing the `cpt_` and CPT name in the following format; `"cpt_{CPT_NAME}"` and for subpages you can copy generated ID while creating subpages.


= Examples =

>In examples Custom Post Type name is `projects`.

So, let's go!

**Display a field**

    <p><?php the_field('field_name', 'cpt_projects'); ?></p>

and the subpage's field

    <p><?php the_field('field_name', 'cpt_projects_testpage'); ?></p>

**Retrieve a field**

    <?php
        $field = get_field('field_name', 'cpt_projects');
        // do something with $field
    ?>

**Display a sub field**

`
    <?php if( have_rows('repeater_name', 'cpt_projects') ): ?>
        <ul>
            <?php while( have_rows('repeater_name', 'cpt_projects') ): the_row(); ?>
                <li><?php the_sub_field('the_title'); ?></li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
`

**Display with shortcode**

    [acf field="field_name" post_id="cpt_projects"]

> Please read documentation about [shortcodes with ACF](http://www.advancedcustomfields.com/resources/shortcode/ "ACF Shortcode")


## Customization

`
    function cpt_projects_customize($cptmenu) {
        $cptmenu['page_title'] = 'Dev Custom title';
        $cptmenu['menu_title'] = 'Dev Custom title';
        return $cptmenu;
    }

    add_filter('cpt_projects_acf_page_args', 'cpt_projects_customize');
`

Don't forget to replace `cpt_projects_` to your custom post type name :)
It works only for first level options pages, not for subpages.


= License =

Copyright (c) 2018, [Tusko Trush](https://frontend.im/?github "Front-End Developer")

= Requirements =

You must buy ACF PRO or ACF Options Page Addon.

= Translation =

**qTanslate-X**

If you are using Qtranslate-X, you must install [ACF Qtranslate](https://uk.wordpress.org/plugins/acf-qtranslate/ "ACF Qtranslate").

**WPML/Polylang**

If you are using WPML or Polylang, you must add constant `ICL_LANGUAGE_CODE` to `post_id`,
for example: `get_field('archive_title', 'cpt_projects_' . ICL_LANGUAGE_CODE)`.


== Installation ==

1. Upload 'acf-cpt-options-pages' to the `/wp-content/plugins/` directory.
2. Activate the plugin through the`Plugins` menu in WordPress.
3. Go to `Custom fields` submenu `CPT Options page` and activate CPTs what you need or create subpages for that.
4. Create your Custom Field Group, set location rule `Options Page` and choose your CPT options page or subpage.
5. Read the documentation to display your data.

== Frequently Asked Questions ==

If you have any questions on this please post an issue/question at [Github Issues](https://github.com/Tusko/ACF-CPT-Options-Pages/issues)

== Screenshots ==

1. assets/screenshot-1.png

== Changelog ==

= 2.0.2 =
* Fixed WPML slugs

= 2.0.0 =
* Added Russian, Ukrainian translations.
* Added setting page to ACF CPT Options Pages
* Added UI to manage options pages per CPT
* Ability to add child pages to CPTs

= 1.1.0 =
* Support MO translations
* Customization using `add_filter`

= 1.1.0 =
* WPML and Polylang compatibility added.

= 1.0.2 =
* Update documentation.
* Change labels and slugs.

= 1.0.1 =
* Plugin created.

== Upgrade Notice ==

= 1.0.2 =
* Update documentation.
* Change labels and slugs.