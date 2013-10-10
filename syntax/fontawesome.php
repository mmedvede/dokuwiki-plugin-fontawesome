<?php
/**
 * DokuWiki Plugin fontawesome (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Mikhail Medvedev <mmedvede@cs.uml.edu>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_fontawesome_fontawesome extends DokuWiki_Syntax_Plugin {
    /**
     * @return string Syntax mode type
     */
    public function getType() {
        return 'substition';
    }
    /**
     * @return string Paragraph type
     */
    public function getPType() {
        return 'normal';
    }
    /**
     * @return int Sort order - Low numbers go before high numbers
     */
    public function getSort() {
        return 100;
    }

    /**
     * Connect lookup pattern to lexer.
     *
     * @param string $mode Parser mode
     */
    public function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<fontawesome>.*</fontawesome>',$mode,'plugin_fontawesome_fontawesome');
//        $this->Lexer->addEntryPattern('<FIXME>',$mode,'plugin_fontawesome_fontawesome');
    }

//    public function postConnect() {
//        $this->Lexer->addExitPattern('</FIXME>','plugin_fontawesome_fontawesome');
//    }

    /**
     * Handle matches of the fontawesome syntax
     *
     * @param string $match The match of the syntax
     * @param int    $state The state of the handler
     * @param int    $pos The position in the document
     * @param Doku_Handler    $handler The handler
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, &$handler){
        $data = array();

        $data=$match;

        return $data;
    }

    /**
     * Render xhtml output or metadata
     *
     * @param string         $mode      Renderer mode (supported modes: xhtml)
     * @param Doku_Renderer  $renderer  The renderer
     * @param array          $data      The data from the handler() function
     * @return bool If rendering was successful.
     */
    public function render($mode, &$renderer, $data) {
        if($mode != 'xhtml') return false;

        $renderer->doc .= $data;

        return true;
    }
}

// vim:ts=4:sw=4:et:
