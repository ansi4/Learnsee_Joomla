<?php
defined('_JEXEC') or die('Restricted access');
/**
 * @package             Joomla
 * @subpackage          CoalaWeb Social Links
 * @author              Steven Palmer
 * @author url          http://coalaweb.com
 * @author email        support@coalaweb.com
 * @license             GNU/GPL, see /assets/en-GB.license.txt
 * @copyright           Copyright (c) 2014 Steven Palmer All rights reserved.
 *
 * CoalaWeb Social Links is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class Com_CoalawebsociallinksInstallerScript {

    /** @var string The component's name */
    protected $_coalaweb_extension = 'com_coalawebsociallinks';

    /** @var array The list of extra modules and plugins to install */
    private $installation_queue = array(
        'modules' => array(
            'admin' => array(
            ),
            'site' => array(
                'coalawebsociallinks' => array('left', 0),
                'coalaweblikebox' => array('left', 0),
            )
        ),
        'plugins' => array(
            'content' => array(
            ),
            'system' => array(
                'cwgears' => 1,
            ),
        )
    );

    /** @var array The list of extra modules and plugins to uninstall */
    private $uninstallation_queue = array(
        // modules => { (folder) => { (module) => { (position), (published) } }* }*
        'modules' => array(
            'admin' => array(
            ),
            'site' => array(
                'coalawebsociallinks' => array('left', 0),
                'coalaweblikebox' => array('left', 0),
            )
        ),
        // plugins => { (folder) => { (element) => (published) }* }*
        'plugins' => array(
            'content' => array(
            ),
            'system' => array(
            )
        )
    );

    /** @var array The list of pro or obsolete plugins to remove */
    private $cwRemoveProObsoletePlugins = array(
        'plugins' => array(
            'content' => array(
                'cwsociallikes',
                'cwsocialpanel',
                'cwopengraph',
            ),
            'system' => array(
                'cwzooelements',
            ),
            'quickicon' => array(
                'cwslquickicon',
            ),
            'installer' => array(
                'cwslupdate',
            )
        )
    );

    /** @var array The list of pro or obsolete modules to remove */
    private $cwRemoveProObsoleteModules = array(
        'modules' => array(
            'admin' => array(
                'cwquickicons',
            ),
            'site' => array(
                'coalawebgplus',
                'coalawebsocialtabs',
            )
        )
    );

    /** @var array Obsolete files and folders to remove */
    private $coalawebRemoveFiles = array(
        'files' => array(
            'modules/mod_coalawebsociallinks/tmpl/horizontal.php',
        ),
        'folders' => array(
            'media/com_coalawebsociallinks',
            'media/mod_coalawebsociallinks',
            'media/mod_coalaweblikebox',
            'media/mod_cwquickicons',
            'media/plg_cwopengraph',
            'media/plg_cwslquickicon',
            'media/plg_cwsociallikes',
            'media/plg_cwzooelements',
            'media/coalawebsocial/modules/sociallinks/themes-icon'
        )
    );
    private $coalawebCliScripts = array(
    );

    /**
     * Joomla! pre-flight event
     * 
     * @param string $type Installation type (install, update, discover_install)
     * @param JInstaller $parent Parent object
     */
    public function preflight($type, $parent) {
        // Only allow to install on Joomla! 2.5.0 or later with PHP 5.3.0 or later
        if (defined('PHP_VERSION')) {
            $version = PHP_VERSION;
        } elseif (function_exists('phpversion')) {
            $version = phpversion();
        } else {
            $version = '5.0.0'; // all bets are off!
        }

        if (!version_compare(JVERSION, '2.5.6', 'ge')) {
            $msg = "<p>You need Joomla! 2.5.6 or later to install this component</p>";

            JError::raiseWarning(100, $msg);

            return false;
        }

        if (!version_compare($version, '5.3.1', 'ge')) {
            $msg = "<p>You need PHP 5.3.1 or later to install this component</p>";

            if (version_compare(JVERSION, '3.0', 'gt')) {
                JLog::add($msg, JLog::WARNING, 'jerror');
            } else {
                JError::raiseWarning(100, $msg);
            }

            return false;
        }

        // Bugfix for "Can not build admin menus"
        // Workarounds for JInstaller bugs
        if (in_array($type, array('install'))) {
            $this->_bugfixDBFunctionReturnedNoError();
        } elseif ($type != 'discover_install') {
            $this->_bugfixCantBuildAdminMenus();
        }

        return true;
    }

    /**
     * Runs after install, update or discover_update
     * @param string $type install, update or discover_update
     * @param JInstaller $parent 
     */
    function postflight($type, $parent) {
        // Install subextensions
        $status = $this->_installSubextensions($parent);

        // Remove obsolete files and folders
        $this->_removeObsoleteFilesAndFolders($this->coalawebRemoveFiles);

        $this->_copyCliFiles($parent);

        // Remove Pro or Obsolete extensions
        $this->_removeProObsoletePlugins($parent);
        $this->_removeProObsoleteModules($parent);

        // Show the post-installation page
        $this->_renderPostInstallation($status, $parent);
    }

    /**
     * Runs on uninstallation
     * 
     * @param JInstaller $parent 
     */
    function uninstall($parent) {
        // Uninstall subextensions
        $status = $this->_uninstallSubextensions($parent);

        // Show the post-uninstallation page
        $this->_renderPostUninstallation($status, $parent);
    }

    /**
     * Removes Pro plugins
     *
     * @param JInstaller $parent
     */
    private function _removeProObsoletePlugins($parent) {
        $src = $parent->getParent()->getPath('source');
        $db = JFactory::getDbo();

        if (count($this->cwRemoveProObsoletePlugins['plugins'])) {
            foreach ($this->cwRemoveProObsoletePlugins['plugins'] as $folder => $plugins) {
                foreach ($plugins as $plugin) {
                    $sql = $db->getQuery(true)
                            ->select($db->qn('extension_id'))
                            ->from($db->qn('#__extensions'))
                            ->where($db->qn('type') . ' = ' . $db->q('plugin'))
                            ->where($db->qn('element') . ' = ' . $db->q($plugin))
                            ->where($db->qn('folder') . ' = ' . $db->q($folder));
                    $db->setQuery($sql);
                    $id = $db->loadResult();
                    if ($id) {
                        $installer = new JInstaller;
                        $result = $installer->uninstall('plugin', $id, 1);
                    }
                }
            }
        }
    }

    /**
     * Removes Pro plugins
     *
     * @param JInstaller $parent
     */
    private function _removeProObsoleteModules($parent) {
        $src = $parent->getParent()->getPath('source');
        $db = JFactory::getDbo();

        if (count($this->cwRemoveProObsoleteModules['modules'])) {
            foreach ($this->cwRemoveProObsoleteModules['modules'] as $folder => $modules) {
                foreach ($modules as $module) {
                    // Find the module ID
                    $sql = $db->getQuery(true)
                            ->select($db->qn('extension_id'))
                            ->from($db->qn('#__extensions'))
                            ->where($db->qn('element') . ' = ' . $db->q('mod_' . $module))
                            ->where($db->qn('type') . ' = ' . $db->q('module'));
                    $db->setQuery($sql);
                    $id = $db->loadResult();
                    // Uninstall the module
                    if ($id) {
                        $installer = new JInstaller;
                        $result = $installer->uninstall('module', $id, 1);
                    }
                }
            }
        }
    }

    /**
     * Copies the CLI scripts into Joomla!'s cli directory
     * 
     * @param JInstaller $parent 
     */
    private function _copyCliFiles($parent) {
        if (!count($this->coalawebCliScripts)) {
            return;
        }
        $src = $parent->getParent()->getPath('source');

        jimport("joomla.filesystem.file");
        jimport("joomla.filesystem.folder");

        foreach ($this->coalawebCliScripts as $script) {
            if (JFile::exists(JPATH_ROOT . '/cli/' . $script)) {
                JFile::delete(JPATH_ROOT . '/cli/' . $script);
            }
            if (JFile::exists($src . '/cli/' . $script)) {
                JFile::move($src . '/cli/' . $script, JPATH_ROOT . '/cli/' . $script);
            }
        }
    }

    /**
     * Renders the post-installation message 
     */
    private function _renderPostInstallation($status, $parent) {
        ?>

        <?php $rows = 1; ?>
 <style type="text/css">
            .coalaweb {
                font-family: "Trebuchet MS",Helvetica,sans-serif;
                font-size: 13px !important;
                font-weight: normal !important;
                color: #4D4D4D;
            }

            .coalaweb {
                border: solid #ccc 1px;
                background: #fff;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                *border-collapse: collapse; /* IE7 and lower */
                border-spacing: 0;
                width: 95%;    
                margin: 7px 15px 15px !important;
            }

            .coalaweb tr:hover {
                background: #E8F6FE;
                -o-transition: all 0.1s ease-in-out;
                -webkit-transition: all 0.1s ease-in-out;
                -moz-transition: all 0.1s ease-in-out;
                -ms-transition: all 0.1s ease-in-out;
                transition: all 0.1s ease-in-out;     
            }    

            .coalaweb tr.row1 {
                background-color: #F0F0EE;
            }

            .coalaweb td, .coalaweb th {
                border-left: 1px solid #ccc;
                border-top: 1px solid #ccc;
                padding: 10px !important;
                text-align: left;    
            }

            .coalaweb th {
                background-image: -webkit-gradient(linear, left top, left bottom, from(#fdfdfd), to(#f4f4f4));
                background-image: -webkit-linear-gradient(top, #fdfdfd, #f4f4f4);
                background-image:    -moz-linear-gradient(top, #fdfdfd, #f4f4f4);
                background-image:     -ms-linear-gradient(top, #fdfdfd, #f4f4f4);
                background-image:      -o-linear-gradient(top, #fdfdfd, #f4f4f4);
                background-image:         linear-gradient( #fdfdfd, #f4f4f4);
                border-top: none;
                color: #333 !important;
                text-shadow: 0px 1px 1px #FFF;
                border-bottom:4px solid rgb(18, 114, 165) !important;
            }

            .coalaweb td:first-child, .coalaweb th:first-child {
                border-left: none;
            }

            .coalaweb th:first-child {
                -moz-border-radius: 3px 0 0 0;
                -webkit-border-radius: 3px 0 0 0;
                border-radius: 3px 0 0 0;
            }

            .coalaweb th:last-child {
                -moz-border-radius: 0 3px 0 0;
                -webkit-border-radius: 0 3px 0 0;
                border-radius: 0 3px 0 0;
            }

            .coalaweb th:only-child{
                -moz-border-radius: 6px 6px 0 0;
                -webkit-border-radius: 6px 6px 0 0;
                border-radius: 6px 6px 0 0;
            }

            .coalaweb tr:last-child td:first-child {
                -moz-border-radius: 0 0 0 3px;
                -webkit-border-radius: 0 0 0 3px;
                border-radius: 0 0 0 3px;
            }

            .coalaweb tr:last-child td:last-child {
                -moz-border-radius: 0 0 3px 0;
                -webkit-border-radius: 0 0 3px 0;
                border-radius: 0 0 3px 0;
            }

            .coalaweb em, .coalaweb strong {
                color:#1272A5;
                font-weight: bold;
            }
        </style>
        <link rel="stylesheet" href="../media/coalaweb/components/generic/css/com-coalaweb-base.css" type="text/css">
        <span class="cw-message">
            <p class="alert">
                <?php echo JText::_('COM_CWSOCIALLINKS_POST_INSTALL_MSG'); ?>
            </p>
        </span>
        <table class="coalaweb">
            <thead align="left">
                <tr>
                    <th class="title" align="left">Component</th>
                    <th width="25%">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td class="key">
        <?php echo JText::_('COM_CWSOCIALLINKS_TITLE_CORE'); ?>
                    </td>
                    <td>
                        <strong style="color: green">Installed</strong>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php if (count($status->modules)) : ?>
                    <table class="coalaweb">
                <thead align="left">
                    <tr>
                        <th class="title" align="left">Module</th>
                        <th width="25%">Client</th>
                        <th width="25%">Status</th>
                    </tr>
                                    </thead>
                <tbody>
            <?php foreach ($status->modules as $module) : ?>
                        <tr class="row<?php echo ($rows++ % 2); ?>">
                            <td class="key"><?php echo JText::_($module['name']); ?></td>
                            <td class="key"><?php echo ucfirst($module['client']); ?></td>
                            <td><strong style="color: <?php echo ($module['result']) ? "green" : "red" ?>"><?php echo ($module['result']) ? 'Installed' : 'Not installed'; ?></strong></td>
                        </tr>
            <?php endforeach; ?>
                                        </tbody>
            </table>
                <?php endif; ?>
                <?php if (count($status->plugins)) : ?>
            <table class="coalaweb">
                <thead align="left" >
                    <tr>
                        <th class="title" align="left">Plugins</th>
                        <th width="25%">Group</th>
                        <th width="25%">Status</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($status->plugins as $plugin) : ?>
                        <tr class="row<?php echo ($rows++ % 2); ?>">
                            <td class="key"><?php echo JText::_($plugin['name']); ?></td>
                            <td class="key"><?php echo ucfirst($plugin['group']); ?></td>
                            <td><strong style="color: <?php echo ($plugin['result']) ? "green" : "red" ?>"><?php echo ($plugin['result']) ? 'Installed' : 'Not installed'; ?></strong></td>
                        </tr>
            <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
    }

    private function _renderPostUninstallation($status, $parent) {
        ?>
        <?php $rows = 0; ?>
        <style type="text/css">
            .coalaweb {
                font-family: "Trebuchet MS",Helvetica,sans-serif;
                font-size: 13px !important;
                font-weight: normal !important;
                color: #4D4D4D;
            }

            .coalaweb {
                border: solid #ccc 1px;
                background: #fff;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                *border-collapse: collapse; /* IE7 and lower */
                border-spacing: 0;
                width: 95%;    
                margin: 7px 15px 15px !important;
            }

            .coalaweb tr:hover {
                background: #E8F6FE;
                -o-transition: all 0.1s ease-in-out;
                -webkit-transition: all 0.1s ease-in-out;
                -moz-transition: all 0.1s ease-in-out;
                -ms-transition: all 0.1s ease-in-out;
                transition: all 0.1s ease-in-out;     
            }    

            .coalaweb tr.row1 {
                background-color: #F0F0EE;
            }

            .coalaweb td, .coalaweb th {
                border-left: 1px solid #ccc;
                border-top: 1px solid #ccc;
                padding: 10px !important;
                text-align: left;    
            }

            .coalaweb th {
                background-image: -webkit-gradient(linear, left top, left bottom, from(#fdfdfd), to(#f4f4f4));
                background-image: -webkit-linear-gradient(top, #fdfdfd, #f4f4f4);
                background-image:    -moz-linear-gradient(top, #fdfdfd, #f4f4f4);
                background-image:     -ms-linear-gradient(top, #fdfdfd, #f4f4f4);
                background-image:      -o-linear-gradient(top, #fdfdfd, #f4f4f4);
                background-image:         linear-gradient( #fdfdfd, #f4f4f4);
                border-top: none;
                color: #333 !important;
                text-shadow: 0px 1px 1px #FFF;
                border-bottom:4px solid rgb(18, 114, 165) !important;
            }

            .coalaweb td:first-child, .coalaweb th:first-child {
                border-left: none;
            }

            .coalaweb th:first-child {
                -moz-border-radius: 3px 0 0 0;
                -webkit-border-radius: 3px 0 0 0;
                border-radius: 3px 0 0 0;
            }

            .coalaweb th:last-child {
                -moz-border-radius: 0 3px 0 0;
                -webkit-border-radius: 0 3px 0 0;
                border-radius: 0 3px 0 0;
            }

            .coalaweb th:only-child{
                -moz-border-radius: 6px 6px 0 0;
                -webkit-border-radius: 6px 6px 0 0;
                border-radius: 6px 6px 0 0;
            }

            .coalaweb tr:last-child td:first-child {
                -moz-border-radius: 0 0 0 3px;
                -webkit-border-radius: 0 0 0 3px;
                border-radius: 0 0 0 3px;
            }

            .coalaweb tr:last-child td:last-child {
                -moz-border-radius: 0 0 3px 0;
                -webkit-border-radius: 0 0 3px 0;
                border-radius: 0 0 3px 0;
            }

            .coalaweb em, .coalaweb strong {
                color:#1272A5;
                font-weight: bold;
            }
        </style>
        <span class="cw-slider">
            <h3> CoalaWeb Social Links Uninstallation Status</h3>
        </span>
        <table class="coalaweb">
            <thead align="left">
                <tr>
                    <th class="title" align="left">Component</th>
                    <th width="25%">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="row0">
                    <td class="key">
                        <?php echo JText::_('COM_CWSOCIALLINKS_TITLE_CORE'); ?>
                    </td>
                    <td>
                        <strong style="color: green">Uninstalled</strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php if (count($status->modules)) : ?>
            <table class="coalaweb">
                <thead align="left">
                    <tr>
                        <th class="title" align="left">Modules</th>
                        <th width="25%">Client</th>
                        <th width="25%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($status->modules as $module) : ?>
                        <tr class="row<?php echo ($rows++ % 2); ?>">
                            <td class="key"><?php echo JText::_($module['name']); ?></td>
                            <td class="key"><?php echo ucfirst($module['client']); ?></td>
                            <td><strong style="color: <?php echo ($module['result']) ? "green" : "red" ?>"><?php echo ($module['result']) ? 'Uninstalled' : 'Not uninstalled'; ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <?php if (count($status->plugins)) : ?>
            <table class="coalaweb">
                <thead align="left" >
                    <tr>
                        <th class="title" align="left">Plugins</th>
                        <th width="25%">Group</th>
                        <th width="25%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($status->plugins as $plugin) : ?>
                        <tr class="row<?php echo ($rows++ % 2); ?>">
                            <td class="key"><?php echo JText::_($plugin['name']); ?></td>
                            <td class="key"><?php echo ucfirst($plugin['group']); ?></td>
                            <td><strong style="color: <?php echo ($plugin['result']) ? "green" : "red" ?>"><?php echo ($plugin['result']) ? 'Uninstalled' : 'Not uninstalled'; ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
    }

    /**
     * Joomla! 1.6+ bugfix for "DB function returned no error"
     */
    private function _bugfixDBFunctionReturnedNoError() {
        $db = JFactory::getDbo();

        // Fix broken #__assets records
        $query = $db->getQuery(true);
        $query->select('id')
                ->from('#__assets')
                ->where($db->qn('name') . ' = ' . $db->q($this->_coalaweb_extension));
        $db->setQuery($query);
        try {
            $ids = $db->loadColumn();
        } catch (Exception $exc) {
            return;
        }

        if (!empty($ids)) {
            foreach ($ids as $id) {
                $query = $db->getQuery(true);
                $query->delete('#__assets')
                        ->where($db->qn('id') . ' = ' . $db->q($id));
                $db->setQuery($query);
                try {
                    $db->execute();
                } catch (Exception $exc) {
                    // Nothing
                }
            }
        }

        // Fix broken #__extensions records
        $query = $db->getQuery(true);
        $query->select('extension_id')
                ->from('#__extensions')
                ->where($db->qn('element') . ' = ' . $db->q($this->_coalaweb_extension));
        $db->setQuery($query);
        $ids = $db->loadColumn();
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $query = $db->getQuery(true);
                $query->delete('#__extensions')
                        ->where($db->qn('extension_id') . ' = ' . $db->q($id));
                $db->setQuery($query);

                try {
                    $db->execute();
                } catch (Exception $exc) {
                    // Nothing
                }
            }
        }

        // Fix broken #__menu records
        $query = $db->getQuery(true);
        $query->select('id')
                ->from('#__menu')
                ->where($db->qn('type') . ' = ' . $db->q('component'))
                ->where($db->qn('menutype') . ' = ' . $db->q('main'))
                ->where($db->qn('link') . ' LIKE ' . $db->q('index.php?option=' . $this->_coalaweb_extension));
        $db->setQuery($query);
        $ids = $db->loadColumn();
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $query = $db->getQuery(true);
                $query->delete('#__menu')
                        ->where($db->qn('id') . ' = ' . $db->q($id));
                $db->setQuery($query);

                try {
                    $db->execute();
                } catch (Exception $exc) {
                    // Nothing
                }
            }
        }
    }

    /**
     * Joomla! 1.6+ bugfix for "Can not build admin menus"
     */
    private function _bugfixCantBuildAdminMenus() {
        $db = JFactory::getDbo();

        // If there are multiple #__extensions record, keep one of them
        $query = $db->getQuery(true);
        $query->select('extension_id')
                ->from('#__extensions')
                ->where($db->qn('element') . ' = ' . $db->q($this->_coalaweb_extension));
        $db->setQuery($query);

        try {
            $ids = $db->loadColumn();
        } catch (Exception $exc) {
            return;
        }


        if (count($ids) > 1) {
            asort($ids);
            $extension_id = array_shift($ids); // Keep the oldest id

            foreach ($ids as $id) {
                $query = $db->getQuery(true);
                $query->delete('#__extensions')
                        ->where($db->qn('extension_id') . ' = ' . $db->q($id));
                $db->setQuery($query);

                try {
                    $db->execute();
                } catch (Exception $exc) {
                    // Nothing
                }
            }
        }

        // If there are multiple assets records, delete all except the oldest one
        $query = $db->getQuery(true);
        $query->select('id')
                ->from('#__assets')
                ->where($db->qn('name') . ' = ' . $db->q($this->_coalaweb_extension));
        $db->setQuery($query);
        $ids = $db->loadObjectList();

        if (count($ids) > 1) {
            asort($ids);
            $asset_id = array_shift($ids); // Keep the oldest id

            foreach ($ids as $id) {
                $query = $db->getQuery(true);
                $query->delete('#__assets')
                        ->where($db->qn('id') . ' = ' . $db->q($id));
                $db->setQuery($query);

                try {
                    $db->execute();
                } catch (Exception $exc) {
                    // Nothing
                }
            }
        }

        // Remove #__menu records for good measure!
        $query = $db->getQuery(true);
        $query->select('id')
                ->from('#__menu')
                ->where($db->qn('type') . ' = ' . $db->q('component'))
                ->where($db->qn('menutype') . ' = ' . $db->q('main'))
                ->where($db->qn('link') . ' LIKE ' . $db->q('index.php?option=' . $this->_coalaweb_extension));
        $db->setQuery($query);

        try {
            $ids1 = $db->loadColumn();
        } catch (Exception $exc) {
            $ids1 = array();
        }

        if (empty($ids1)) {
            $ids1 = array();
        }

        $query = $db->getQuery(true);
        $query->select('id')
                ->from('#__menu')
                ->where($db->qn('type') . ' = ' . $db->q('component'))
                ->where($db->qn('menutype') . ' = ' . $db->q('main'))
                ->where($db->qn('link') . ' LIKE ' . $db->q('index.php?option=' . $this->_coalaweb_extension . '&%'));
        $db->setQuery($query);

        try {
            $ids2 = $db->loadColumn();
        } catch (Exception $exc) {
            $ids2 = array();
        }

        if (empty($ids2)) {
            $ids2 = array();
        }

        $ids = array_merge($ids1, $ids2);

        if (!empty($ids)) {
            foreach ($ids as $id) {
                $query = $db->getQuery(true);
                $query->delete('#__menu')
                        ->where($db->qn('id') . ' = ' . $db->q($id));
                $db->setQuery($query);

                try {
                    $db->execute();
                } catch (Exception $exc) {
                    // Nothing
                }
            }
        }
    }

    /**
     * Installs subextensions (modules, plugins) bundled with the main extension
     * 
     * @param JInstaller $parent 
     * @return JObject The subextension installation status
     */
    private function _installSubextensions($parent) {
        $src = $parent->getParent()->getPath('source');

        $db = JFactory::getDbo();

        $status = new JObject();
        $status->modules = array();
        $status->plugins = array();

        // Modules installation
        if (count($this->installation_queue['modules'])) {
            foreach ($this->installation_queue['modules'] as $folder => $modules) {
                if (count($modules)) {
                    foreach ($modules as $module => $modulePreferences) {
                        // Install the module
                        if (empty($folder)) {
                            $folder = 'site';
                        }

                        $path = "$src/modules/$folder/$module";

                        if (!is_dir($path)) {
                            $path = "$src/modules/$folder/mod_$module";
                        }

                        if (!is_dir($path)) {
                            $path = "$src/modules/$module";
                        }

                        if (!is_dir($path)) {
                            $path = "$src/modules/mod_$module";
                        }

                        if (!is_dir($path)) {
                            continue;
                        }

                        // Was the module already installed?
                        $sql = $db->getQuery(true)
                                ->select('COUNT(*)')
                                ->from('#__modules')
                                ->where($db->qn('module') . ' = ' . $db->q('mod_' . $module));
                        $db->setQuery($sql);

                        try {
                            $count = $db->loadResult();
                        } catch (Exception $exc) {
                            $count = 0;
                        }

                        $installer = new JInstaller;
                        $result = $installer->install($path);
                        $status->modules[] = array(
                            'name' => 'mod_' . $module,
                            'client' => $folder,
                            'result' => $result
                        );

                        // Modify where it's published and its published state
                        if (!$count) {
                            // A. Position and state
                            list($modulePosition, $modulePublished) = $modulePreferences;

                            if ($modulePosition == 'cpanel') {
                                $modulePosition = 'icon';
                            }

                            $sql = $db->getQuery(true)
                                    ->update($db->qn('#__modules'))
                                    ->set($db->qn('position') . ' = ' . $db->q($modulePosition))
                                    ->where($db->qn('module') . ' = ' . $db->q('mod_' . $module));

                            if ($modulePublished) {
                                $sql->set($db->qn('published') . ' = ' . $db->q('1'));
                            }

                            $db->setQuery($sql);

                            try {
                                $db->execute();
                            } catch (Exception $exc) {
                                // Nothing
                            }

                            // B. Change the ordering of back-end modules to 1 + max ordering
                            if ($folder == 'admin') {
                                try {
                                    $query = $db->getQuery(true);
                                    $query->select('MAX(' . $db->qn('ordering') . ')')
                                            ->from($db->qn('#__modules'))
                                            ->where($db->qn('position') . '=' . $db->q($modulePosition));
                                    $db->setQuery($query);
                                    $position = $db->loadResult();
                                    $position++;

                                    $query = $db->getQuery(true);
                                    $query->update($db->qn('#__modules'))
                                            ->set($db->qn('ordering') . ' = ' . $db->q($position))
                                            ->where($db->qn('module') . ' = ' . $db->q('mod_' . $module));
                                    $db->setQuery($query);
                                    $db->execute();
                                } catch (Exception $exc) {
                                    // Nothing
                                }
                            }

                            // C. Link to all pages
                            try {
                                $query = $db->getQuery(true);
                                $query->select('id')->from($db->qn('#__modules'))
                                        ->where($db->qn('module') . ' = ' . $db->q('mod_' . $module));
                                $db->setQuery($query);
                                $moduleid = $db->loadResult();

                                $query = $db->getQuery(true);
                                $query->select('*')->from($db->qn('#__modules_menu'))
                                        ->where($db->qn('moduleid') . ' = ' . $db->q($moduleid));
                                $db->setQuery($query);
                                $assignments = $db->loadObjectList();
                                $isAssigned = !empty($assignments);
                                if (!$isAssigned) {
                                    $o = (object) array(
                                                'moduleid' => $moduleid,
                                                'menuid' => 0
                                    );
                                    $db->insertObject('#__modules_menu', $o);
                                }
                            } catch (Exception $exc) {
                                // Nothing
                            }
                        }
                    }
                }
            }
        }

        // Plugins installation
        if (count($this->installation_queue['plugins'])) {
            foreach ($this->installation_queue['plugins'] as $folder => $plugins) {
                if (count($plugins)) {
                    foreach ($plugins as $plugin => $published) {
                        $path = "$src/plugins/$folder/$plugin";

                        if (!is_dir($path)) {
                            $path = "$src/plugins/$folder/plg_$plugin";
                        }

                        if (!is_dir($path)) {
                            $path = "$src/plugins/$plugin";
                        }

                        if (!is_dir($path)) {
                            $path = "$src/plugins/plg_$plugin";
                        }

                        if (!is_dir($path)) {
                            continue;
                        }

                        // Was the plugin already installed?
                        $query = $db->getQuery(true)
                                ->select('COUNT(*)')
                                ->from($db->qn('#__extensions'))
                                ->where($db->qn('element') . ' = ' . $db->q($plugin))
                                ->where($db->qn('folder') . ' = ' . $db->q($folder));
                        $db->setQuery($query);

                        try {
                            $count = $db->loadResult();
                        } catch (Exception $exc) {
                            $count = 0;
                        }

                        $installer = new JInstaller;
                        $result = $installer->install($path);

                        $status->plugins[] = array('name' => 'plg_' . $plugin, 'group' => $folder, 'result' => $result);

                        if ($published && !$count) {
                            $query = $db->getQuery(true)
                                    ->update($db->qn('#__extensions'))
                                    ->set($db->qn('enabled') . ' = ' . $db->q('1'))
                                    ->where($db->qn('element') . ' = ' . $db->q($plugin))
                                    ->where($db->qn('folder') . ' = ' . $db->q($folder));
                            $db->setQuery($query);

                            try {
                                $db->execute();
                            } catch (Exception $exc) {
                                // Nothing
                            }
                        }
                    }
                }
            }
        }

        return $status;
    }

    /**
     * Uninstalls subextensions (modules, plugins) bundled with the main extension
     * 
     * @param JInstaller $parent 
     * @return JObject The subextension uninstallation status
     */
    private function _uninstallSubextensions($parent) {
        jimport('joomla.installer.installer');

        $db = JFactory::getDBO();

        $status = new JObject();
        $status->modules = array();
        $status->plugins = array();

        $src = $parent->getParent()->getPath('source');

        // Modules uninstallation
        if (count($this->uninstallation_queue['modules'])) {
            foreach ($this->uninstallation_queue['modules'] as $folder => $modules) {
                if (count($modules)) {
                    foreach ($modules as $module => $modulePreferences) {
                        // Find the module ID
                        $sql = $db->getQuery(true)
                                ->select($db->qn('extension_id'))
                                ->from($db->qn('#__extensions'))
                                ->where($db->qn('element') . ' = ' . $db->q('mod_' . $module))
                                ->where($db->qn('type') . ' = ' . $db->q('module'));
                        $db->setQuery($sql);
                        $id = $db->loadResult();
                        // Uninstall the module
                        if ($id) {
                            $installer = new JInstaller;
                            $result = $installer->uninstall('module', $id, 1);
                            $status->modules[] = array(
                                'name' => 'mod_' . $module,
                                'client' => $folder,
                                'result' => $result
                            );
                        }
                    }
                }
            }
        }

        // Plugins uninstallation
        if (count($this->uninstallation_queue['plugins'])) {
            foreach ($this->uninstallation_queue['plugins'] as $folder => $plugins) {
                if (count($plugins)) {
                    foreach ($plugins as $plugin => $published) {
                        $sql = $db->getQuery(true)
                                ->select($db->qn('extension_id'))
                                ->from($db->qn('#__extensions'))
                                ->where($db->qn('type') . ' = ' . $db->q('plugin'))
                                ->where($db->qn('element') . ' = ' . $db->q($plugin))
                                ->where($db->qn('folder') . ' = ' . $db->q($folder));
                        $db->setQuery($sql);

                        $id = $db->loadResult();
                        if ($id) {
                            $installer = new JInstaller;
                            $result = $installer->uninstall('plugin', $id, 1);
                            $status->plugins[] = array(
                                'name' => 'plg_' . $plugin,
                                'group' => $folder,
                                'result' => $result
                            );
                        }
                    }
                }
            }
        }

        return $status;
    }

    /**
     * Removes obsolete files and folders
     * 
     * @param array $coalawebRemoveFiles 
     */
    private function _removeObsoleteFilesAndFolders($coalawebRemoveFiles) {
        // Remove files
        jimport('joomla.filesystem.file');
        if (!empty($coalawebRemoveFiles['files'])) {
            foreach ($coalawebRemoveFiles['files'] as $file) {
                $f = JPATH_ROOT . '/' . $file;
                if (!JFile::exists($f)) {
                    continue;
                }
                JFile::delete($f);
            }
        }
        // Remove folders
        jimport('joomla.filesystem.folder');
        if (!empty($coalawebRemoveFiles['folders'])) {
            foreach ($coalawebRemoveFiles['folders'] as $folder) {
                $f = JPATH_ROOT . '/' . $folder;
                if (!JFolder::exists($f)) {
                    continue;
                }
                JFolder::delete($f);
            }
        }
    }

    /**
     * Add new files and folders
     * 
     * @param array $coalawebAddFiles 
     */
    private function _addNewFilesAndFolders($coalawebAddFiles) {
        // Add files
        jimport('joomla.filesystem.file');
        if (!empty($coalawebAddFiles['files'])) {
            foreach ($coalawebAddFiles['files'] as $file) {
                $f = JPATH_ROOT . '/' . $file;
                if (JFile::exists($f)) {
                    continue;
                }
                JFile::create($f);
            }
        }
        // Add folders
        jimport('joomla.filesystem.folder');
        if (!empty($coalawebAddFiles['folders'])) {
            foreach ($coalawebAddFiles['folders'] as $folder) {
                $f = JPATH_ROOT . '/' . $folder;
                if (JFolder::exists($f)) {
                    continue;
                }
                JFolder::create($f);
            }
        }
    }
}