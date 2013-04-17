<?php
/**
 * DokuWiki Plugin show specific page instead of denied message
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Benjamin Renard <brenard@easter-eggs.com>
 */

if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'action.php';

class action_plugin_deniedpage extends DokuWiki_Action_Plugin {

    /**
     * Register its handlers with the dokuwiki's event controller
     */
    public function register(Doku_Event_Handler &$controller) {
       $controller->register_hook('ACTION_HEADERS_SEND', 'BEFORE', $this, 'handle_action_headers_send');
    }

    /**
     * Handle the event
     */ 
    public function handle_action_headers_send(Doku_Event &$event, $param) {
      global $ACT;

      if ($ACT == 'denied') {
	$event->preventDefault(); // prevent "Access denied" page from showing
	send_redirect(wl($this->getConf('deniedpage'),'',true));
      }
    }

}
// vim:ts=4:sw=4:et:
