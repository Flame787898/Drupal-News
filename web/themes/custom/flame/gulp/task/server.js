export const server = (done)=>{
  app.plugins.browsersync.init({
    proxy: 'http://drupal.localhost:8000/',
    notify:false
  })
}
