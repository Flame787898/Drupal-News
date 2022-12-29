Drupal.behaviors.stickyHeaderBehavior = {
    attach: function (context, settings) {
        const header = document.getElementById("header")
        const mainContent = document.querySelector('main')
        document.addEventListener("scroll", (event) => {
            const scrollY =  window.pageYOffset
            const screenWidth = document.documentElement.clientWidth
            if (scrollY > 350 && screenWidth > 940) {
                header.classList.add('sticky')
                header.style.top = "0"
                mainContent.style.marginTop = "222px"
            } else if (scrollY < 350 && screenWidth > 940) {
                header.classList.remove('sticky')
                header.style.top = "-60px"
                mainContent.style.marginTop = "0"
            }
        });
    }
};

