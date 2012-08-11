<?php
function create_guid($namespace = '') {
	static $guid = '';
	$uid = uniqid("", true);
	$data = $namespace;
	$data .= $_SERVER['REQUEST_TIME'];
	$data .= $_SERVER['HTTP_USER_AGENT'];
	$data .= $_SERVER['REMOTE_ADDR'];
	$data .= $_SERVER['REMOTE_PORT'];
	$hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
	$guid = substr($hash,  0,  8) .
	'-' .
	substr($hash,  8,  4) .
	'-' .
	substr($hash, 12,  4) .
	'-' .
	substr($hash, 16,  4) .
	'-' .
	substr($hash, 20, 12);
	return $guid;
}

// create unique key
$visit_key = create_guid();

?>
<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8" />
  <title>Trajettoria | Sites para a área médico-científica!</title>
  <meta name="description" content="A Trajettoria oferece serviço de criação de sites e sistemas sob medida para a área médica!" />
  <meta name="keywords" content="trajettoria, médico, webdesign, criação de sites, médica, médicos, sites para médicos, site médico, sites para medicos, site medico, sites médicos, sites medicos, sites, site" />
  <meta name="author" content="http://www.trajettoria.com" />
  <link type="image/vnd.microsoft.icon" href="favicon.ico" rel="shortcut icon" />
  <link type="image/vnd.microsoft.icon" href="favicon.ico" rel="icon" />
  <meta name="viewport" content="width=device-width, initial-scale=0.7" />
  <link rel="stylesheet" href="css/1140.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/color-themes/wood.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/textures/switcher21dd2.css?default=minimal.css" type="text/css" media="screen" />
  <script type="text/javascript" src="js/css3-mediaqueries.js"></script>
  <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
  <!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="css/ie8.css">
  <![endif]-->
  <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="css/ie7.css">
  <![endif]-->
  <script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>

  <script type="text/javascript">
  
    function getParameterByName(name)
	{
	  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	  var regexS = "[\\?&]" + name + "=([^&#]*)";
	  var regex = new RegExp(regexS);
	  var results = regex.exec(window.location.search);
	  if(results == null)
		return "";
	  else
		return decodeURIComponent(results[1].replace(/\+/g, " "));
	}

  $(document).ready(function(){
	width = $(window).width();
	new_left = (-1)*((1903 - width)/2);

	$('#teaser').css("background-position", new_left + "px 0");
  
    $(window).resize(function(){
		width = $(window).width();
		new_left = (-1)*((1903 - width)/2);
	
		$('#teaser').css("background-position", new_left + "px 0");
	});
	
	res = screen.width + "x" + screen.height;
	from = getParameterByName('f');
	visit_key = '<?php echo $visit_key; ?>';
	$('#r').val(res);
	$('#f').val(from);
	$('#k').val(visit_key);
  });
  </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34014052-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>  
