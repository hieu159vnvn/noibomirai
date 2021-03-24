<div class="container-fix slide">
            <script type="text/javascript">
                var jssor_1_slider_init = function() {

                    var _SlideshowTransitions = [
                        {$Duration:1500,x:-1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Opacity:2,$Assembly:260,$Round:{$Top:1.5}},
                        {$Duration:1500,x:0.2,y:-0.1,$Delay:80,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$Linear},$Opacity:2,$Round:{$Left:0.8,$Top:2.5}},
                        {$Duration:800,x:0.25,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:800,x:-0.1,y:-0.7,$Rotate:0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}},
                        {$Duration:1200,y:-4,$Zoom:11,$Rotate:1,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}},
                        {$Duration:1000,x:1,$Easing:$Jease$.$InBounce,$Opacity:2} ];

                    var jssor_1_options = {
                      $AutoPlay: 1,
                      $SlideDuration: 500,
                      $SlideEasing: $Jease$.$OutQuint,
                      $SlideshowOptions: {
                        $Class: $JssorSlideshowRunner$,
                        $Transitions: _SlideshowTransitions,
                        $TransitionsOrder: 1,
                        $ShowLink: true
                      },
                      $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$
                      },
                      $BulletNavigatorOptions: {
                        $Class: $JssorBulletNavigator$
                      }
                    };

                    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

                    /*#region responsive code begin*/

                    var MAX_WIDTH = 3000;

                    function ScaleSlider() {
                        var containerElement = jssor_1_slider.$Elmt.parentNode;
                        var containerWidth = containerElement.clientWidth;

                        if (containerWidth) {

                            var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                            jssor_1_slider.$ScaleWidth(expectedWidth);
                        }
                        else {
                            window.setTimeout(ScaleSlider, 30);
                        }
                    }

                    ScaleSlider();

                    $Jssor$.$AddEvent(window, "load", ScaleSlider);
                    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
                    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
                    /*#endregion responsive code end*/
                };
            </script>
            <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=latin-ext,greek-ext,cyrillic-ext,greek,vietnamese,latin,cyrillic" rel="stylesheet" type="text/css" />
            <style>
                /*jssor slider loading skin spin css*/
                .jssorl-009-spin img {
                    animation-name: jssorl-009-spin;
                    animation-duration: 1.6s;
                    animation-iteration-count: infinite;
                    animation-timing-function: linear;
                }

                @keyframes jssorl-009-spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }

                /*jssor slider bullet skin 032 css*/
                .jssorb032 {position:absolute;}
                .jssorb032 .i {position:absolute;cursor:pointer;}
                .jssorb032 .i .b {fill:#fff;fill-opacity:0.7;stroke:#000;stroke-width:1200;stroke-miterlimit:10;stroke-opacity:0.25;}
                .jssorb032 .i:hover .b {fill:#000;fill-opacity:.6;stroke:#fff;stroke-opacity:.35;}
                .jssorb032 .iav .b {fill:#000;fill-opacity:1;stroke:#fff;stroke-opacity:.35;}
                .jssorb032 .i.idn {opacity:.3;}

                /*jssor slider arrow skin 051 css*/
                .jssora051 {display:block;position:absolute;cursor:pointer;}
                .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
                .jssora051:hover {opacity:.8;}
                .jssora051.jssora051dn {opacity:.5;}
                .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
            </style>
            <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:600px;overflow:hidden;visibility:hidden;">
                <!-- Loading Screen -->
                <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:600px;overflow:hidden;">

                          {{-- <div class="item">
                                  <div data-p="225.00">
                                          <iframe width="100%" height="600px" src="https://www.youtube.com/embed/WrSXTdAWHf0?enablejsapi=1&version=3&rel=0&modestbranding=1&showinfo=0&loop=1&autoplay=1&controls=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                  </div>
                            
                          </div> --}}
                           @foreach($slide as $sl)
                                  <div class="item">
                                              <picture>
                                                <source media="(max-width: 500px)" srcset="{{str_replace('/source/','/thumbs/',$sl)}}">
                                                <div data-p="225.00">
                                                        <img style="height:600px !important;" data-u="image" src="{{$sl}}" />
                                                </div>
                                              </picture>
                                    <div class="carousel-caption">
                                    </div>
                                  </div>
                           @endforeach

                        
                </div>
                <!-- Bullet Navigator -->
                <div data-u="navigator" class="jssorb032" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                    <div data-u="prototype" class="i" style="width:16px;height:16px;">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                        </svg>
                    </div>
                </div>
                <!-- Arrow Navigator -->
                <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                    </svg>
                </div>
                <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                    </svg>
                </div>
            </div>
            <script type="text/javascript">jssor_1_slider_init();</script>
  </div>