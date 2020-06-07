/**
 * Polyfills
 */
import 'core-js/stable';
import 'regenerator-runtime/runtime'; // eslint-disable-line
import 'whatwg-fetch';
import 'setimmediate';
import 'custom-event-polyfill';

/**
 * Bibliotek
 * Notera att vi inte behöver importera jQuery eftersom det läggs till automatiskt
 *   och använder WordPress:s inbyggda jQuery.
 * Se webpack.mix.js under `autoload` och `externals`.
 */
import { router } from 'js-dom-router';

/**
 * Plugins
 */
import './plugins/fontawesome';
import './plugins/lightbox';

/**
 * Vyer
 */
import common from './routes/common';
import home from './routes/home';
import contactUs from './routes/contactUs';

/**
 * Lägg till de vyer som ska tas med i JS filen.
 *
 * För att lägga till en ny vy, lägg till ett nytt `.on()` anrop i kedjan, innan `ready()`.
 * Exempel (där klassFranBody har importerats ovan):
 *   .on('klass-fran-body', klassFranBody)
 */
router
    .one('common', common)
    .on('home', home)
    .on('kontakt', contactUs)
    .ready();

