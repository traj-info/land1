/*
 * Spectaculous v1.0
 * (c) Web factory Ltd
 * www.webfactoryltd.com
**/

$(function() {
  // load captcha question
  if ($('#captcha-img').length) {
    $.get('captcha.php?generate', function(response) {
      $('#captcha-img').html(response);
    }, 'html');
  }

  // init Parallax slider
  var $pxs_container = $('#pxs_container');
  $pxs_container.parallaxSlider();
    
  // init contact form validation and AJAX handling
  if ($("#contactform").length > 0) {
    $("#contactform").validate({ rules: { name: "required",
                                         email: { required: true, email: true },
                                         captcha: {required: true, remote: 'captcha.php' },
                                         message: "required"},
                                messages: { name: "This field is required.",
                                            email: { required: "This field is required.",
                                                     email: "Please enter a valied email address."},
                                            captcha: 'Are you sure you\'re a human? Please recheck.'},
                                submitHandler: function(form) {  $(form).ajaxSubmit({dataType: 'json', success: contactFormResponse}); }
                              });
  }
  
    // handle contact form AJAX response
  function contactFormResponse(response) {
    if (response.responseStatus == 'err') {
      if (response.responseMsg == 'ajax') {
        alert('Error - this script can only be invoked via an AJAX call.');
      } else if (response.responseMsg == 'notsent') {
        alert('We are having some mail server issues. Please refresh the page or try again later.');
      } else {
        alert('Undocumented error. Please refresh the page and try again.');
      }
    } else if (response.responseStatus == 'ok') {
      alert('Thank you for contacting us! We\'ll get back to you ASAP.');
    } else {
      alert('Undocumented error. Please refresh the page and try again.');
    }
  } // contactFormResponse

  // Lightbox gallery
  $('.gallery a[data-gal]').each(function() {
    $(this).attr('rel', $(this).data('gal'));
  });
  $(".gallery a[rel^='prettyPhoto']").prettyPhoto({ animationSpeed:'slow',
                                                    theme:'dark_rounded',
                                                    slideshow:4000,
                                                    autoplay_slideshow: false,
                                                    social_tools: ''});
  

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#appId=152938731463199&xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
}); // onload