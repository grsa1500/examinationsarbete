
export default () => {
    const siteHeaderEl = document.querySelector('.site-header');
    const headerNavEl = siteHeaderEl.querySelector('.site-header__nav');

    // Toggla menyn
    $('.site-header__nav-toggle').click(() => {
        document.body.classList.toggle('stop-scrolling');
        siteHeaderEl.classList.toggle('site-header--menu-open');

        const hidden = headerNavEl.getAttribute('aria-hidden');
        headerNavEl.setAttribute('aria-hidden', hidden === 'true' ? 'false' : 'true');
    });

    // Header dockning
    // const htmlEl = document.querySelector('html');
    // const headerDocker = () => {
    //     const scroll = htmlEl.scrollTop;

    //     if (scroll >= 250) {
    //         document.body.classList.add('scrolled');
    //     } else {
    //         document.body.classList.remove('scrolled');
    //     }
    // };
    // document.addEventListener('wheel', headerDocker, { capture: false, passive: true });

    // TODO: Ersätt med Lozad?
    // Ta bort data-src när bilden är laddad.
    // document.querySelectorAll('img[data-src]').forEach((el) => {
    //     const img = el;
    //     img.setAttribute('src', img.getAttribute('data-src'));
    //     img.onload = () => img.removeAttribute('data-src');
    // });
    




   


};

