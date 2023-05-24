<?php

class ImaticMediawikiPlugin extends MantisPlugin
{
    public function register(): void
    {
        $this->name = 'Imatic Mediawiki';
        $this->description = 'Mediawiki button menu left';
        $this->page = 'config_page';
        $this->version = '0.0.1';
        $this->requires = [
            'MantisCore' => '2.0.0',
        ];

        $this->author = 'Imatic Software s.r.o.';
        $this->contact = 'info@imatic.cz';
        $this->url = 'https://www.imatic.cz/';
    }

    public function config(): array
    {
        return [
            'menu_icon' => 'menu-icon fa fa-wikipedia-w',
            'icon_view_threshold' => EXTERN,
            'id_projects_for_default_url' => array(),
            'mediawiki_default_url' => 'https://dev.imatic.cz/imatic-it-docs/wiki/Dashboard',
            'domain' => 'https://dev.imatic.cz/',
            'last_url_segment' => '/wiki/',
        ];
    }

    public function hooks(): array
    {
        return [
            'EVENT_MENU_MAIN' => 'menu_main_hook',
        ];
    }

    public function menu_main_hook(): array
    {
        return [
            [
                'title' => plugin_lang_get('main_menu_title'),
                'url' => $this->createMediawikiUrl(),
                'access_level' => plugin_config_get('icon_view_threshold'),
                'icon' => plugin_config_get('menu_icon'),
            ]
        ];
    }

    public function createMediawikiUrl(): string
    {

        if (!empty($_GET['imaticProject'])) {
            $projectId = gpc_get_int('imaticProject');
        } else {
            $projectId = helper_get_current_project();
        }

        $projectName = strtolower(project_get_name($projectId));
        $projectsForDefaultUrl = (array)plugin_config_get('id_projects_for_default_url');

        $url = plugin_config_get('domain'). $projectName. plugin_config_get('last_url_segment');

        if (in_array($projectId, $projectsForDefaultUrl)) {;
            $url = plugin_config_get('mediawiki_default_url');

        }
        return $url;

    }

}
