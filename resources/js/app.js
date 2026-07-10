import './bootstrap';
import Alpine from 'alpinejs';
import { openAI } from './ai';
import aiDrawer from './ai/drawer';

window.Alpine = Alpine;

Alpine.data('aiDrawer', aiDrawer);
window.openAI = openAI;
Alpine.start();