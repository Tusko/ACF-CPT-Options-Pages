<?php

$cpts = ACFCPT_OptionsPages::get_custom_post_types();
$cpts_enabled = ACFCPT_OptionsPages::get_registered_cpts();

if (isset($_POST['cpts'])) {
	update_option( 'acf-cpt-archives', maybe_serialize( $_POST['cpts'] ) );
	$cpts_enabled = $_POST['cpts'];
}

global $title; ?>
<div class="wrap">
    <style>
        .sub-line * {
            vertical-align: middle;
            display: inline-block
        }
        .sub-line input + span {
            margin-left: 20px
        }
    </style>
    <div id="icon-themes" class="icon32"></div>
    <h2><?php echo $title; ?></h2>

    <form method="post" action="" class="acf-cpt-register" data-subpage="<?php echo __('Subpage Name', CPT_ACF_DOMAIN); ?>">
        <h3><?php echo __( 'Choose post types to enable options page', CPT_ACF_DOMAIN ); ?></h3>
        <?php if($cpts) {
            foreach ( $cpts as $cpt ) {
                if ( post_type_exists( $cpt ) ) {
                    $checked = 'checked';
                    if(!isset($cpts_enabled[$cpt])) {
                        $checked = '';
                    } ?>
                    <hr />
                    <div class="cpt-row">
                        <h4>
                            <label>
                                <input type="checkbox" name="cpts[<?php echo $cpt; ?>]" value="<?php echo $cpt; ?>"
                                     <?php echo $cpts_enabled?$checked:'checked'; ?>
                                />
                                <span>
                                    <?php echo __(get_post_type_object( $cpt )->labels->name); ?>
                                </span>
                            </label>
                            <?php if(!$cpts_enabled) {
                                echo '<span class="dashicons dashicons-plus-alt"></span>';
                            } else {
                                if($checked) echo '<span class="dashicons dashicons-plus-alt"></span>';
                            } ?>
                        </h4>
                        <?php
                        if(isset($cpts_enabled[$cpt]) && is_array($cpts_enabled[$cpt])) {
                            foreach ($cpts_enabled[$cpt] as $sub) {
                                echo '<p class="sub-line"><span>' . __('Subpage Name', CPT_ACF_DOMAIN) . '</span>
                                      <input type="text" name="cpts['.$cpt.'][]" value="' . $sub . '">
                                      <span>'. __('Page ID', CPT_ACF_DOMAIN) .'</span>
                                      <input class="regular-text" type="text" readonly value="cpt_' . $cpt . '_' . strtolower(preg_replace('/[^a-zA-Z0-9_]/', '_', $sub)) . '">
                                      <span class="dashicons dashicons-trash"></span></p>';
                            }
                        } ?>
                    </div>
                <?php }
            }
        } else {
            echo __( 'No Custom Post Types found.', CPT_ACF_DOMAIN );
        } ?>

        <input type="hidden" name="cpts[0]" value="0" />

        <?php submit_button(); ?>

    </form>

</div><!-- /.wrap -->