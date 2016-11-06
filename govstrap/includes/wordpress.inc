<?php

/**
 * @file
 * WordPress helper function.
 */

/**
 * Retrieve the shortcode regular expression for searching.
 *
 * @param null $tags
 * @return string
 */
function get_shortcode_regex($tags = NULL) {
  $tokens = _govstrap_custom_tokens();

  if (empty($tags)) {
    $tags = array_keys($tokens);
  }

  $tag_regexp = join('|', array_map('preg_quote', $tags));

  // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
  // Also, see shortcode_unautop() and shortcode.js.
  return
    '\\['                              // Opening bracket
    . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
    . "($tag_regexp)"                     // 2: Shortcode name
    . '(?![\\w-])'                       // Not followed by word character or hyphen
    . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
    . '[^\\]\\/]*'                   // Not a closing bracket or forward slash
    . '(?:'
    . '\\/(?!\\])'               // A forward slash not followed by a closing bracket
    . '[^\\]\\/]*'               // Not a closing bracket or forward slash
    . ')*?'
    . ')'
    . '(?:'
    . '(\\/)'                        // 4: Self closing tag ...
    . '\\]'                          // ... and closing bracket
    . '|'
    . '\\]'                          // Closing bracket
    . '(?:'
    . '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
    . '[^\\[]*+'             // Not an opening bracket
    . '(?:'
    . '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
    . '[^\\[]*+'         // Not an opening bracket
    . ')*+'
    . ')'
    . '\\[\\/\\2\\]'             // Closing shortcode tag
    . ')?'
    . ')'
    . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
}

/**
 * Retrieve the shortcode attributes regex.
 *
 * @return string
 */
function get_shortcode_atts_regex() {
  return '/([\w-]+)\s*=\s*"([^"]*)"(?:\s|$)|([\w-]+)\s*=\s*\'([^\']*)\'(?:\s|$)|([\w-]+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
}

/**
 * Parse attributes.
 *
 * @param $text
 * @return array|string
 */
function shortcode_parse_atts($text) {
  $atts = array();
  $pattern = get_shortcode_atts_regex();
  $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
  if (preg_match_all($pattern, $text, $match, PREG_SET_ORDER)) {
    foreach ($match as $m) {
      if (!empty($m[1])) {
        $atts[strtolower($m[1])] = stripcslashes($m[2]);
      }
      elseif (!empty($m[3])) {
        $atts[strtolower($m[3])] = stripcslashes($m[4]);
      }
      elseif (!empty($m[5])) {
        $atts[strtolower($m[5])] = stripcslashes($m[6]);
      }
      elseif (isset($m[7]) && strlen($m[7])) {
        $atts[] = stripcslashes($m[7]);
      }
      elseif (isset($m[8])) {
        $atts[] = stripcslashes($m[8]);
      }
    }

    // Reject any unclosed HTML elements
    foreach ($atts as &$value) {
      if (FALSE !== strpos($value, '<')) {
        if (1 !== preg_match('/^[^<]*+(?:<[^>]*+>[^<]*+)*+$/', $value)) {
          $value = '';
        }
      }
    }
  }
  else {
    $atts = ltrim($text);
  }

  return $atts;
}

/**
 * HTML split.
 *
 * @param $input
 * @return array
 */
function wp_html_split($input) {
  return preg_split(get_html_split_regex(), $input, -1, PREG_SPLIT_DELIM_CAPTURE);
}

/**
 * HTML split regex.
 *
 * @return string
 */
function get_html_split_regex() {
  static $regex;

  if (!isset($regex)) {
    $comments =
      '!'           // Start of comment, after the <.
      . '(?:'         // Unroll the loop: Consume everything until --> is found.
      . '-(?!->)' // Dash not followed by end of comment.
      . '[^\-]*+' // Consume non-dashes.
      . ')*+'         // Loop possessively.
      . '(?:-->)?';   // End of comment. If not found, match all input.

    $cdata =
      '!\[CDATA\['  // Start of comment, after the <.
      . '[^\]]*+'     // Consume non-].
      . '(?:'         // Unroll the loop: Consume everything until ]]> is found.
      . '](?!]>)' // One ] not followed by end of comment.
      . '[^\]]*+' // Consume non-].
      . ')*+'         // Loop possessively.
      . '(?:]]>)?';   // End of comment. If not found, match all input.

    $escaped =
      '(?='           // Is the element escaped?
      . '!--'
      . '|'
      . '!\[CDATA\['
      . ')'
      . '(?(?=!-)'      // If yes, which type?
      . $comments
      . '|'
      . $cdata
      . ')';

    $regex =
      '/('              // Capture the entire match.
      . '<'           // Find start of element.
      . '(?'          // Conditional expression follows.
      . $escaped  // Find end of escaped element.
      . '|'           // ... else ...
      . '[^>]*>?' // Find end of normal element.
      . ')'
      . ')/';
  }

  return $regex;
}
