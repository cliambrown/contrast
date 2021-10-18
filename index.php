<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <title>Contrast</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700&family=Trirong:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="./dist/contrast.css" rel="stylesheet">
    <script defer src="./dist/contrast.js"></script>
</head>

<body class="bg-gray-100">
    
    <div x-data="contrast" class="max-w-2xl mx-auto">
        
        <div class="md:flex">
            
            <?php foreach (['text','bg'] as $textOrBg) { ?>
                
                <div class="flex-1 my-4 <?=($textOrBg === 'bg' ? 'md:text-right' : '');?>">
                
                    <h2 class="font-semibold text-lg"><?=($textOrBg === 'text' ? 'Text' : 'Background');?></h2>
                    
                    <div class="<?=($textOrBg === 'bg' ? 'md:flex md:flex-row-reverse md:space-x-reverse' : '');?> space-x-1">
                        <span class="inline-block w-6 h-6 align-middle rounded-full border-2 border-white" :class="{ 'no-color': !modes.hex.<?=$textOrBg;?> }" :style="{ backgroundColor: modes.hex.<?=$textOrBg;?> ? modes.hex.<?=$textOrBg;?> : 'transparent' }"></span>
                        <span x-html="modes.chroma.<?=$textOrBg;?> ? modes.chroma.<?=$textOrBg;?>.hex('rgb') : '&nbsp;'"></span>
                    </div>
                    <div x-html="modes.chroma.<?=$textOrBg;?> ? modes.chroma.<?=$textOrBg;?>.css('rgb') : '&nbsp;'"></div>
                    <div x-html="modes.chroma.<?=$textOrBg;?> ? modes.chroma.<?=$textOrBg;?>.css('hsl') : '&nbsp;'"></div>
                    
                    <div class="mt-2">
                        <input type="text" x-model="inputs.<?=$textOrBg;?>.val" class="border rounded-md w-full text-center py-1 px-2" @input="onInput('<?=$textOrBg;?>')" tabindex="<?=($textOrBg === 'text' ? '1' : '2');?>">
                        <svg x-cloak xmlns="http://www.w3.org/2000/svg" x-show="inputs.<?=$textOrBg;?>.val && !inputs.<?=$textOrBg;?>.valid" class="h-6 w-6 text-red-600" viewBox="0 0 512 512"><path d="M160 164s1.44-33 33.54-59.46C212.6 88.83 235.49 84.28 256 84c18.73-.23 35.47 2.94 45.48 7.82C318.59 100.2 352 120.6 352 164c0 45.67-29.18 66.37-62.35 89.18S248 298.36 248 324" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="40"/><circle fill="currentColor" cx="248" cy="399.99" r="32"/></svg>
                    </div>
                    
                    <div>
                        <div class="text-gray-600 mt-2 text-sm">Adjust to contrast:</div>
                        <?php foreach ([90,75,60,45,30,15] as $contrast) { ?>
                            <button type="button" class="inline-block rounded-md py-1 px-2 bg-gray-800 text-gray-100 font-semibold" @click="suggestColor('<?=$textOrBg;?>', <?=$contrast;?>)">
                                <?=$contrast;?>
                            </button>
                        <?php } ?>
                    </div>
                    
                </div>
                
                <?php if ($textOrBg === 'text') { ?>
                    
                    <div class="flex-0 my-4 text-center">
                        
                        <div class="w-28 py-2 mx-auto" :style="{ backgroundColor: modes.hex.bg ? modes.hex.bg : 'transparent' }">
                            <span :style="{ color: modes.hex.text ? modes.hex.text : 'transparent' }">Sample text</span>
                        </div>
                        
                        <div class="mt-1">
                            <div class="text-gray-600 text-sm">
                                WCAG 3
                            </div>
                            <div class="font-semibold" x-text="contrast ? contrast : '?'"></div>
                            <div class="text-sm">
                                <span x-show="absContrast === null">
                                    ?
                                </span>
                                <span x-show="absContrast !== null && absContrast < 15.0">
                                    invisible
                                </span>
                                <span x-show="absContrast >= 15.0 && absContrast < 30.0">
                                    discernible
                                </span>
                                <span x-show="absContrast >= 30.0 && absContrast < 45.0">
                                    very large text
                                </span>
                                <span x-show="absContrast >= 45.0 && absContrast < 60.0">
                                    headlines
                                </span>
                                <span x-show="absContrast >= 60.0 && absContrast < 75.0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mr-1 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    readable
                                </span>
                                <span x-show="absContrast >= 75.0 && absContrast < 90.0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mr-1 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    preferred
                                </span>
                                <span x-show="absContrast >= 90.0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    accessible
                                </span>
                            </div>
                            <div class="mt-1">
                                <a href="#info" class="inline-block rounded-md py-1 px-2 bg-gray-800 text-gray-100 font-semibold">
                                    info
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -ml-1" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 268l144 144 144-144M256 392V100"/></svg>
                                </a>
                            </div>
                        </div>
                    
                    </div>
                    
                <?php } ?>
                
            <?php } ?>
        
        </div>
        
        <?php
        $modes = [
            'rgb' => [
                'r' => '',
                'g' => '',
                'b' => ''
            ],
            'hsl' => [
                'h' => '°',
                's' => '%',
                'l' => '%'
            ],
            'lch' => [
                'l' => '%',
                'c' => '',
                'h' => '°'
            ],
        ];
        ?>
        
        <?php foreach (['text','bg'] as $textOrBg) { ?>
            
            <?php foreach ($modes as $mode => $channels) { ?>
                
                <div class="border border-gray-700 rounded-lg mb-2">
                    
                    <button class="block w-full p-2 text-left" @click="modes.<?=$mode;?>.expand.<?=$textOrBg;?> = !modes.<?=$mode;?>.expand.<?=$textOrBg;?>">
                        
                        <svg x-show="!modes.<?=$mode;?>.expand.<?=$textOrBg;?>" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 512 512"><path d="M256 64C150 64 64 150 64 256s86 192 192 192 192-86 192-192S362 64 256 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M352 216l-96 96-96-96"/></svg>
                        
                        <svg x-cloak x-show="modes.<?=$mode;?>.expand.<?=$textOrBg;?>" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M352 296l-96-96-96 96"/><path d="M256 64C150 64 64 150 64 256s86 192 192 192 192-86 192-192S362 64 256 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                        
                        <?php if ($mode === 'rgb') { ?>
                            
                            rgb(<span x-text="modes.rgb.r.<?=$textOrBg;?>.val.toFixed(0)"></span>, <span x-text="modes.rgb.g.<?=$textOrBg;?>.val.toFixed(0)"></span>, <span x-text="modes.rgb.b.<?=$textOrBg;?>.val.toFixed(0)"></span>)
                            
                        <?php } elseif ($mode === 'hsl') { ?>
                            
                            hsl(<span x-text="modes.hsl.h.<?=$textOrBg;?>.val.toFixed(0)"></span>, <span x-text="modes.hsl.s.<?=$textOrBg;?>.valPerc.toFixed(0)"></span>%, <span x-text="modes.hsl.l.<?=$textOrBg;?>.valPerc.toFixed(0)"></span>%)
                            
                        <?php } else { ?>
                            
                            lch(<span x-text="modes.lch.l.<?=$textOrBg;?>.val.toFixed(1)"></span>% <span x-text="modes.lch.c.<?=$textOrBg;?>.valPerc.toFixed(1)"></span>% <span x-text="modes.lch.h.<?=$textOrBg;?>.valPerc.toFixed(1)"></span>%)
                            
                        <?php } ?>
                        
                    </button>
                    
                    <div x-cloak x-show="modes.<?=$mode;?>.expand.<?=$textOrBg;?>">
                    
                        <?php foreach ($channels as $chan => $units) { ?>
                            <div class="my-2">
                                <div class="flex justify-between mb-1">
                                    <div>
                                        <button type="button" class="text-gray-600 font-bold px-2 py-1 mr-1" @click="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>','coarse',-1)">
                                            <?=file_get_contents('./img/chevron-double-left.svg');?>
                                        </button>
                                        <button type="button" class="text-gray-600 font-bold px-2 py-1 mr-1" @click="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>','fine',-1)">
                                            <?=file_get_contents('./img/chevron-left.svg');?>
                                        </button>
                                    </div>
                                    <div class="mx-1">
                                        <span class="inline-block w-8"><?=$chan;?> =</span>
                                        <input type="text"
                                            class="border rounded-md w-20 py-1 px-2 text-center"
                                            x-model="modes.<?=$mode;?>.<?=$chan;?>.<?=$textOrBg;?>.input"
                                            @input="onChanInput('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>')"
                                            @keydown.up.prevent="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>',($event.shiftKey ? 'coarse' : 'fine'))"
                                            @keydown.down.prevent="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>',($event.shiftKey ? 'coarse' : 'fine'), -1)"
                                            >
                                        <span class="inline-block w-8"><?=$units;?></span>
                                    </div>
                                    <div>
                                        <button type="button" class="text-gray-600 font-bold px-2 py-1 mr-1" @click="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>','fine')">
                                            <?=file_get_contents('./img/chevron-right.svg');?>
                                        </button>
                                        <button type="button" class="text-gray-600 font-bold px-2 py-1 mr-1" @click="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>','coarse')">
                                            <?=file_get_contents('./img/chevron-double-right.svg');?>
                                        </button>
                                    </div>
                                </div>
                                <div class="px-4 overflow-hidden">
                                    <div class="relative py-1" @mousedown="onSliderMousedown('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>',$event)" @wheel.prevent="onSliderWheel('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>',$event)" x-ref="slider-<?=$textOrBg;?>-<?=$mode;?>-<?=$chan;?>">
                                        <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 w-8 h-8" :style="{ left: modes.<?=$mode;?>.<?=$chan;?>.<?=$textOrBg;?>.valPerc + '%' }">
                                            <div class="w-full h-full rounded-full absolute border-2 border-white cursor-pointer" :style="{ backgroundColor: modes.hex.<?=$textOrBg;?> }"></div>
                                        </div>
                                        <div class="h-6 rounded-full my-2 border-2 border-white cursor-pointer" :style="{ background: '<?=get_slider_bg($textOrBg, $mode, $chan);?>' }"></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <?php if ($mode === 'lch') { ?>
                            
                            <div x-cloak x-show="modes.rgb.unclipped.<?=$textOrBg;?> !== null" class="text-red-600 p-2 text-center">
                                Outside of sRGB range: rgb<span x-text="modes.rgb.unclipped.<?=$textOrBg;?>"></span>
                            </div>
                            
                        <?php } ?>
                        
                    </div>
                    
                </div>
            
            <?php } ?>
            
        <?php } ?>
        
        <div id="info"></div>
        
        <div class="mt-12">
            
            <h3 class="font-semibold text-lg mb-4">Contrast</h3>
            
            <p class="mb-4">
                "WCAG 3" refers to the new algorithm currently being developed to calculate the contrast between
                two colours. The new technique is a better measure of contrast as perceived by the human visual 
                system, using "lightness" as defined by the CIELAB colour space.
            </p>
            
            <p class="mb-4">
                WCAG 3 is still in a draft version that is constantly being updated — for the most accurate and
                up-to-date calculations and to find suggested target contrast values for a given situation,
                please visit <a href="https://www.myndex.com/APCA/" class="text-blue-700 underline" target="_blank">myndex.com/APCA</a>.
                In general, a contrast of 60 is considered to be "roughly equivalent" to the WCAG 2.1 contrast
                ratio of 4.5, which is considered a rule of thumb for minimum contrast. A value of 90 is
                recommended for accessible body text.
            </p>
            
            <h3 class="font-semibold text-lg mb-4">Technical Info</h3>
            
            <p class="mb-4">
                This site was built by <a href="https://cliambrown.com/" class="text-blue-700 underline">C. Liam Brown</a>
                using 
            </p>
        
        </div>
        
    </div>

</body>

<?php

function get_slider_bg($textOrBg, $mode, $chan) {
    $bg = 'linear-gradient(to right, ';
    if ($mode === 'rgb') {
        if ($chan === 'r') {
            $bg .= "rgb(0,'+modes.rgb.g['{$textOrBg}'].val+','+modes.rgb.b['{$textOrBg}'].val+'),rgb(255,'+modes.rgb.g['{$textOrBg}'].val+','+modes.rgb.b['{$textOrBg}'].val+')";
        } elseif ($chan === 'g') {
            $bg .= "rgb('+modes.rgb.r['{$textOrBg}'].val+',0,'+modes.rgb.b['{$textOrBg}'].val+'),rgb('+modes.rgb.r['{$textOrBg}'].val+',255,'+modes.rgb.b['{$textOrBg}'].val+')";
        } elseif ($chan === 'b') {
            $bg .= "rgb('+modes.rgb.r['{$textOrBg}'].val+','+modes.rgb.g['{$textOrBg}'].val+',0),rgb('+modes.rgb.r['{$textOrBg}'].val+','+modes.rgb.g['{$textOrBg}'].val+',255)";
        }
    } elseif ($mode === 'hsl'){
        if ($chan === 'h') {
            $bg .= "hsl(0,'+modes.hsl.s['{$textOrBg}'].valPerc+'%,'+modes.hsl.l['{$textOrBg}'].valPerc+'%),hsl(60,'+modes.hsl.s['{$textOrBg}'].valPerc+'%,'+modes.hsl.l['{$textOrBg}'].valPerc+'%),hsl(120,'+modes.hsl.s['{$textOrBg}'].valPerc+'%,'+modes.hsl.l['{$textOrBg}'].valPerc+'%),hsl(180,'+modes.hsl.s['{$textOrBg}'].valPerc+'%,'+modes.hsl.l['{$textOrBg}'].valPerc+'%),hsl(240,'+modes.hsl.s['{$textOrBg}'].valPerc+'%,'+modes.hsl.l['{$textOrBg}'].valPerc+'%),hsl(300,'+modes.hsl.s['{$textOrBg}'].valPerc+'%,'+modes.hsl.l['{$textOrBg}'].valPerc+'%),hsl(360,'+modes.hsl.s['{$textOrBg}'].valPerc+'%,'+modes.hsl.l['{$textOrBg}'].valPerc+'%)";
        } elseif ($chan === 's') {
            $bg .= "hsl('+modes.hsl.h['{$textOrBg}'].val+', 0%, '+modes.hsl.l['{$textOrBg}'].valPerc+'%), hsl('+modes.hsl.h['{$textOrBg}'].val+', 100%, '+modes.hsl.l['{$textOrBg}'].valPerc+'%)";
        } elseif ($chan === 'l') {
            $bg .= "hsl('+modes.hsl.h['{$textOrBg}'].val+', '+modes.hsl.s['{$textOrBg}'].valPerc+'%, 0%), hsl('+modes.hsl.h['{$textOrBg}'].val+', '+modes.hsl.s['{$textOrBg}'].valPerc+'%, 50%), hsl('+modes.hsl.h['{$textOrBg}'].val+', '+modes.hsl.s['{$textOrBg}'].valPerc+'%, 100%)";
        }
    } elseif ($mode === 'lch') {
        $bg .= "'+modes.lch.{$chan}['{$textOrBg}'].stops+'";
    }
    $bg .= ')';
    return $bg;
}