</head>
<body>
  <div id="fb-root"></div>
  <div id="top" class="glow">
    <div class="row">
      <div class="fourcol">
        <a href="http://www.trajettoria.com" title="Trajettoria" target="_blank"><img id="logo" src="images/logo_trajettoria.png" alt="Trajettoria" /></a>
      </div>
      <div class="eightcol last">
          <div id="social-share">
            <ul>
              <li class="google-like"><g:plusone annotation="inline" width="120"></g:plusone></li>
              <li class="twitter-like"><a href="https://twitter.com/share" class="twitter-share-button" data-via="trajettoria" data-lang="pt">Tweetar</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
              <li class="facebook-like"><div class="fb-like" data-href="https://www.facebook.com/pages/Trajettoria-Tecnologia-da-Informa%C3%A7%C3%A3o/317319125018577" data-send="true" data-layout="button_count" data-width="150" data-show-faces="false"></div></li>
            </ul>
          </div>
      </div>
    </div>
  </div>
  <div id="teaser" class="glow">
    <div class="texture">
        <div id="pxs_container" class="pxs_container">
          <div class="pxs_loading">Loading images...</div>
          <div class="pxs_slider_wrapper">
            <ul class="pxs_slider">
              <li>
                <div class="row">
                  <div class="slide-content-right slide-content fivecol">
                    <h2>Precisa de um site médico-científico?</h2>
                    <p>Conte com quem conhece a área!
					
					<br /> <a href="http://themeforest.net/item/spectaculous-premium-landing-page/559837"><b>A Trajettoria otimiza sua presença na Web!</b></a></p>
                    <a class="big-button" href="#contato">Solicite informações</a>
                  </div>
                </div>
              </li>   
            </ul>
            <div class="pxs_navigation">
              <span class="pxs_next"></span>
              <span class="pxs_prev"></span>
            </div>
            <ul class="pxs_thumbnails">
              <li><img src="images/paralax/thumbs/blank.png" alt="Blank" /></li>
              <li><img src="images/paralax/thumbs/blank.png" alt="Blank" /></li>
              <li><img src="images/paralax/thumbs/blank.png" alt="Blank" /></li>
            </ul>
          </div>
        </div>
      <div class="scissors-white">&nbsp;</div>
    </div>
  </div>
  <div id="content">
  
    <div id="gallery" class="glow">
    <div class="row gallery">
      <div class="thumb threecol">
        <a href="images/gallery/f_dot.jpg" data-gal="prettyPhoto[gallery1]" title="Ortopedia Unifesp"><img alt="Ortopedia Unifesp" title="Ortopedia Unifesp" src="images/gallery/f_dot_thumb.jpg" /></a>
      </div>
      <div class="thumb threecol">
        <a href="images/gallery/f_endocrino.jpg" data-gal="prettyPhoto[gallery1]" title="Endocrinologia USP"><img alt="Endocrinologia USP" title="Endocrinologia USP" src="images/gallery/f_endocrino_thumb.jpg" /></a>
      </div>
      <div class="thumb threecol">
        <a href="images/gallery/f_lim37.jpg" data-gal="prettyPhoto[gallery1]" title="Laboratório de Transplante de Fígado USP"><img alt="Laboratório de Transplante de Fígado USP" title="Laboratório de Transplante de Fígado USP" src="images/gallery/f_lim37_thumb.jpg" /></a>
      </div>
      <div class="thumb threecol last">
        <a href="images/gallery/f_neuro.jpg" data-gal="prettyPhoto[gallery1]" title="Neurologia USP"><img alt="Neurologia USP" title="Neurologia USP" src="images/gallery/f_neuro_thumb.jpg" /></a>
      </div>
    </div>
  </div>

    <div class="row section">
      <h4 class="section-title"><span>Descubra o que podemos oferecer</span></h4>
      <div class="box fourcol">
        <img alt="Icon" title="Icon" src="images/icons/pda.png">
        <h3>Seu site personalizado</h3>
        <p>Não importa se você trabalha sozinho, numa equipe médica ou numa instituição pública ou privada. Nós temos a solução para tornar sua comunicação com seus pacientes, pesquisadores e colegas muito mais eficiente!</p>
      </div>
      <div class="box fourcol">
        <img alt="Icon" title="Icon" src="images/icons/wall.png">
        <h3>Automatize suas tarefas!</h3>
        <p>Em nossos sites, você pode oferecer conteúdos de acesso restrito, emitir boletos, gerenciar inscrições em eventos, disponibilizar material de aula, mostrar seu mapa de localização com o Google Maps, conhecer quem são seus visitantes e muito mais!<br /></p>
      </div>
      <div class="box fourcol last">
        <img alt="Icon" title="Icon" src="images/icons/chat.png">
        <h3>Apareça no Google!</h3>
        <p>Com uma técnica aprimorada, nós aumentamos as chances de que seu site fique bem posicionado nos mecanismos de busca e as pessoas o localizarão com mais facilidade!</p>
      </div>
      <div class="clear"></div>
      
    <div class="row section">
      <h4 class="section-title"><span>Solicite mais informações sem compromisso!</span></h4>
      <div class="box sixcol">
        <div id="contact-form">
		  <a name="contato"></a>
          <h3>Como podemos lhe atender?</h3>
          <form id="contactform" action="send_rfp.php" method="post">
		  
		  <input type="hidden" name="f" id="f" value="" />
		  <input type="hidden" name="r" id="r" value="" />
		  <input type="hidden" name="k" id="k" value="" />
		  
            <p>
              <label for="name">Nome *</label>
              <input type="text" name="name" id="name" class="input-field">
            </p>
            <p>
              <label for="email">E-mail *</label>
              <input type="text" name="email" id="email" class="input-field">
            </p>
            <p>
              <label for="email">Telefone *</label>
              <input type="text" name="telefone" id="telefone" class="input-field" value="">
            </p>
            <p>
              <label for="message">Sua mensagem *</label>
              <textarea rows="4" cols="50" name="message" id="message"></textarea>
            </p>
             <a onclick="$('#contactform').submit(); return false;" href="#" class="contact-button">Enviar mensagem</a>
          </form>
        </div>
      </div>
      <div class="box sixcol last methods">
        <h3>Credibilidade: a nossa marca!</h3>
        <h4>Legislação</h4>
        <p>Nós respeitamos todas as normas do CFM que se aplicam à publicidade médica. Também respeitamos as políticas institucionais de acordo com o seu vínculo institucional!/p>
        <h4>Informação protegida</h4>
        <p>Nós adotamos procedimentos que aumentam (e muito!) a segurança de sua informação! São backups, upgrades de segurança, anti-vírus, firewall e tudo que possa servir para melhorar a sua experiência como cliente da Trajettoria! E a experiência dos SEUS visitantes!</p>
        <h4>Conheça melhor!</h4>
        <h5>Preencha o formulário e nós entraremos em contato com mais informações!</h5>
		</div>
      <div class="clear"></div>
    </div>
      <div class="calltoaction">
        <div class="calltoaction-inner">
          <h4>Já tem um site? Mas será que ele realmente atende às suas necessidades?</h4>
          <p>Um site inadequado consome seu tempo com tarefas desnecessárias e passa uma imagem negativa para seus visitantes.</p>
          <a class="button" href="mailto:sites@trajettoria.com">Solicite uma reforma no seu site!</a>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>

  <div id="footer">
    <div class="row glow">
            <div id="footer-copy">
        <div class="twelvecol">
          <h6><a href="http://www.trajettoria.com" title="Trajettoria" target="_blank"><span>Trajettoria</span></a> Tecnologia da Informação</h6>
          <p>&copy; 2012 Todos os direitos reservados.</p>
        </div>
      </div>
    </div>
  </div>
<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="js/jquery.form.2.67.js" type="text/javascript"></script>
<script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/paralax.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>
</body>
</html>
<?php require_once('track_visit.php'); ?>