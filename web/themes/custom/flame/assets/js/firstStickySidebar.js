Drupal.behaviors.firstStickySidebarsBehavior = {
    attach: function (context, settings) {
        const leftFirstSidebar = document.querySelector('.news__left-sidebar')
        const rightFirstSidebar = document.querySelector('.news__right-sidebar')
        const newsList = document.querySelector('.news__list')
        const newsSection = document.querySelector('.news')
        document.addEventListener("scroll", (event) => {
            const scrollY = window.pageYOffset
            const beginSticky = 1230
            const endRightSticky = 1330
            const endLeftSticky = 1760

            if (scrollY > beginSticky) {
                leftFirstSidebar.style.position = 'fixed'
                rightFirstSidebar.style.position = 'fixed'
                leftFirstSidebar.style.top = '45px'
                rightFirstSidebar.style.top = '45px'
                rightFirstSidebar.style.right = '260px'
                newsList.style.marginLeft = "280px"
                newsSection.style.marginBottom = "220px"
            } else if (scrollY < beginSticky) {
                leftFirstSidebar.style.position = 'relative'
                leftFirstSidebar.style.top = '0px'
                newsList.style.marginLeft = "0px"
                rightFirstSidebar.style.position = 'relative'
                rightFirstSidebar.style.right = '0px'
                rightFirstSidebar.style.top = '0px'
                newsSection.style.marginBottom = "0px"
            }

            if (scrollY > endRightSticky) {
                rightFirstSidebar.style.position = 'relative'
                rightFirstSidebar.style.top = `${endRightSticky-beginSticky}px`
                rightFirstSidebar.style.right = '0px'
                newsSection.style.marginBottom = "100px"
            }

            if (scrollY > endLeftSticky) {
                leftFirstSidebar.style.position = 'relative'
                leftFirstSidebar.style.top = `${endLeftSticky-beginSticky}px`
                newsList.style.marginLeft = "0px"
            }
        });
    }
};

