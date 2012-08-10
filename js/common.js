/*
 * Spectaculous v1.0
 * (c) Web factory Ltd
 * www.webfactoryltd.com
**/

$(function() {

<!-- Google Plus -->
  window.___gcfg = {lang: 'pt-BR'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();


  // init Parallax slider
  var $pxs_container = $('#pxs_container');
  $pxs_container.parallaxSlider();
    
  // init contact form validation and AJAX handling
  if ($("#contactform").length > 0) {
    $("#contactform").validate({ rules: { name: "required",
                                         email: { required: true, email: true },
                                         telefone: "required",
                                         message: "required"},
                                messages: { name: "Preencha seu nome.",
											telefone: "Preencha seu telefone.",
											message: "Detalhe como podemos lhe atender.",
                                            email: { required: "Preencha seu e-mail.",
                                                     email: "Por favor, digite um endereço de e-mail válido."}},
                                submitHandler: function(form) {  $(form).ajaxSubmit({dataType: 'json', success: contactFormResponse}); }
                              });
  }
  
    // handle contact form AJAX response
  function contactFormResponse(response) {
    if (response.responseStatus == 'err') {
      if (response.responseMsg == 'ajax') {
        alert('Error - this script can only be invoked via an AJAX call.');
      } else if (response.responseMsg == 'notsent') {
        alert('Houve um problema no envio da mensagem. Por favor, envie-a diretamente por e-mail (sites@trajettoria.com).');
      } else {
        alert('Houve um problema no envio da mensagem. Por favor, envie-a diretamente por e-mail (sites@trajettoria.com).');
      }
    } else if (response.responseStatus == 'ok') {
      alert('Obrigado pela mensagem! Em breve nos entraremos em contato.');
    } else {
      alert('Houve um problema no envio da mensagem. Por favor, envie-a diretamente por e-mail (sites@trajettoria.com).');
    }
  } // contactFormResponse

  // Lightbox gallery
  $('.gallery a[data-gal]').each(function() {
    $(this).attr('rel', $(this).data('gal'));
  });
  $(".gallery a[rel^='prettyPhoto']").prettyPhoto({ animationSpeed:'slow',
                                                    theme:'light_rounded',
                                                    slideshow:4000,
                                                    autoplay_slideshow: false,
                                                    social_tools: ''});
  

 
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=268548303245278";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


}); // onload