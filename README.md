# uptheme instagram widget
A simple Instagram feed widget plugin for wordpress powered under the hood by Swiper, Vue.js and axios.
This widget will display the last twelwe uploaded media from a public instagram profile.

**Usage**

- Download or clone this repository.
- Install the plugin, then select a widget position where you want to display it. By default the plugin will create a new widget position named ig-feed. If you are confortable with wordpress theme edit, you can add the following code snippet where you want to display the widget:

```
<?php if( is_active_sidebar('ig-feed') ): ?>
<?php dynamyc_sidebar('ig-feed'); ?>
<?php endif; ?>
```

- Activate the plugin and insert the username of the profile you want to display without the initial @ char.

Enjoy!
