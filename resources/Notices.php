<?php

namespace ACFNinjaformsField;

use Ninja_Forms;

class Notices
{
    /**
     * Get our forms
     *
     * @var array
     */
    public $forms;

    public function __construct()
    {
        if (class_exists('GFAPI')) {
            $this->forms = Ninja_Forms()->form()->get_forms();
        }
    }

    /**
     * Make sure all hooks are being executed.
     */
    public function addHooks()
    {
        add_action('admin_notices', [$this, 'isNinjaFormsActive']);
        add_action('admin_notices', [$this, 'isAdvancedCustomFieldsActive']);
    }

    /**
     * Check if ninjaforms is active. If not, issue a notice
     */
    public function isNinjaFormsActive($inline = '', $alt = '')
    {
        if (!class_exists('Ninja_Forms')) {
            $notice = sprintf(__('Warning: You need to <a href="%s">Activate Ninjaforms</a> in order to use the Advanced Custom Fields: Ninjaforms Add-on.',
                ACF_NF_FIELD_TEXTDOMAIN), admin_url('plugins.php'));

            $this->createNotice($notice, $inline, $alt);
        }
    }

    public function hasActiveNinjaForms($inline = '', $alt = '')
    {
        if (!$this->forms) {
            $notice = sprintf(__(' Warning: There are no active forms. You need to <a href="%s">Create a New Form</a> in order to use the Advanced Custom Fields: Ninjaforms Add-on.',
                ACF_NF_FIELD_TEXTDOMAIN), admin_url('admin.php?page=gf_new_form'));

            $this->createNotice($notice, $inline, $alt);
        }
    }

    /**
     * Check if ninjaforms is active. If not, issue a notice
     */
    public function isAdvancedCustomFieldsActive($inline = '', $alt = '')
    {
        if (!function_exists('get_field')) {
            $notice = sprintf(__('Warning: You need to <a href="%s">Activate Advanced Custom Fields</a> in order to use the Advanced Custom Fields: Ninjaforms Add-on.',
                ACF_NF_FIELD_TEXTDOMAIN), admin_url('plugins.php'));

            $this->createNotice($notice, $inline, $alt);
        }
    }

    /**
     * A wrapper for all the notices.
     */
    public function createNotice($notice, $inline = '', $alt = '')
    {
        $inline = $inline ? ' inline' : '';
        $alt = $alt ? ' notice-alt' : '';

        echo '<div class="notice notice-warning ' . $inline . $alt . '"><p>' . $notice . '</p></div>';
    }
}
