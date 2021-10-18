export const acpa = () => {
    
    const mainTRC = 2.4; // 2.4 exponent emulates actual monitor perception
    const sRco = 0.2126729,
        sGco = 0.7151522,
        sBco = 0.0721750; // sRGB coefficients
    const normBG = 0.56,
        normTXT = 0.57,
        revTXT = 0.62,
        revBG = 0.65;  // G-4g constants for use with 2.4 exponent
    const blkThrs = 0.022,
        blkClmp = 1.414,
        scaleBoW = 1.14,
        scaleWoB = 1.14,
        loBoWthresh = 0.035991,
        loWoBthresh = 0.035991,
        loBoWfactor = 27.7847239587675,
        loWoBfactor = 27.7847239587675,
        loBoWoffset = 0.027,
        loWoBoffset = 0.027,
        loClip = 0.001,
        deltaYmin = 0.0005;

    window.rgbExp = (val) => {
        return Math.pow(val / 255.0, mainTRC);
    };
    
    window.rgbToY = (r, g, b) => {
        return (sRco * rgbExp(r)) + (sGco * rgbExp(g)) + (sBco * rgbExp(b));
    };
    
    window.blackSoftClamp = (y) => {
        if (y > blkThrs) return y;
        return y + Math.pow(blkThrs - y, blkClmp);
    };
    
    window.getChromaContrast3 = (textChroma, bgChroma) => {
        let textY = rgbToY(textChroma.get('rgb.r'), textChroma.get('rgb.g'), textChroma.get('rgb.b'));
        let bgY = rgbToY(bgChroma.get('rgb.r'), bgChroma.get('rgb.g'), bgChroma.get('rgb.b'));
        return getContrast3(textY, bgY);
    };
    
    window.getContrast3 = (textY, bgY) => {
        var SAPC = 0.0;
        var outputContrast = 0.0;
        textY = blackSoftClamp(textY);
        bgY = blackSoftClamp(bgY);
        // Return 0 Early for extremely low ∆Y
        if (Math.abs(bgY - textY) < deltaYmin) {
            return 0.0;
        }
        if (bgY > textY) {
            // Dark text on a light background
            SAPC = (Math.pow(bgY, normBG) - Math.pow(textY, normTXT)) * scaleBoW;
            outputContrast = (SAPC < loClip) ? 0.0 :
                (SAPC < loBoWthresh) ?
                    SAPC - SAPC * loBoWfactor * loBoWoffset :
                    SAPC - loBoWoffset;
        } else {
            // Light text on a dark background
            SAPC = (Math.pow(bgY, revBG) - Math.pow(textY, revTXT)) * scaleWoB;
            outputContrast = (SAPC > -loClip) ? 0.0 :
                (SAPC > -loWoBthresh) ?
                    SAPC - SAPC * loWoBfactor * loWoBoffset :
                    SAPC + loWoBoffset;
        }
        return outputContrast * 100.0;
    };
    
    window.getFontSizes = () => {
        return [12, 14, 16, 18, 24, 30, 36, 48, 60, 72, 96, 120];
    };
    
    window.getMinContrast = (fontWeight, fontSize, fontType) => {
        let fontSizes = getFontSizes();
        let fontIndex = fontSizes.indexOf(fontSize);
        if (fontIndex === -1) return false;
        if (fontType !== 'sans') {
            // "Many serif fonts should use values for the row above"
            if (fontIndex < 1) return false;
            --fontIndex;
            fontSize = fontSizes[fontIndex];
        }
        let mins = {
            12: {
                200: false,
                300: false,
                400: false,
                500: 100,
                600: 90,
                700: 80,
            },
            14: {
                200: false,
                300: false,
                400: 100,
                500: 90,
                600: 80,
                700: 60,
            },
            16: {
                200: false,
                300: 100,
                400: 90,
                500: 80,
                600: 60,
                700: 55,
            },
            18: {
                200: false,
                300: 90,
                400: 80,
                500: 60,
                600: 55,
                700: 50,
            },
            24: {
                200: 100,
                300: 80,
                400: 60,
                500: 55,
                600: 50,
                700: 40,
            },
            30: {
                200: 90,
                300: 70,
                400: 55,
                500: 50,
                600: 40,
                700: 38,
            },
            36: {
                200: 80,
                300: 60,
                400: 50,
                500: 40,
                600: 38,
                700: 35,
            },
            48: {
                200: 70,
                300: 55,
                400: 40,
                500: 38,
                600: 35,
                700: 30,
            },
            60: {
                200: 60,
                300: 50,
                400: 38,
                500: 35,
                600: 30,
                700: 25,
            },
            72: {
                200: 55,
                300: 40,
                400: 35,
                500: 30,
                600: 25,
                700: 20,
            },
            96: {
                200: 50,
                300: 35,
                400: 30,
                500: 25,
                600: 20,
                700: 20,
            },
            120: {
                200: 40,
                300: 30,
                400: 25,
                500: 20,
                600: 20,
                700: 20,
            },
        };
        let fontInfo = mins[fontSize];
        if (!fontInfo.hasOwnProperty(fontWeight)) return false;
        return fontInfo[fontWeight];
    };
    
};