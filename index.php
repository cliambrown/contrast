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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="./dist/contrast.css" rel="stylesheet">
    <script defer src="./dist/contrast.js?v=0.3"></script>
</head>

<body class="bg-gray-50">
    
    <div x-data="contrast" class="max-w-2xl mx-auto px-2">
        
        <h1 class="text-xl md:text-2xl mt-6 md:mt-8 mb-4 text-center">Colour Contrast Tool</h1>
        
        <div class="md:flex">
            
            <?php foreach (['text','bg'] as $textOrBg) { ?>
                
                <div class="flex-grow my-4 text-center md:text-left <?=($textOrBg === 'bg' ? 'md:text-right md:order-3' : 'md:order-1');?>">
                
                    <h2 class="font-semibold text-lg mb-1"><?=($textOrBg === 'text' ? 'Text' : 'Background');?></h2>
                    
                    <div>
                        <button class="flex-block text-left relative space-x-1 <?=($textOrBg === 'bg' ? 'md:flex-row-reverse md:space-x-reverse' : '');?>" @click="onCopyClick((modes.hex.<?=$textOrBg;?> ? modes.hex.<?=$textOrBg;?> : ''), 'copied-<?=$textOrBg;?>-hex')" title="click to copy">
                            <span class="inline-block w-6 h-6 align-bottom rounded-full border-2 border-white" :class="{ 'no-color': !modes.hex.<?=$textOrBg;?> }" :style="{ backgroundColor: modes.hex.<?=$textOrBg;?> ? modes.hex.<?=$textOrBg;?> : 'transparent' }"></span>
                            <span x-html="modes.chroma.<?=$textOrBg;?> ? modes.chroma.<?=$textOrBg;?>.hex('rgb') : '&nbsp;'"></span>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 pb-1 hidden copied" x-ref="copied-<?=$textOrBg;?>-hex">
                                <div class="bg-green-800 rounded-md p-1 arrow-down">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" alt="copied">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="mt-1">
                        <button class="relative" @click="onCopyClick((modes.chroma.<?=$textOrBg;?> ? modes.chroma.<?=$textOrBg;?>.css('rgb') : ''), 'copied-<?=$textOrBg;?>-rgb')" title="click to copy">
                            <span x-html="modes.chroma.<?=$textOrBg;?> ? modes.chroma.<?=$textOrBg;?>.css('rgb') : '&nbsp;'"></span>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 pb-1 hidden copied" x-ref="copied-<?=$textOrBg;?>-rgb">
                                <div class="bg-green-800 rounded-md p-1 arrow-down">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" alt="copied">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="mt-1">
                        <button class="relative" @click="onCopyClick((modes.chroma.<?=$textOrBg;?> ? modes.chroma.<?=$textOrBg;?>.css('hsl') : ''), 'copied-<?=$textOrBg;?>-hsl')" title="click to copy">
                            <span x-html="modes.chroma.<?=$textOrBg;?> ? modes.chroma.<?=$textOrBg;?>.css('hsl') : '&nbsp;'"></span>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 pb-1 hidden copied" x-ref="copied-<?=$textOrBg;?>-hsl">
                                <div class="bg-green-800 rounded-md p-1 arrow-down">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" alt="copied">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                    
                    <div class="mt-2 flex justify-center md:justify-start items-center <?=($textOrBg === 'bg' ? 'md:flex-row-reverse' : '');?>">
                        <div class="w-6 md:hidden"></div>
                        <div class="">
                            <input type="text" x-model="inputs.<?=$textOrBg;?>.val" class="border rounded-md text-center py-1 px-2 w-56" @input="onInput('<?=$textOrBg;?>')" tabindex="<?=($textOrBg === 'text' ? '1' : '2');?>">
                        </div>
                        <div class="w-6">
                            <svg x-cloak xmlns="http://www.w3.org/2000/svg" x-show="inputs.<?=$textOrBg;?>.val && !inputs.<?=$textOrBg;?>.valid" class="h-6 w-6 text-red-600 align-middle" viewBox="0 0 512 512"><path d="M160 164s1.44-33 33.54-59.46C212.6 88.83 235.49 84.28 256 84c18.73-.23 35.47 2.94 45.48 7.82C318.59 100.2 352 120.6 352 164c0 45.67-29.18 66.37-62.35 89.18S248 298.36 248 324" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="40"/><circle fill="currentColor" cx="248" cy="399.99" r="32"/></svg>
                        </div>
                    </div>
                    
                    <div>
                        <div class="mt-2 mb-1 text-sm">
                            <span class="text-gray-600" x-show="!targetContrastNotFound.<?=$textOrBg;?>">Adjust to contrast:</span>
                            <span x-cloak class="text-red-700" x-show="targetContrastNotFound.<?=$textOrBg;?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 align-bottom relative bottom-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Colour not found for contrast = <span x-text="targetContrast"></span>
                            </span>
                        </div>
                        <?php foreach ([90,75,60,45,30,15] as $contrast) { ?>
                            <button type="button" class="inline-block rounded-md py-1 px-2 bg-gray-700 text-gray-100 font-semibold" @click="suggestColor('<?=$textOrBg;?>', <?=$contrast;?>)">
                                <?=$contrast;?>
                            </button>
                        <?php } ?>
                    </div>
                    
                </div>
                
            <?php } ?>
            
            <div class="flex-shrink my-4 text-center max-w-xs mx-auto md:order-2">
                        
                <div class="py-2 mx-auto whitespace-nowrap px-2 max-w-full" :style="{ backgroundColor: modes.hex.bg ? modes.hex.bg : 'transparent' }">
                    <span :style="{ color: modes.hex.text ? modes.hex.text : 'transparent' }">Sample text</span>
                </div>
                
                <div class="mt-1">
                    <div class="text-gray-600 text-sm inline md:block">
                        Contrast<span class="md:hidden">:</span>
                    </div>
                    <div class="font-semibold inline md:block" x-text="contrast ? contrast : '?'"></div>
                    <div class="text-sm">
                        <span x-show="absContrast === null">
                            ?
                        </span>
                        <span x-cloak x-show="absContrast !== null && absContrast < 15.0">
                            invisible
                        </span>
                        <span x-cloak x-show="absContrast >= 15.0 && absContrast < 30.0">
                            discernible
                        </span>
                        <span x-cloak x-show="absContrast >= 30.0 && absContrast < 45.0">
                            large text
                        </span>
                        <span x-cloak x-show="absContrast >= 45.0 && absContrast < 60.0">
                            headlines
                        </span>
                        <span x-cloak x-show="absContrast >= 60.0 && absContrast < 75.0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mr-1 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            readable
                        </span>
                        <span x-cloak x-show="absContrast >= 75.0 && absContrast < 90.0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mr-1 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            preferred
                        </span>
                        <span x-cloak x-show="absContrast >= 90.0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            accessible
                        </span>
                    </div>
                </div>
                
                <button type="button" class="inline-block rounded-md py-1 px-2 text-gray-700 bg-gray-200 font-semibold mt-4" @click="switchColors()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 relative bottom-[1px] md:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 relative bottom-[1px] hidden md:inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Switch
                </button>
            
            </div>
        
        </div>
        
        <?php
        $modes = [
            'hsl' => [
                'h' => '°',
                's' => '%',
                'l' => '%'
            ],
            'rgb' => [
                'r' => '',
                'g' => '',
                'b' => ''
            ],
            'lch' => [
                'l' => '%',
                'c' => '',
                'h' => '°'
            ],
        ];
        ?>
        
        <div class="text-center my-2">
            <button type="button" class="rounded-md px-2 py-1 font-semibold md:w-40 border-2" :class="{ 'bg-gray-700 text-gray-100 border-transparent': view === 'text', 'border-gray-200': view !== 'text' }" @click="view = 'text'">
                Text
            </button>
            <button type="button" class="rounded-md px-2 py-1 font-semibold md:w-40 border-2" :class="{ 'bg-gray-700 text-gray-100 border-transparent': view === 'bg', 'border-gray-200': view !== 'bg' }" @click="view = 'bg'">
                Background
            </button>
        </div>
        
        <?php foreach (['text','bg'] as $textOrBg) { ?>
            
            <?php foreach ($modes as $mode => $channels) { ?>
                
                <div <?=($textOrBg === 'bg' ? 'x-cloak' : '');?> x-show="view === '<?=$textOrBg;?>'" class="bg-gray-200 rounded-lg mb-2">
                    
                    <button class="block w-full p-2 text-left" @click="modes.<?=$mode;?>.expand.<?=$textOrBg;?> = !modes.<?=$mode;?>.expand.<?=$textOrBg;?>">
                        
                        <svg x-show="!modes.<?=$mode;?>.expand.<?=$textOrBg;?>" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 align-bottom" viewBox="0 0 512 512"><path d="M256 64C150 64 64 150 64 256s86 192 192 192 192-86 192-192S362 64 256 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M352 216l-96 96-96-96"/></svg>
                        
                        <svg x-cloak x-show="modes.<?=$mode;?>.expand.<?=$textOrBg;?>" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 align-bottom" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M352 296l-96-96-96 96"/><path d="M256 64C150 64 64 150 64 256s86 192 192 192 192-86 192-192S362 64 256 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/></svg>
                        
                        <?php if ($mode === 'rgb') { ?>
                            
                            <span class="font-semibold">RGB</span> (<span x-text="modes.rgb.r.<?=$textOrBg;?>.val.toFixed(0)"></span>, <span x-text="modes.rgb.g.<?=$textOrBg;?>.val.toFixed(0)"></span>, <span x-text="modes.rgb.b.<?=$textOrBg;?>.val.toFixed(0)"></span>)
                            
                        <?php } elseif ($mode === 'hsl') { ?>
                            
                            <span class="font-semibold">HSL</span> (<span x-text="modes.hsl.h.<?=$textOrBg;?>.val.toFixed(0)"></span>, <span x-text="modes.hsl.s.<?=$textOrBg;?>.valPerc.toFixed(0)"></span>%, <span x-text="modes.hsl.l.<?=$textOrBg;?>.valPerc.toFixed(0)"></span>%)
                            
                        <?php } else { ?>
                            
                            <span class="font-semibold">LCh</span> (<span x-text="modes.lch.l.<?=$textOrBg;?>.val.toFixed(1)"></span>% <span x-text="modes.lch.c.<?=$textOrBg;?>.valPerc.toFixed(1)"></span>% <span x-text="modes.lch.h.<?=$textOrBg;?>.valPerc.toFixed(1)"></span>%)
                            
                        <?php } ?>
                        
                    </button>
                    
                    <div x-cloak x-show="modes.<?=$mode;?>.expand.<?=$textOrBg;?>">
                    
                        <?php foreach ($channels as $chan => $units) { ?>
                            <div class="my-2">
                                <div class="flex justify-between mb-1">
                                    <div>
                                        <button type="button" class="text-gray-600 font-bold px-1 sm:px-2 py-1 mr-1" @click="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>','coarse',-1)">
                                            <?=file_get_contents('./img/chevron-double-left.svg');?>
                                        </button>
                                        <button type="button" class="text-gray-600 font-bold px-1 sm:px-2 py-1 mr-1" @click="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>','fine',-1)">
                                            <?=file_get_contents('./img/chevron-left.svg');?>
                                        </button>
                                    </div>
                                    <div class="mx-1">
                                        <span class="inline-block w-8"><span class="font-semibold"><?=strtoupper($chan);?></span> =</span>
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
                                        <button type="button" class="text-gray-600 font-bold px-1 sm:px-2 py-1 mr-1" @click="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>','fine')">
                                            <?=file_get_contents('./img/chevron-right.svg');?>
                                        </button>
                                        <button type="button" class="text-gray-600 font-bold px-1 sm:px-2 py-1 mr-1" @click="adjustChan('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>','coarse')">
                                            <?=file_get_contents('./img/chevron-double-right.svg');?>
                                        </button>
                                    </div>
                                </div>
                                <div class="px-4 overflow-hidden">
                                    <div class="relative py-1"
                                        @mousedown="onSliderMousedown('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>',$event)"
                                        @wheel.prevent="onSliderWheel('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>',$event)"
                                        @touchstart.prevent="onSliderMousedown('<?=$textOrBg;?>','<?=$mode;?>','<?=$chan;?>',$event, true)"
                                        x-ref="slider-<?=$textOrBg;?>-<?=$mode;?>-<?=$chan;?>"
                                        >
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
        
        <div class="mt-12 pb-32">
            
            <div class="text-center mb-4 text-gray-600">
                <div class="block sm:inline-block">
                    made by <a href="https://cliambrown.com/" class="text-blue-700 underline">C. Liam Brown</a>
                </div>
                <span class="hidden sm:inline mx-2">—</span>
                <div class="block sm:inline-block mt-2 sm:mt-0">
                    <a href="https://github.com/cliambrown/contrast" class="text-blue-700 underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 512 512"><path d="M256 32C132.3 32 32 134.9 32 261.7c0 101.5 64.2 187.5 153.2 217.9a17.56 17.56 0 003.8.4c8.3 0 11.5-6.1 11.5-11.4 0-5.5-.2-19.9-.3-39.1a102.4 102.4 0 01-22.6 2.7c-43.1 0-52.9-33.5-52.9-33.5-10.2-26.5-24.9-33.6-24.9-33.6-19.5-13.7-.1-14.1 1.4-14.1h.1c22.5 2 34.3 23.8 34.3 23.8 11.2 19.6 26.2 25.1 39.6 25.1a63 63 0 0025.6-6c2-14.8 7.8-24.9 14.2-30.7-49.7-5.8-102-25.5-102-113.5 0-25.1 8.7-45.6 23-61.6-2.3-5.8-10-29.2 2.2-60.8a18.64 18.64 0 015-.5c8.1 0 26.4 3.1 56.6 24.1a208.21 208.21 0 01112.2 0c30.2-21 48.5-24.1 56.6-24.1a18.64 18.64 0 015 .5c12.2 31.6 4.5 55 2.2 60.8 14.3 16.1 23 36.6 23 61.6 0 88.2-52.4 107.6-102.3 113.3 8 7.1 15.2 21.1 15.2 42.5 0 30.7-.3 55.5-.3 63 0 5.4 3.1 11.5 11.4 11.5a19.35 19.35 0 004-.4C415.9 449.2 480 363.1 480 261.7 480 134.9 379.7 32 256 32z"/></svg>
                        Source Code
                    </a>
                </div>
            </div>
            
            <h3 class="font-semibold text-lg mt-6 mb-4">Usage Notes</h3>
            
            <p class="mb-2">
                The hex code inputs will accept:
            </p>
            
            <ul class="list-disc ml-8 mb-4">
                <li>hex codes (3 or 6 characters, with or without "#")</li>
                <li>CSS names (e.g. "purple" or "cornflowerblue")</li>
                <li>RGB / sRGB / rgba() codes</li>
                <li>HSL / hsla() codes</li>
                <li>CSS Color 4 lch() or lab() codes</li>
            </ul>
            
            <p class="mb-4">
                Note that <span class="font-semibold">opacity values are discarded</span>.
            </p>
            
            <p class="mb-4">
                The channel sliders can be controlled by clicking, dragging, or scrolling the mouse wheel. With text
                inputs selected, you can also adjust the values using your keyboard's arrow keys (hold shift
                to change by larger amounts).
            </p>
            
            <p class="mb-4">
                Click on the colour code descriptions to copy them to your clipboard.
            </p>
            
            <h3 class="font-semibold text-lg mt-6 mb-4">Contrast</h3>
            
            <p class="mb-4">
                Contrast is calculated using the new WCAG 3 algorithm currently being developed. This new technique
                (which uses "lightness" as defined by the CIELAB colour space) is an improvement over the WCAG 2.1
                ratio, because it is a better measure of contrast as perceived by the human visual system.
            </p>
            
            <p class="mb-4">
                WCAG 3 is still in a draft version that is constantly being updated — for the most accurate and
                up-to-date calculations and to find suggested target contrast values for a given situation,
                please visit <a href="https://www.myndex.com/APCA/" class="text-blue-700 underline" target="_blank">myndex.com/APCA</a>.
                In general, a contrast of 60 is considered to be "roughly equivalent" to the WCAG 2.1 contrast
                ratio of 4.5, which is considered a rule of thumb for minimum contrast. A value of 90 is
                recommended for accessible body text.
            </p>
            
            <h3 class="font-semibold text-lg mt-6 mb-4">Technical Info</h3>
            
            <p class="mb-2">
                This was built by <a href="https://cliambrown.com/" class="text-blue-700 underline">C. Liam Brown</a>
                using:
            </p>
            
            <ul class="list-disc ml-8 mb-4">
                <li><a class="text-blue-700 underline" href="https://gka.github.io/chroma.js/" title="chroma.js" target="_blank">chroma.js</a></li>
                <li><a class="text-blue-700 underline" href="https://alpinejs.dev/" title="Alpine.js" target="_blank">Alpine.js</a></li>
                <li><a class="text-blue-700 underline" href="https://tailwindcss.com/" title="Tailwind CSS" target="_blank">Tailwind CSS</a></li>
                <li><a class="text-blue-700 underline" href="https://ionic.io/ionicons" title="Ionicons" target="_blank">Ionicons</a></li>
                <li><a class="text-blue-700 underline" href="https://heroicons.com/" title="Heroicons" target="_blank">Heroicons</a></li>
                <li><a class="text-blue-700 underline" href="https://github.com/sindresorhus/copy-text-to-clipboard" title="copy-text-to-clipboard" target="_blank">copy-text-to-clipboard</a></li>
            </ul>
            
            <p class="mb-2">
                It was inspired by:
            </p>
            
            <ul class="list-disc ml-8">
                <li><a class="text-blue-700 underline" href="https://css.land/lch/" title="LCH Colour Picker" target="_blank">LCH Colour Picker</a></li>
                <li><a class="text-blue-700 underline" href="https://www.myndex.com/APCA/" title="Myndex Technologies - APCA Contrast Calculator" target="_blank">Myndex Technologies - APCA Contrast Calculator</a></li>
                <li><a class="text-blue-700 underline" href="https://accessiblepalette.com/" title="Accessible Palette" target="_blank">Accessible Palette</a></li>
            </ul>
        
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