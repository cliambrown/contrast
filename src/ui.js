// import chroma from "chroma-js";

export const initUI = () => {
    
    function parseFloatNotNaN(val) {
        let r = parseFloat(val);
        if (isNaN(r)) return 0.0;
        return r;
    }
    
    document.addEventListener('alpine:init', () => {
        Alpine.data('contrast', () => ({
            contrast: null,
            absContrast: null,
            inputs: {
                text: {
                    val: '',
                    valid: false,
                },
                bg: {
                    val: '',
                    valid: false,
                },
            },
            modes: {
                chroma: {
                    text: null,
                    bg: null,
                },
                hex: {
                    text: '',
                    bg: '',
                },
                rgb: {
                    expand: {
                        text: false,
                        bg: false
                    },
                    unclipped: {
                        text: null,
                        bg: null,
                    },
                    r: {
                        max: 255.0,
                        fine: 1.0,
                        coarse: 10.0,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                        },
                    },
                    g: {
                        max: 255.0,
                        fine: 1.0,
                        coarse: 10.0,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            valUnclipped: null
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            valUnclipped: null
                        },
                    },
                    b: {
                        max: 255.0,
                        fine: 1.0,
                        coarse: 10.0,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            valUnclipped: null
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            valUnclipped: null
                        },
                    }
                },
                hsl: {
                    expand: {
                        text: false,
                        bg: false
                    },
                    h: {
                        max: 360.0,
                        fine: 1.0,
                        coarse: 10.0,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                        },
                    },
                    s: {
                        max: 1.0,
                        fine: 0.01,
                        coarse: 0.1,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                        },
                    },
                    l: {
                        max: 1.0,
                        fine: 0.01,
                        coarse: 0.1,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                        },
                    }
                },
                lch: {
                    expand: {
                        text: false,
                        bg: false
                    },
                    l: {
                        max: 100.0,
                        fine: 1.0,
                        coarse: 10.0,
                        stopCount: 6,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            stops: '',
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            stops: '',
                        },
                    },
                    c: {
                        max: 132.0,
                        fine: 1,
                        coarse: 10,
                        stopCount: 6,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            stops: '',
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            stops: '',
                        },
                    },
                    h: {
                        max: 360.0,
                        fine: 1,
                        coarse: 10,
                        stopCount: 13,
                        text: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            stops: '',
                        },
                        bg: {
                            input: '',
                            val: 0.0,
                            valPerc: 0.0,
                            stops: '',
                        },
                    }
                },
            },
            init() {
                this.setColor('text','hex',null,'purple');
                this.setColor('bg','hex',null,'blue');
            },
            setColor(textOrBg, mode, chan, val, propagate = true, updateInput = true) {
                let color, valPerc;
                if (mode === 'hsl' || mode === 'rgb' || mode === 'lch') {
                    let max = this.modes[mode][chan].max;
                    if (isNaN(val)) val = 0.0;
                    if (val < 0.0) val = 0.0;
                    else if (val > max) val = max;
                    valPerc = 100.0 * val / max;
                }
                if (mode === 'hex') {
                    if (!chroma.valid(val)) return false;
                    color = chroma(val);
                } else if (mode === 'rgb') {
                    let vals = {
                        r: this.modes.rgb.r[textOrBg].val,
                        g: this.modes.rgb.g[textOrBg].val,
                        b: this.modes.rgb.b[textOrBg].val,
                    }
                    this.modes.rgb[chan][textOrBg].val = val;
                    this.modes.rgb[chan][textOrBg].valPerc = valPerc;
                    vals[chan] = val;
                    color = chroma(vals.r, vals.g, vals.b);
                } else if (mode === 'hsl') {
                    let vals = {
                        h: this.modes.hsl.h[textOrBg].val,
                        s: this.modes.hsl.s[textOrBg].val,
                        l: this.modes.hsl.l[textOrBg].val,
                    }
                    this.modes.hsl[chan][textOrBg].val = val;
                    this.modes.hsl[chan][textOrBg].valPerc = valPerc;
                    vals[chan] = val;
                    color = chroma(vals.h, vals.s, vals.l, 'hsl');
                } else if (mode === 'lch') {
                    let vals = {
                        l: this.modes.lch.l[textOrBg].val,
                        c: this.modes.lch.c[textOrBg].val,
                        h: this.modes.lch.h[textOrBg].val,
                    }
                    this.modes.lch[chan][textOrBg].val = val;
                    this.modes.lch[chan][textOrBg].valPerc = valPerc;
                    vals[chan] = val;
                    color = chroma(vals.l, vals.c, vals.h, 'lch');
                    let unclipped = color._rgb._unclipped;
                    let hasUnclipped = false;
                    for (let i=0; i<3; ++i) {
                        if (unclipped[i] - 255.0 > 0.049 || unclipped[i] < -0.049) {
                            hasUnclipped = true;
                            break;
                        }
                    }
                    if (hasUnclipped) {
                        this.modes.rgb.unclipped[textOrBg] = '(' + unclipped[0].toFixed(1) + ', ' + unclipped[1].toFixed(1) + ', ' + unclipped[2].toFixed(1) + ')';
                    } else {
                        this.modes.rgb.unclipped[textOrBg] = null;
                    }
                    ['l','c','h'].forEach(thisChan => {
                        if (chan !== thisChan) {
                            let stops = [];
                            let tempVals = {
                                l: vals.l,
                                c: vals.c,
                                h: vals.h
                            }
                            let stopCount = this.modes.lch[thisChan].stopCount;
                            let step = this.modes.lch[thisChan].max / (stopCount - 1);
                            for (let i=0; i<stopCount; ++i) {
                                tempVals[thisChan] = 0.0 + (i * step);
                                stops.push(chroma(tempVals.l, tempVals.c, tempVals.h, 'lch').css());
                            }
                            this.modes.lch[thisChan][textOrBg].stops = stops.join(',');
                        }
                    });
                }
                if (chan && updateInput) {
                    let inputVal = val;
                    if (mode === 'hsl' && (chan !== 'h')) {
                        inputVal *= 100.0;
                    }
                    this.modes[mode][chan][textOrBg].input = inputVal.toFixed(1);
                }
                if (propagate) {
                    this.modes.chroma[textOrBg] = color;
                    this.modes.hex[textOrBg] = color.hex('rgb');
                    if (this.modes.chroma.text && this.modes.chroma.bg) {
                        let contrast = getChromaContrast3(this.modes.chroma.text, this.modes.chroma.bg).toFixed(1);
                        this.contrast = contrast;
                        this.absContrast = Math.abs(contrast);
                    } else {
                        this.contrast = null;
                        this.absContrast = null;
                    }
                    if (mode !== 'hex' || updateInput) {
                        this.inputs[textOrBg].val = color.hex('rgb');
                        this.inputs[textOrBg].valid = true;
                    }
                    if (mode !== 'rgb') {
                        let rgb = color.rgb();
                        ['r','g','b'].forEach((thisChan, index) => {
                            this.setColor(textOrBg,'rgb',thisChan,rgb[index],false,true);
                        });
                    }
                    if (mode !== 'hsl') {
                        let hsl = color.hsl();
                        ['h','s','l'].forEach((thisChan, index) => {
                            this.setColor(textOrBg,'hsl',thisChan,hsl[index],false,true);
                        });
                    }
                    if (mode !== 'lch') {
                        let lch = color.lch();
                        ['l','c','h'].forEach((thisChan, index) => {
                            this.setColor(textOrBg,'lch',thisChan,lch[index],false,true);
                        });
                    }
                }
            },
            onInput(textOrBg) {
                let input = this.inputs[textOrBg].val.toString().trim();
                if (chroma.valid(input)) {
                    this.onValidInput(textOrBg, chroma(input));
                    return true;
                }
                let regex = {
                    rgbPerc: /^s?rgba?\(\s*([0-9\.\-]+)\%(,|\s)\s*([0-9\.\-]+)\%(,|\s)\s*([0-9\.\-]+)\%((,|\s)\s*[0-9\.]+\%?)?\s*\);?$/i,
                    rgb: /^s?rgba?\(\s*([0-9\.\-]+)(,|\s)\s*([0-9\.\-]+)(,|\s)\s*([0-9\.\-]+)((,|\s)\s*[0-9\.]+\%?)?\);?$/i,
                    hslPerc: /^hsla?\(\s*([0-9\.\-]+)°?(,|\s)\s*([0-9\.\-]+)\%(,|\s)\s*([0-9\.\-]+)\%((,|\s)\s*[0-9\.]+\%?)?\s*\);?$/i,
                    hsl: /^hsla?\(\s*([0-9\.]+)°?(,|\s)\s*([0-9\.]+)(,|\s)\s*([0-9\.]+)((,|\s)\s*[0-9\.]+\%?)?\s*\);?$/i,
                    lch: /^lch\(\s*([0-9\.]+)\%\s+([0-9\.]+)\s+([0-9\.]+)(\s+\/\s+[0-9\.]+)?\s*\);?$/i,
                    lab: /^lab\(\s*([0-9\.]+)\%\s+([0-9\.]+)\s+([0-9\.]+)(\s+\/\s+[0-9\.]+)?\s*\)\s*;?$/i,
                };
                let matches;
                matches = input.match(regex.rgbPerc);
                if (matches !== null) {
                    let r = parseFloatNotNaN(matches[1]) * 255.0 / 100.0;
                    let g = parseFloatNotNaN(matches[3]) * 255.0 / 100.0;
                    let b = parseFloatNotNaN(matches[5]) * 255.0 / 100.0;
                    this.onValidInput(textOrBg, chroma(r, g, b));
                    return true;
                }
                matches = input.match(regex.rgb);
                if (matches !== null) {
                    let r = parseFloatNotNaN(matches[1]);
                    let g = parseFloatNotNaN(matches[3]);
                    let b = parseFloatNotNaN(matches[5]);
                    this.onValidInput(textOrBg, chroma(r, g, b));
                    return true;
                }
                matches = input.match(regex.hslPerc);
                if (matches !== null) {
                    let h = parseFloatNotNaN(matches[1]);
                    let s = parseFloatNotNaN(matches[3]) / 100.0;
                    let l = parseFloatNotNaN(matches[5]) / 100.0;
                    this.onValidInput(textOrBg, chroma(h, s, l, 'hsl'));
                    return true;
                }
                matches = input.match(regex.hsl);
                if (matches !== null) {
                    let h = parseFloatNotNaN(matches[1]);
                    let s = parseFloatNotNaN(matches[3]);
                    let l = parseFloatNotNaN(matches[5]);
                    this.onValidInput(textOrBg, chroma(h, s, l, 'hsl'));
                    return true;
                }
                matches = input.match(regex.lch);
                if (matches !== null) {
                    let l = parseFloatNotNaN(matches[1]);
                    let c = parseFloatNotNaN(matches[2]);
                    let h = parseFloatNotNaN(matches[3]);
                    this.setColor(textOrBg, 'hex', null, chroma(l, c, h, 'lch').hex('rgb'), true, false);
                    this.setColor(textOrBg, 'lch', 'l', l, false);
                    this.setColor(textOrBg, 'lch', 'c', c, false);
                    this.setColor(textOrBg, 'lch', 'h', h, false);
                    this.inputs[textOrBg].valid = true;
                    return true;
                }
                matches = input.match(regex.lab);
                if (matches !== null) {
                    let l = parseFloatNotNaN(matches[1]);
                    let a = parseFloatNotNaN(matches[2]);
                    let b = parseFloatNotNaN(matches[3]);
                    this.onValidInput(textOrBg, chroma(l, a, b, 'lab'));
                    return true;
                }
                this.inputs[textOrBg].valid = false;
            },
            onValidInput(textOrBg, chroma) {
                this.setColor(textOrBg, 'hex', null, chroma.hex('rgb'), true, false);
                this.inputs[textOrBg].valid = true;
            },
            onSliderMousedown(textOrBg, mode, chan, e) {
                let sliderEl = this.$refs['slider-'+textOrBg+'-'+mode+'-'+chan];
                this.onSliderMouseMove(textOrBg, mode, chan, sliderEl, e);
                let callback = this.onSliderMouseMove.bind(this, textOrBg, mode, chan, sliderEl);
                document.addEventListener('mousemove', callback, true);
                document.addEventListener('mouseup', () => {
                    document.removeEventListener('mousemove', callback, true);
                });
            },
            onSliderMouseMove(textOrBg, mode, chan, sliderEl, e) {
                let mouseX = e.pageX;
                let sliderRect = sliderEl.getBoundingClientRect();
                let x = (mouseX - sliderRect.left) / (sliderRect.right - sliderRect.left);
                let val = x * this.modes[mode][chan].max;
                this.setColor(textOrBg, mode, chan, val);
            },
            onChanInput(textOrBg, mode, chan) {
                let val = this.modes[mode][chan][textOrBg].input;
                val = parseFloat(val.replace(/[^\d\.]/g, ''));
                if (isNaN(val)) val = 0.0;
                if (mode === 'hsl' && (chan !== 'h')) {
                    val = val / 100.0;
                }
                this.setColor(textOrBg, mode, chan, val, true, false);
            },
            adjustChan(textOrBg, mode, chan, coarseOrFine, factor = 1) {
                let adjustBy = factor * this.modes[mode][chan][coarseOrFine];
                let val = this.modes[mode][chan][textOrBg].val + adjustBy;
                this.setColor(textOrBg, mode, chan, val);
            },
            onSliderWheel(textOrBg, mode, chan, e) {
                const factor = -1 * Math.sign(e.deltaY);
                this.adjustChan(textOrBg, mode, chan, 'fine', factor);
            },
            suggestColor(textOrBg, targetContrast) {
                if (!this.modes.chroma.text || !this.modes.chroma.bg) {
                    return false;
                }
                targetContrast = parseFloat(targetContrast);
                let contrast = this.contrast;
                // If contrast is initially higher than target, go in other direction
                let initGT = (Math.abs(contrast) > targetContrast);
                let toAdd = this.modes.hsl.l.fine;
                if ((contrast >= 0.0 && textOrBg === 'text') || (contrast < 0.0 && textOrBg === 'bg')) {
                    toAdd *= -1.0;
                }
                if (initGT) {
                    toAdd *= -1.0;
                }
                let results = this.suggestColorLoop(textOrBg, targetContrast, toAdd, initGT);
                if (!this.reachedTarget(results.contrast, targetContrast, initGT)) {
                    results = this.suggestColorLoop(textOrBg, targetContrast, (-1.0 * toAdd), initGT);
                }
                if (this.reachedTarget(results.contrast, targetContrast, initGT)) {
                    this.setColor(textOrBg, 'hsl', 'l', results.hsl[textOrBg].l);
                } else {
                    console.log('Could not find color');
                }
            },
            reachedTarget(contrast, targetContrast, initGT) {
                if (initGT) {
                    return Math.abs(contrast) <= targetContrast;
                }
                return Math.abs(contrast) >= targetContrast;
            },
            suggestColorLoop(textOrBg, targetContrast, toAdd, initGT) {
                let contrast = this.contrast;
                var hsl = {
                    text: {
                        h: this.modes.hsl.h.text.val,
                        s: this.modes.hsl.s.text.val,
                        l: this.modes.hsl.l.text.val
                    },
                    bg: {
                        h: this.modes.hsl.h.bg.val,
                        s: this.modes.hsl.s.bg.val,
                        l: this.modes.hsl.l.bg.val
                    },
                };
                let oldL, newL, textChroma, bgChroma;
                let reachedTarget = this.reachedTarget(contrast, targetContrast, initGT);
                while (!reachedTarget) {
                    oldL = hsl[textOrBg].l;
                    newL = oldL + toAdd;
                    if (newL < 0.0 || newL > this.modes.hsl.l.max) break;
                    hsl[textOrBg].l = newL;
                    textChroma = chroma(hsl.text.h, hsl.text.s, hsl.text.l, 'hsl');
                    bgChroma = chroma(hsl.bg.h, hsl.bg.s, hsl.bg.l, 'hsl');
                    contrast = getChromaContrast3(textChroma, bgChroma);
                    reachedTarget = this.reachedTarget(contrast, targetContrast, initGT);
                }
                return {
                    hsl: hsl,
                    contrast: contrast
                };
            },
        }));
    });
}