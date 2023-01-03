Drupal.behaviors.secondStickySidebarsBehavior = {
    attach: function (context, settings) {
        const leftFirstSidebar = document.querySelector('.second__news__left-sidebar')
        const rightFirstSidebar = document.querySelector('.second__news__right-sidebar')
        const newsList = document.querySelector('.second__news__list')
        const newsSection = document.querySelector('.second__news')
        if (leftFirstSidebar && window.innerWidth > 1400) {
            document.addEventListener("scroll", (event) => {
                const scrollY = window.pageYOffset
                const beginSticky = 3510
                const endRightSticky = 4115
                const endLeftSticky = 4400

                if (scrollY > beginSticky) {
                    leftFirstSidebar.style.position = 'fixed'
                    rightFirstSidebar.style.position = 'fixed'
                    leftFirstSidebar.style.top = '45px'
                    rightFirstSidebar.style.top = '45px'
                    rightFirstSidebar.style.right = '260px'
                    newsList.style.marginLeft = "280px"
                    newsSection.style.marginTop = "30px"
                    newsSection.style.marginBottom = "220px"
                } else if (scrollY < beginSticky) {
                    leftFirstSidebar.style.position = 'relative'
                    leftFirstSidebar.style.top = '0px'
                    newsList.style.marginLeft = "0px"
                    rightFirstSidebar.style.position = 'relative'
                    rightFirstSidebar.style.right = '0px'
                    rightFirstSidebar.style.top = '0px'
                    newsSection.style.marginBottom = "0px"
                    newsSection.style.marginTop = "0px"
                }
                if (scrollY > endRightSticky) {
                    rightFirstSidebar.style.position = 'relative'
                    rightFirstSidebar.style.top = `${endRightSticky - beginSticky}px`
                    rightFirstSidebar.style.right = '0px'
                  // newsSection.style.marginBottom = "100px"
                }
                if (scrollY > endLeftSticky) {
                    leftFirstSidebar.style.position = 'relative'
                    leftFirstSidebar.style.top = `${endLeftSticky - beginSticky}px`
                    newsList.style.marginLeft = "0px"
                }
            });
        }
    }
};

