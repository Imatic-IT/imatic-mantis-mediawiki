# Imatic Mediawiki Plugin

The Imatic Mediawiki Plugin is a Mantis plugin that adds a side menu button to the left side of the interface. The button provides a link to a specific MediaWiki page based on the current project. It also allows configuring a default URL for certain projects.

## Installation and Requirements

To use this plugin, you need to have MantisCore version 2.0.0 or later installed.

1. Download the Imatic Mediawiki Plugin files.
2. Place the plugin files in the Mantis plugins directory.
3. Enable the plugin in the Mantis configuration.

## Configuration

The plugin provides the following configuration options:

- `menu_icon`: The icon class for the menu button (e.g., `'menu-icon fa fa-wikipedia-w'`).
- `icon_view_threshold`: The access level required to view the menu button (e.g., `EXTERN`).
- `id_projects_for_default_url`: An array of project IDs that should have a default URL.
- `mediawiki_default_url`: The default URL for projects specified in `id_projects_for_default_url`.
- `domain`: The domain of the MediaWiki installation.
- `last_url_segment`: The last segment of the URL before the page name (e.g., `'/wiki/'`).

```PHP
    public function config(): array
    {
        return [
            'menu_icon' => 'menu-icon fa fa-wikipedia-w',
            'icon_view_threshold' => EXTERN,
            'id_projects_for_default_url' => array(0, 3),
            'mediawiki_default_url' => 'https://dev.xxx.com/xxx/wiki/Dashboard',
            'domain' => 'https://dev.xxx.com/',
            'last_url_segment' => '/wiki/',

        ];
    }
   ``` 

## Usage

After installing and configuring the plugin, a side menu button will appear on the left side of the Mantis interface. The button's title will be determined by the language file (e.g., `plugin_lang_get('main_menu_title')`). Clicking on the button will redirect the user to the corresponding MediaWiki page based on the current project.

If the `imaticProject` parameter is present in the URL, the plugin will use the specified project ID to determine the MediaWiki URL. Otherwise, it will use the current project ID obtained from the Mantis helper functions.

If the current project ID is included in the `id_projects_for_default_url` array, the plugin will use the `mediawiki_default_url` as the URL. This allows certain projects to have a predefined default page.

## Author and Contact

The Imatic Mediawiki Plugin is developed by Imatic Software s.r.o. You can contact them at info@imatic.cz. For more information, visit their website at [https://www.imatic.cz/](https://www.imatic.cz/).
