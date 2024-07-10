<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
    @livewireScripts
    <title>Caddy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHGCSZXFOWWnh3myubn_y0uMnzeArw-kI&libraries=places"></script>
    <link rel="icon" href="/favicon.ico" />
    <script> window['_fs_debug'] = false; window['_fs_host'] = 'fullstory.com'; window['_fs_script'] = 'edge.fullstory.com/s/fs.js'; window['_fs_org'] = '17141T'; window['_fs_namespace'] = 'FS'; (function(m,n,e,t,l,o,g,y){ if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;} g=m[e]=function(a,b,s){g.q?g.q.push([a,b,s]):g._api(a,b,s);};g.q=[]; o=n.createElement(t);o.async=1;o.crossOrigin='anonymous';o.src='https://'+_fs_script; y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y); g.identify=function(i,v,s){g(l,{uid:i},s);if(v)g(l,v,s)};g.setUserVars=function(v,s){g(l,v,s)};g.event=function(i,v,s){g('event',{n:i,p:v},s)}; g.anonymize=function(){g.identify(!!0)}; g.shutdown=function(){g("rec",!1)};g.restart=function(){g("rec",!0)}; g.log = function(a,b){g("log",[a,b])}; g.consent=function(a){g("consent",!arguments.length||a)}; g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)}; g.clearUserCookie=function(){}; g.setVars=function(n, p){g('setVars',[n,p]);}; g._w={};y='XMLHttpRequest';g._w[y]=m[y];y='fetch';g._w[y]=m[y]; if(m[y])m[y]=function(){return g._w[y].apply(this,arguments)}; g._v="1.3.0"; })(window,document,window['_fs_namespace'],'script','user'); </script>
    <!-- Meta Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '800739758030692');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=800739758030692&ev=PageView&noscript=1"
    /></noscript>


    <!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-299360787"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-299360787'); </script>

    <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-299360787/Z82KCO-C5qQDEJPE344B', 'value': 180.0, 'currency': 'USD', 'event_callback': callback }); return false; } </script>
  </head>
  <body class="flex flex-col items-center w-full">
    <header class="w-full flex items-center justify-between p-4 border-b-4 border-black">
      <a href="https://caddymoving.com/"><img class='w-28' src="/assets/logo.png"></a>

      <div class="flex items-center justify-end gap-[0.5rem] text-3xl font-bold">
        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
          <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
        </svg>

        <a href="tel:888-818-8049">888-818-8049</a>
      </div>
    </header>

    @yield('main')

    </body>
</html>