# CMB2 Image Select Field Type.

Enables a custom `image_select` field type for CMB2.

It acts pretty much the same as a radio input, prettier though, by adding Visual Interest using images instead.

<b>What you're getting:</b>
An alternate version of **[CMB2-Image_Select-Field-Type](https://github.com/improy/CMB2-Image_Select-Field-Type)** by [improy](https://github.com/improy). It was re-built as a WordPress plugin so you can easily install it & keep it updated.


## Installation & Updates

In order to get automatic plugin updates, please follow the WordPress [Manual Plugin Installation](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation) guide. 

This means you'd simply need to download the plugin from Github as a .zip file and install it the WordPress way.


## Usage

- Requires [CMB2](https://github.com/CMB2/CMB2) to be installed as a standalone plugin or integrated in a theme or plugin.

`image_select` as a field type.

```php
array(	
    'name' => __('Image Select', 'cmb2'),
    'desc' => __('page layout using image_select', 'cmb2'),
    'id'      => $prefix . 'page_custom_layout',
    'type' => 'image_select',
    'options' => array(
        'disabled' => array('title' => 'Full Width', 'alt' => 'Full Width', 'img' => $image_path . 'img/sidebar-disabled.gif'),
        'sidebar-left' => array('title' => 'Sidebar Left', 'alt' => 'Sidebar Left', 'img' => $image_path . 'img/sidebar-left.gif'),
        'sidebar-right' => array('title' => 'Sidebar Right', 'alt' => 'Sidebar Right', 'img' => $image_path . 'img/sidebar-right.gif'),
        'sidebar-leftright' => array('title' => 'Both Sidebars', 'alt' => 'Both Sidebars', 'img' => $image_path . 'img/sidebar-both.gif'),
    ),
    'default' => 'disabled',    
)
```

## Integrations
Ready to be integrated within any Theme or Plugin.
Install it as an ordinary WordPress plugin or include it within your theme's or plugin's code by requiring it as follows.

```
    // Check for the plugin's class
    if(!( class_exists( 'PR_CMB2_Image_Select_Field' ) ) ) {
        require_once( $plugin_or_theme_path . 'cmb2-image-select-field-type.php' );
    }
}
```

By choosing this method, it requires you to manually keep the plugin files up to date as you'd no longer get automatic updates. 

## Screenshots
<img src="https://raw.githubusercontent.com/monecchi/cmb2-image-select-field-type/master/assets/banner-1544x500.png" alt="CMB2 Image_Select Field Type" style="width:100%; height:auto;"/>

### Tutorial on how to integrate image_select field on a WordPress theme

_Original Method_ - No need to follow it up if you're using it as a standalone plugin.
http://www.proy.info/how-to-create-cmb2-image-select-field-type/
