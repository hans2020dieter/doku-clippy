<?php
/**
 * DokuWiki Plugin Doku Clippy (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Derek Chafin <infomaniac50@gmail.com>
 */

// must be run within Dokuwiki
if ( !defined( 'DOKU_INC' ) ) die();

if ( !defined( 'DOKU_PLUGIN' ) ) define( 'DOKU_PLUGIN', DOKU_INC.'lib/plugins/' );
require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_clippy extends DokuWiki_Syntax_Plugin {
  
  public function getType() { return 'substition'; }
  function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }
  public function getPType() { return 'normal'; }
  public function getSort() { return 999; }
  public function connectTo( $mode ) { $this->Lexer->addSpecialPattern( '<clippy>.*?</clippy>', $mode, 'plugin_clippy' ); }

  public function handle( $match, $state, $pos, Doku_Handler $handler ) {
    if ( preg_match( '/\<clippy\>(.*)\<\/clippy\>/is', $match, $result ) === 1 ) {
      $text = $result[1];
    }
    elseif ( preg_match( '/\[clippy\s(.*)\]/is', $match, $result ) === 1 ) {
      $text = $result[1];
    }
    else {
      return $data;
    }
    $data = array(
      'text' => $text,
    );
    return $data;
  }

  /**
   * Render xhtml output or metadata
   *
   * @param string  $mode     Renderer mode (supported modes: xhtml)
   * @param Doku_Renderer $renderer The renderer
   * @param array   $data     The data from the handler() function
   * @return bool If rendering was successful.
   */
  public function render( $mode, Doku_Renderer $renderer, $data ) {
    if ( $mode != 'xhtml' ) return false;

	$renderer->doc .= '
<span class="clippywrapper">
	<span class="clippy" onclick="copyToClip(\'' . $data['text'] . '\',this);">
		<span class="tooltiptext">Copy to Clipboard
			<span class="arrow"></span>
		</span>
	</span>
</span><span class="inlinewrapper"></span>
	';
    return true;
  }
}

// vim:ts=4:sw=4:et:
