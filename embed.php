<?php
if (!empty($_GET['id']) && isset($_GET['id'])) {
    include('gp.php');
    $udkux = $_SERVER['HTTP_REFERER'];
if (strpos($udkux, 'mydomain.com') !== false) {

} else {
// exit("No direct linking!");
}
$getGP = getPhotoGoogle($_GET['id']); //id is full photos url
$ik = json_decode($getGP, true);
$sourcesx = "";
$posterimg = posterImg($_GET['id']);
 foreach ($ik as $v) {
$lablx = str_replace("p","",$v['label']);
$sourcesx .= '<source src="'.$v['file'].'" type="'.$v['type'].'" res="'.$lablx.'" label="'.$lablx.'" />';
}
} else {
    exit('No Id provided!');
}
?>
<!DOCTYPE html>
<html >
   <head>
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.11.9/video-js.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {margin:0px !important; border-radius:0px !important; padding:0px !important;}
  
    #vjs-image-overlay-holder { -webkit-transition: all 0.2s linear; transition: all 0.2s linear; height:auto !important;
    width: 100%; opacity:0;
    max-width: 250px;
    margin-left: 5px;
    margin-top: 5px;
    }
   #vjs-image-overlay-holder img {opacity: 0.6;
    max-width: 309px; height: auto !important;
    width: 100%;
    float: left;}
    .vjs-control-bar:hover ~ #vjs-image-overlay-holder {
         opacity:1 !important; -webkit-transition: all 0.2s linear; transition: all 0.2s linear;
    }
    .vjs-menu-button-popup .vjs-menu {width:auto !important;}
    .video-js.vjs-has-started .vjs-poster {
  display: none !important;
}
    .video-js.vjs-has-ended .vjs-poster {
  display: none !important;
}
    .vjs-paused .vjs-poster {
    display:none !important;
}
    .video-js .vjs-control-bar {
        font-size:13px;
    }
  
    .vjs-looping .vjs-loading-spinner {
  display: none;
}
    .video-js, .video-js .vjs-tech, .video-js video, .vjs-poster {border-radius: 0px !important;}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/videojs-resolution-switcher/0.4.2/videojs-resolution-switcher.min.css" />
</head>
<body>
<video id="uniqueIDx" class="video-js vjs-fluid vjs-16-9" controls preload="auto" width="640" height="264" poster="<?php echo $posterimg; ?>" data-setup='{}'>
<?php
echo $sourcesx;
?>
</video>
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.11.9/ie8/videojs-ie8.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- VIDEOJS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/5.11.9/video.min.js"></script>
    <script>
        !function(){"use strict";var e=null;e="undefined"==typeof window.videojs&&"function"==typeof require?require("video.js"):window.videojs,function(e,t){function l(e,t,l,s){return i={label:l,sources:t},"function"==typeof s?s(e,t,l):e.src(t.map(function(e){return{src:e.src,type:e.type,res:e.res}}))}var s,r={},i={},n={},o=t.getComponent("MenuItem"),a=t.extend(o,{constructor:function(e,t,l,s){this.onClickListener=l,this.label=s,o.call(this,e,t),this.src=t.src,this.on("click",this.onClick),this.on("touchstart",this.onClick),t.initialySelected&&(this.showAsLabel(),this.selected(!0),this.addClass("vjs-selected"))},showAsLabel:function(){this.label&&(this.label.innerHTML=this.options_.label)},onClick:function(e){this.onClickListener(this);var t=this.player_.currentTime(),s=this.player_.paused();this.showAsLabel(),this.addClass("vjs-selected"),s||this.player_.bigPlayButton.hide(),"function"!=typeof e&&"function"==typeof this.options_.customSourcePicker&&(e=this.options_.customSourcePicker);var r="loadeddata";"Youtube"!==this.player_.techName_&&"none"===this.player_.preload()&&"Flash"!==this.player_.techName_&&(r="timeupdate"),l(this.player_,this.src,this.options_.label,e).one(r,function(){this.player_.currentTime(t),this.player_.handleTechSeeked_(),s||this.player_.play().handleTechSeeked_(),this.player_.trigger("resolutionchange")})}}),c=t.getComponent("MenuButton"),u=t.extend(c,{constructor:function(e,l,s,r){if(this.sources=l.sources,this.label=r,this.label.innerHTML=l.initialySelectedLabel,c.call(this,e,l,s),this.controlText("Quality"),s.dynamicLabel)this.el().appendChild(r);else{var i=document.createElement("span");t.addClass(i,"vjs-resolution-button-staticlabel"),this.el().appendChild(i)}},createItems:function(){var e=[],t=this.sources&&this.sources.label||{},l=function(t){e.map(function(e){e.selected(e===t),e.removeClass("vjs-selected")})};for(var s in t)t.hasOwnProperty(s)&&(e.push(new a(this.player_,{label:s,src:t[s],initialySelected:s===this.options_.initialySelectedLabel,customSourcePicker:this.options_.customSourcePicker},l,this.label)),n[s]=e[e.length-1]);return e}});s=function(e){function s(e,t){return e.res&&t.res?+t.res-+e.res:0}function o(e){var t={label:{},res:{},type:{}};return e.map(function(e){a(t,"label",e),a(t,"res",e),a(t,"type",e),c(t,"label",e),c(t,"res",e),c(t,"type",e)}),t}function a(e,t,l){null==e[t][l[t]]&&(e[t][l[t]]=[])}function c(e,t,l){e[t][l[t]].push(l)}function h(e,t){var l=y["default"],s="";return"high"===l?(l=t[0].res,s=t[0].label):"low"!==l&&null!=l&&e.res[l]?e.res[l]&&(s=e.res[l][0].label):(l=t[t.length-1].res,s=t[t.length-1].label),{res:l,label:s,sources:e.res[l]}}function d(e){e.tech_.ytPlayer.setPlaybackQuality("default"),e.tech_.ytPlayer.addEventListener("onPlaybackQualityChange",function(){e.trigger("resolutionchange")}),e.one("play",function(){var t=e.tech_.ytPlayer.getAvailableQualityLevels(),l={highres:{res:1080,label:"1080",yt:"highres"},hd1080:{res:1080,label:"1080",yt:"hd1080"},hd720:{res:720,label:"720",yt:"hd720"},large:{res:480,label:"480",yt:"large"},medium:{res:360,label:"360",yt:"medium"},small:{res:240,label:"240",yt:"small"},tiny:{res:144,label:"144",yt:"tiny"},auto:{res:0,label:"auto",yt:"default"}},s=[];t.map(function(t){s.push({src:e.src().src,type:e.src().type,label:l[t].label,res:l[t].res,_yt:l[t].yt})}),f=o(s);var r=function(t,l,s){return e.tech_.ytPlayer.setPlaybackQuality(l[0]._yt),e},i={label:"auto",res:0,sources:f.label.auto},n=new u(e,{sources:f,initialySelectedLabel:i.label,initialySelectedRes:i.res,customSourcePicker:r},y,b);n.el().classList.add("vjs-resolution-button"),e.controlBar.resolutionSwitcher=e.controlBar.addChild(n)})}var y=t.mergeOptions(r,e),p=this,b=document.createElement("span"),f={};t.addClass(b,"vjs-resolution-button-label"),p.updateSrc=function(e){if(!e)return p.src();p.controlBar.resolutionSwitcher&&(p.controlBar.resolutionSwitcher.dispose(),delete p.controlBar.resolutionSwitcher),e=e.sort(s),f=o(e);var r=h(f,e),i=new u(p,{sources:f,initialySelectedLabel:r.label,initialySelectedRes:r.res,customSourcePicker:y.customSourcePicker},y,b);return t.addClass(i.el(),"vjs-resolution-button"),p.controlBar.resolutionSwitcher=p.controlBar.el_.insertBefore(i.el_,p.controlBar.getChild("fullscreenToggle").el_),p.controlBar.resolutionSwitcher.dispose=function(){this.parentNode.removeChild(this)},l(p,r.sources,r.label)},p.currentResolution=function(e,t){return null==e?i:(null!=n[e]&&n[e].onClick(t),p)},p.getGroupedSrc=function(){return f},p.ready(function(){p.options_.sources.length>1&&p.updateSrc(p.options_.sources),"Youtube"===p.techName_&&d(p)})},t.plugin("videoJsResolutionSwitcher",s)}(window,e)}();
      $( document ).ready(function() {
           videojs('uniqueIDx').videoJsResolutionSwitcher({default: 'high', dynamicLabel: true});
        function InitializeIFrame() {
            document.body.getcss = true;
        }
videojs('uniqueIDx', {
    controls: true,
    plugins: {
      videoJsResolutionSwitcher: {
      
      }
    }
  }, function(){
    var player = this;
    window.player = player
    player.on('resolutionchange', function(){
     player.posterImage.hide();
     player.play();
    })
      player.on('seeking', function(e) {
  if(player.currentTime() === 0) {
    player.addClass('vjs-looping');
  }
})
player.on('playing', function(e) {
  if(player.currentTime() === 0) {
    player.removeClass('vjs-looping');
  }
})
  })    
  
 $(document).ready(function(){
    $('video').bind('contextmenu',function() { return false; });
              
});
});
    </script>
</body>
</html>
