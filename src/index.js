import './main.css';

import chroma from 'chroma-js';
window.chroma = chroma;

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import copy from 'copy-text-to-clipboard';
window.copy = copy;

import { acpa } from './apca.js';
acpa();

import { initUI } from './ui.js';
initUI();

Alpine.start();