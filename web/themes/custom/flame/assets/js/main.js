const mobileMenuIcon = document.getElementById("mobile-menu")
const bgMobileMenu = document.querySelector(".bg-mobile-menu")
const bgMobileSearch = document.querySelector('.bg-mobile-search')
const mobileNavigation = document.querySelector('.mobile-navigation')
const closeMenu = document.getElementById('close-menu')
const closeSearch = document.getElementById('close-search')
const mainContent = document.querySelector('main')
const searchIcon = document.getElementById('search-bar')
const searchBlock = document.getElementById('block-flame-searchform')
const screenWidth = document.documentElement.clientWidth
/*open mobile menu*/
mobileMenuIcon.addEventListener('click', () => {
  bgMobileMenu.classList.add('open')
  setTimeout(() => {
    mobileNavigation.classList.add('open')
    mainContent.classList.add('open')
  }, 400)
})
/*close mobile menu*/
closeMenu.addEventListener('click', () => {
  mainContent.classList.remove('open')
  bgMobileMenu.classList.remove('open')
  mobileNavigation.classList.remove('open')
})
/*search pop up*/
searchIcon.addEventListener('click', () => {
  searchBlock.classList.toggle('open')
})
/*search mobile*/
if (screenWidth <= 720) {
  searchIcon.addEventListener('click', () => {
    bgMobileSearch.classList.add('open')
    mainContent.classList.add('open')
    setTimeout(() => {
      closeSearch.classList.add('open')
      searchBlock.classList.add('open')
    }, 500)
  })
  closeSearch.addEventListener('click', () => {
    closeSearch.classList.remove('open')
    bgMobileSearch.classList.remove('open')
    mainContent.classList.remove('open')
    searchBlock.classList.remove('open')
  })
}
