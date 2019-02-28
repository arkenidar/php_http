
/*
Copyright 2017 Dario Cangialosi

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

const base_dir = window.location.pathname.split('/').slice(0,-1).join('/');

var base='../index.php?r='

// on ready
$(function(){
    // enforce user being logged in
    const allow_anonymous_user = false;
    enforce_user_login(allow_anonymous_user);
    // SETUP MESSAGE SENDING
    setup_emoticons();
    $('#message_text').on('input', on_input);
    $('#send').click(send_message);
    // get messages
    periodically_list_messages_callback()
    setInterval(periodically_list_messages_callback, 3000);

});

function setup_emoticons() {
    $.ajax({
        url: 'ico_mapping.json',
        success: function(data) {
            ico_mapping = data;
            setup_emoticon_palette();
        },
        fail: function() {
          alert( "Error! when loading: icons's mapping" );
        }
    });
}

function enforce_user_login (allow_anonymous_user) {
    $.get(base+'user_logged', function(data) {
        username=data;
        $('#user').text(username);
        if(username=='anonymous' && !allow_anonymous_user) {
            alert('The user is logged out. Login, please.');
            location = '/auth';
        }
    })
    .fail(function() {
      alert( "Error! when loading: logged user info" );
    });
}

function setup_emoticon_palette() {
    // emoticon palette / creation of its HTML
    for(textual_emoticon in ico_mapping){
        var src = ico_mapping[textual_emoticon];
        $('#emoticons_palette').append(
            `<img src="img/ico/${src}" class="emoticon" alt=":${textual_emoticon}:">`
        );

    }

    // emoticon palette / toggling
    var emoticons_palette_showed = false;
    var scroll_top_keeping;
    $('#edit_tools').click(()=>{
        if(emoticons_palette_showed){
            $('#emoticons_palette').hide();
            emoticons_palette_showed = false;
            $('#message_log').show();
            $('html')[0].scrollTop = scroll_top_keeping;

        } else {
            scroll_top_keeping = $('html')[0].scrollTop;
            $('#message_log').hide();
            $('#emoticons_palette').show();
            emoticons_palette_showed = true;
        }
    });

    // emoticon palette / emoticon insertion
    $('#emoticons_palette .emoticon').click(function() {
        insert_emoticon_into_message($(this).attr('alt'));
    });
    function insert_emoticon_into_message(textual_emoticon_text) {
        $('#message_text').html($('#message_text').html()+textual_emoticon_text);
        $('#message_text').trigger('input');
    }
}

// chat scrolling
function scroll_height(){ return $(document).height()-$(window).height(); }
function is_scrolled_to_bottom(){ return (Math.abs($('html')[0].scrollTop - scroll_height())<5); }
function scroll_to_bottom(){ $('html')[0].scrollTop = scroll_height(); }

// message listing
function list_messages(scrollFlag){ $('#message_log').load(base+'chat_list&embedded', function(){ if(scrollFlag) scroll_to_bottom(); } ) }
function periodically_list_messages_callback(){ var scrollFlag = is_scrolled_to_bottom(); list_messages(scrollFlag); }

function get_input(){
    var input = replace_all_html_emoticons($('div#message_text'))[0].innerText;
    return input;
}

// allow message sending
function send_message(){

    // no blank message fields allowed
    var message_text = get_input();
    if(message_text==''){
         alert('fill the Message field!');
         return false;
    }

    var form_data_object = { message_text };

    // disable form on pre-submit
    $('#send_message_form *').prop('disabled', true);

    // send JSON with POST type HTTP request
    $.post(base+'chat_send',form_data_object)
    .done(function(){
        // empty the message field
        $('div#message_text').html('');
    })
    .fail(function(){ // error handling
        alert('Error when sending a message!');
        enforce_user_login();
    })
    .always(function(){
        // enable form on post-submit
        $('#send_message_form *').prop('disabled', false);
    });
}

// replace all HTML emoticons with textual emoticons before sending, to preserve them
function replace_all_html_emoticons(text_element){

    var working_copy = text_element.clone();

    // emoticon's img elements
    var imgs = working_copy.find('img[class="emoticon"]');
    imgs.each(function () {
        var html_emoticon_element = $(this);
        replace_html_emoticon(html_emoticon_element);
    });

    // replace HTML emoticon with textual emoticon
    function replace_html_emoticon(html_emoticon_element){
        html_emoticon_element.replaceWith(html_emoticon_element.attr('alt'));
    }

    return working_copy;
}

// textual emoticon to HTML emoticon
function textual_emoticon_to_html_emoticon(textual_emoticon_text){
    // example HTML emoticon : '<img src="img/ico/mail.png" class="emoticon" alt=":mail:">'
    var mapping = ico_mapping;
    var textual_emoticon_type = textual_emoticon_text.slice(1,-1);
    var src = mapping[textual_emoticon_type];
    // for invalid mappings...
    if(typeof src == 'undefined') return textual_emoticon_text;
    var html = '<img src="img/ico/'+src+'" class="emoticon" alt="'+textual_emoticon_text+'">';
    return html;
}

// parse all textual emoticons expressions found in message to send
function parse_emoticons_expressions(string){
    return string.replace(/(:\w+:)/gi, textual_emoticon_to_html_emoticon);
}

function escape_regexp(str) {
  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}

function replace_all(string, replace_what, replace_with){
    return string.replace(
        new RegExp(escape_regexp(replace_what), 'gi'),
        replace_with
    );
}

function replace_smileys(input){
    var mappings = [
        [':)', ':smile:'],
        ['<3', ':heart:'],
    ];
    for(mapping of mappings){
        input = replace_all(input, mapping[0], mapping[1]);
    }
    return input;
}

function place_caret_at_the_end(el) {
    el.focus();
    if (typeof window.getSelection != "undefined"
            && typeof document.createRange != "undefined") {
        var range = document.createRange();
        range.selectNodeContents(el);
        range.collapse(false);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    } else if (typeof document.body.createTextRange != "undefined") {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(el);
        textRange.collapse(false);
        textRange.select();
    }
}

function escape_html(text) {
    'use strict';
    return text.replace(/[\"&<>]/g, function (a) {
        return { '"': '&quot;', '&': '&amp;', '<': '&lt;', '>': '&gt;' }[a];
    });
}

function on_input(inputEvent){
    var input = get_input();
    input = replace_smileys(input);
    input = escape_html(input);
    var new_html = parse_emoticons_expressions(input);
    if(new_html!=null){
        $(this).html(new_html);
        place_caret_at_the_end($(this)[0]);
    }
}
