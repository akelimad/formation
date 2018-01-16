// Bootstrap components
// require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/modal')
// require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/dropdown')
// require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/collapse')
// require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/alert')

// Main modules
import chmSite from './class/site'
import chmUrl from './class/url'
import chmCookie from './class/cookie'
import chmModal from './class/modal'
import chmFilter from './class/filter'

// Store modules in window
window.chmSite = chmSite
window.chmUrl = chmUrl
window.chmCookie = chmCookie
window.chmModal = chmModal
window.chmFilter = chmFilter

// Standart jQuery script
import './custom'

