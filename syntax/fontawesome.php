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

    function getAllowedTypes() { return array('formatting', 'substition', 'disabled'); }
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
        $this->Lexer->addEntryPattern('<fa',$mode,'plugin_fontawesome_fontawesome');
//        $this->Lexer->addEntryPattern('<FIXME>',$mode,'plugin_fontawesome_fontawesome');
    }

    public function postConnect() {
        $this->Lexer->addExitPattern('>','plugin_fontawesome_fontawesome');
    }

    /**
     * Handle matches of the fontawesome syntax
     *
     * @param string $match The match of the syntax
     * @param int    $state The state of the handler
     * @param int    $pos The position in the document
     * @param Doku_Handler    $handler The handler
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, Doku_Handler $handler){
        $data = array();

        if ($state == DOKU_LEXER_UNMATCHED){
            $words=explode(" ",$match);

            $data['type'] = array_shift($words);
            $data['data'] = join(" ", $words);
        }

        return array($state,$data);
    }

    /**
     * Render xhtml output or metadata
     *
     * @param string         $mode      Renderer mode (supported modes: xhtml)
     * @param Doku_Renderer  $renderer  The renderer
     * @param array          $data      The data from the handler() function
     * @return bool If rendering was successful.
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        if($mode != 'xhtml') return false;

        list($state,$match)=$data;
        if ($state == DOKU_LEXER_UNMATCHED){
            switch($match['type']){
            case 'icon':
                $tag='i';
                break;
            }

            $renderer->doc .= '<'.$tag.' class="'. $renderer->_xmlEntities($match['data']) .'"></'.$tag.'>';
            return true;
        }

        return false;
    }
}

// vim:ts=4:sw=4:et:
