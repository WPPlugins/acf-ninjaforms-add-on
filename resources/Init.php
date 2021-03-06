<?php

namespace ACFNinjaformsField;

class Init
{
    public function __construct()
    {
        $this->addHooks();
        $this->addNotices();
    }

    /**
     * Make sure all hooks are being executed.
     */
    private function addHooks()
    {
        add_action('acf/include_field_types', [$this, 'addField']);
        add_action('acf/register_fields', [$this, 'addFieldforV4']);
        add_action('admin_init', [$this, 'loadTextDomain']);
    }

    /**
     * Initialize the notices
     */
    private function addNotices()
    {
        $notices = new Notices();
        $notices->addHooks();
    }

    /**
     * Add a new Field object for our newest version in Advanced Custom Fields
     */
    public function addField()
    {
        new Field();
    }

    /**
     * Add a new Field object for other versions (V4 in this case) of Advanced Custom Fields
     *
     */
    public function addFieldforV4()
    {
        new FieldForV4();
    }

    /**
     * Load the gettext plugin textdomain located in our language directory.
     */
    public function loadTextDomain()
    {
        load_plugin_textdomain(ACF_NF_FIELD_TEXTDOMAIN, false, ACF_NF_FIELD_LANGUAGES);
    }
}
