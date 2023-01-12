Drupal.behaviors.stickyBtnBehavior = {
    attach: function (context, settings) {
        const btn = document.querySelector('.up-btn')
        document.addEventListener('scroll',() => {
            const scrollY = window.pageYOffset
            if (scrollY > 300) {
                btn.style.bottom = "5px"
            } else {
                btn.style.bottom = "-55px"
            }
        })
        btn.addEventListener('click', () => {
          window.scrollTo(0,0)
        })
    }
};
