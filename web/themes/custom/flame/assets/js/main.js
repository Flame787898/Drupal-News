const mobileMenuIcon = document.getElementById("mobile-menu")
const bgMobileMenu= document.querySelector(".bg-mobile-menu")
const mobileNavigation = document.querySelector('.mobile-navigation')
const closeMenu = document.getElementById('close-menu')
const mainContent= document.querySelector('main')
mobileMenuIcon.addEventListener('click',()=>{
  bgMobileMenu.classList.add('open')
  setTimeout(()=>{
    mobileNavigation.classList.add('open')
    mainContent.classList.add('open')
  },400)
})
closeMenu.addEventListener('click',()=>{
  mainContent.classList.remove('open')
  bgMobileMenu.classList.remove('open')
  mobileNavigation.classList.remove('open')
})
