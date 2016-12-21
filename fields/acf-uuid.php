<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_field_uuid') ) :



class acf_field_uuid extends acf_field {


    /*
    *  __construct
    *
    *  This function will setup the field type data
    *
    *  @type    function
    *  @date    5/03/2014
    *  @since   5.0.0
    *
    *  @param   n/a
    *  @return  n/a
    */

    function __construct( $settings ) {

        /*
        *  name (string) Single word, no spaces. Underscores allowed
        */

        $this->name = 'uuid';


        /*
        *  label (string) Multiple words, can include spaces, visible when selecting a field type
        */

        $this->label = __('UUID', 'acf-uuid');


        /*
        *  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
        */

        $this->category = 'basic';


        /*
        *  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
        */

        $this->defaults = array();


        /*
        *  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
        *  var message = acf._e('uuid', 'error');
        */

        $this->l10n = array();


        /*
        *  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
        */

        $this->settings = $settings;


        // do not delete!
        parent::__construct();

    }


    /*
    *  render_field_settings()
    *
    *  Create extra settings for your field. These are visible when editing a field
    *
    *  @type    action
    *  @since   3.6
    *  @date    23/01/13
    *
    *  @param   $field (array) the $field being edited
    *  @return  n/a
    */

    function render_field_settings( $field ) {

        /*
        *  acf_render_field_setting
        *
        *  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
        *  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
        *
        *  More than one setting can be added by copy/paste the above code.
        *  Please note that you must also have a matching $defaults value for the field name (font_size)
        */

        acf_render_field_setting( $field, array(
            'label'         => __('UUID Version', 'acf-uuid'),
            'instructions'  => __('Choose UUID version', 'acf-uuid'),
            'type'          => 'select',
            'name'          => 'version',
            'choices'       => array(
                'v4' => 'v4',
                'v1' => 'v1',
            ),
        ));

    }

    protected function generate_value( $version ) {
        switch($version) {
            case 'v1':
                return Uuid::uuid1()->toString();
            case 'v4':
                return Uuid::uuid4()->toString();
            default:
                return '';
        }
    }

    function render_field( $field ) {

        $value = $field['value'];

        if(empty($field['value'])) {
            $value = $this->generate_value($field['version']);
        }

        ?>
        <input readonly="readonly" type="text" name="<?php echo esc_attr($field['name']) ?>" value="<?php echo esc_attr($value) ?>" />
        <?php
    }

    function update_value( $value, $post_id, $field ) {
        if(empty($field['value'])) {
            $value = $this->generate_value($field['version']);
        }
        return $value;
    }

}


// initialize
new acf_field_uuid( $this->settings );


// class_exists check
endif;

?>