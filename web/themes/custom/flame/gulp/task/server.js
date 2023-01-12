export const server = (done)=>{
  app.plugins.browsersync.init({
    proxy: 'http://flame.docksal.site',
    notify:false
  })
}
