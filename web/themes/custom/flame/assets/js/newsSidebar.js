Drupal.behaviors.stickyTaxonomyBehavior = {
    attach: function (context, settings) {

        const footer = document.querySelector('.footer')
        const rightSidebar = document.querySelector('.news__right-sidebar ')
        const blockDesc = document.querySelector(".block__category-description")
        const  isInViewport = (element) => {
            const rect = element.getBoundingClientRect();
            return rect.top;
        }
        /*in news list page*/
        if (window.innerWidth > 1400) {
            const offset = isInViewport(footer) - 1550
            window.addEventListener('scroll', () => {
                let startPoint = isInViewport(blockDesc)
                const stopPoint = isInViewport(footer)
                if (startPoint <= -20 ) {
                    rightSidebar.style = `position:relative; top:${startPoint * -1 - 50}px;`
                } else if (startPoint > 0) {
                    rightSidebar.style = 'position:relative;top:0; right:0'
                }
                if (stopPoint < 1050 ) {
                    rightSidebar.style = `position:relative;top:${offset}px; right:0;`
                }
            })
        }
    }
};


