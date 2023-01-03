Drupal.behaviors.mobileMenuBehavior = {
    attach: function (context, settings) {
        const mobileMenuIcon = document.getElementById("mobile-menu");
        const closeMenu = document.getElementById('close-menu')
        const mainContent = document.querySelector('main')
        const bgMobileMenu = document.querySelector(".bg-mobile-menu")
        const mobileNavigation = document.querySelector('.mobile-navigation')
        const footer = document.querySelector("footer[role='contentinfo']")
      /*open mobile menu*/
        mobileMenuIcon.addEventListener('click', () => {
            bgMobileMenu.classList.add('open')
            console.log(footer)
            setTimeout(() => {
                mobileNavigation.classList.add('open')
                mainContent.classList.add('open')
                footer.style.display = 'none'
            }, 400)
        })
      /*close mobile menu*/
        closeMenu.addEventListener('click', () => {
            mainContent.classList.remove('open')
            bgMobileMenu.classList.remove('open')
            mobileNavigation.classList.remove('open')
            footer.style.display = 'block'
        })
    }
};


