// Bootstrap components
require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/modal')
// require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/dropdown')
// require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/collapse')
// require('./../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/alert')

// Main modules
import chmSite from './class/site'
import chmUrl from './class/url'
import chmCookie from './class/cookie'
import chmModal from './class/modal'
import chmFilter from './class/filter'
import chmPrestataire from './class/prestataire'
import chmCours from './class/cours'
// import swal from 'sweetalert2'

// Store modules in window
window.chmSite = chmSite
window.chmUrl = chmUrl
window.chmCookie = chmCookie
window.chmModal = chmModal
window.chmFilter = chmFilter
window.chmPrestataire = chmPrestataire
window.chmCours = chmCours

// Standart jQuery script
import './custom'
