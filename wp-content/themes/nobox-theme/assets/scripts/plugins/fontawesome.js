import { dom, library, config } from '@fortawesome/fontawesome-svg-core';


import {
    faExclamation,
    faHome,
    faFlower, 
    faSeedling,
    faInfoCircle,
    faAddressBook,
    faSearchPlus,
    faChevronLeft
} from '@fortawesome/pro-solid-svg-icons';

import {
    faCheck,
    faTimes,
    faExclamationCircle,
  
} from '@fortawesome/pro-regular-svg-icons';

// import {} from '@fortawesome/pro-light-svg-icons';


import {
    faFacebook,
    faInstagram, 
    faInstagramSquare
} from '@fortawesome/free-brands-svg-icons';


config.autoReplaceSvg = true;
config.observeMutations = true;
// config.searchPseudoElements = true;

library.add(
    faCheck,
    faTimes,
    faInfoCircle,
    faExclamationCircle,
    faFacebook, 
    faInstagram,
    faFlower, 
    faHome,
    faSeedling,
    faInfoCircle,
    faAddressBook,
    faSearchPlus,
    faChevronLeft

);

dom.watch();
