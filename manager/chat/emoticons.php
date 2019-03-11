<?php

/*
Copyright 2017 Dario Cangialosi

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// textual emoticon to HTML emoticon
function textual_emoticon_to_html_emoticon($textual_emoticon_type){
    // example HTML emoticon : '<img src="img/ico/mail.png" class="emoticon" alt=":mail:">'
    $mapping = json_decode(file_get_contents(dirname(dirname(dirname(__FILE__))).'/chat/ico_mapping.json'), true);
    if(!array_key_exists($textual_emoticon_type, $mapping)) return null;
    $src = $mapping[$textual_emoticon_type];
    $html = '<img src="img/ico/'.$src.'" class="emoticon" alt=":'.$textual_emoticon_type.':">';
    return $html;
}

// echo textual_emoticon_to_html_emoticon('mail');

// parse all textual emoticons expressions found in message to send
function parse_emoticons_expressions($string){
    $regex = '/:\w+:/i';
    $matches = [];
    $success = preg_match_all($regex, $string, $matches);
    $processed = [];

    $matches = $matches[0];

    for($i = 0; $i < count($matches); $i++) {
        $match = $matches[$i];
        $textual_emoticon_type = substr($match, 1, -1);
        $html_emoticon = textual_emoticon_to_html_emoticon($textual_emoticon_type);
        if($html_emoticon == null) continue;
        $processed[$match] = $html_emoticon;
    }

    foreach ($processed as $original => $value) {
        $string = str_replace($original, $value, $string);
    }
    return $string;
}

// echo parse_emoticons_expressions('(mail)(heart)(123)');

// $text = parse_emoticons_expressions($text);
