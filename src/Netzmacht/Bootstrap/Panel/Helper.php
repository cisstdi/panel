<?php

/**
 * @package    contao-bootstrap
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2014-2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Bootstrap\Panel;

use Netzmacht\Bootstrap\Core\Bootstrap;

/**
 * Class Helper provides helper functionality for panels.
 *
 * @package Netzmacht\Bootstrap\Panel\Panel
 */
class Helper
{
    /**
     * Get current accordion group.
     *
     * @return string
     */
    public static function getGroup()
    {
        return Bootstrap::getConfigVar('runtime.accordion-group');
    }

    /**
     * Prepare the panel.
     *
     * @param \Template $template Panel template.
     *
     * @return string
     */
    public static function preparePanel(\Template $template)
    {
        self::setAccordionState($template);
        self::setPanelClass($template);

        return static::getGroup();
    }

    /**
     * Set the accordion state.
     *
     * @param \Template $template Panel template.
     *
     * @return void
     */
    public static function setAccordionState(\Template $template)
    {
        $group = static::getGroup();

        if ($template->accordion !== 'accordion') {
            return;
        }

        if ($group) {
            if (Bootstrap::getConfigVar('runtime.accordion-group-first')) {
                $template->accordion = 'collapse';
                Bootstrap::setConfigVar('runtime.accordion-group-first', false);
            } else {
                $template->accordion = ($template->accordion == 'accordion' ? 'collapse' : $template->accordion);
            }
        } else {
            $template->accordion = ($template->accordion == 'accordion' ? 'collapse' : $template->accordion);
        }
    }

    /**
     * Set panel class if no class is set.
     *
     * @param \Template $template Panel template.
     *
     * @return void
     */
    public static function setPanelClass(\Template $template)
    {
        if (strpos($template->class, 'panel-') === false) {
            $template->class = 'panel-default';
        }
    }
}
