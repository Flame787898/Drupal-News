Drupal.behaviors.SearchBarBehavior = {
    attach: function (context, settings) {
        const bgMobileSearch = document.querySelector('.bg-mobile-search')
        const closeSearch = document.getElementById('close-search')
        const mainContent = document.querySelector('main')
        const searchIcon = document.getElementById('search-bar')
        const searchBlock = document.getElementById('block-flame-searchform')
        const footer = document.querySelector("footer[role='contentinfo']")
        const screenWidth = document.documentElement.clientWidth

        if (screenWidth <= 720) {
            searchIcon.addEventListener('click', () => {
                bgMobileSearch.classList.add('open')
                mainContent.classList.add('open')
                setTimeout(() => {
                    closeSearch.classList.add('open')
                    searchBlock.classList.add('open')
                    footer.style.display = 'none'
                  }, 500)
            })

            closeSearch.addEventListener('click', () => {
                  closeSearch.classList.remove('open')
                  bgMobileSearch.classList.remove('open')
                  mainContent.classList.remove('open')
                  searchBlock.classList.remove('open')
                  footer.style.display = 'block'
            })
        } else {
            searchIcon.addEventListener('click', () => {
                searchBlock.classList.toggle('open')
            })
        }
    }
};


