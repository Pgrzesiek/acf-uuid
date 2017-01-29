# Advanced Custom Fields: UUID Field

This is a simple field wrapper for the fantastic UUID library ramsey/uuid, found here: https://github.com/ramsey/uuid
to be used within Advanced Custom Fields PRO (https://advancedcustomfields.com).

UUID Field is useful when placed inside a `Repeater` field. The default behavior of the `Repeater`
field in ACF is to reassign id's to repeater items when you reorder them. This is not always
desirable. By using this field within a repeater, will always keep the same id even if you shuffle
around the items.

### Compatibility

This ACF field type is compatible with:
* ACF5

### Installation

1. Copy the `wp-acf-uuid` folder into your `wp-content/plugins` folder
2. Activate the Advanced Custom Fields: UUID Field plugin via the plugins admin page
3. Create a new field via ACF and select the UUID type
4. Select the version of UUID you would like to use
