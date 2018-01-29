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
import chmSalle from './class/salle'
import chmFormateur from './class/formateur'
import chmParticipant from './class/participant'
import chmBudget from './class/budget'
import chmEvaluation from './class/evaluation'
import chmQuestion from './class/question'
import chmSession from './class/session'
import chmUser from './class/user'
import chmRole from './class/role'

// Store modules in window
window.chmSite = chmSite
window.chmUrl = chmUrl
window.chmCookie = chmCookie
window.chmModal = chmModal
window.chmFilter = chmFilter
window.chmPrestataire = chmPrestataire
window.chmCours = chmCours
window.chmSalle = chmSalle
window.chmFormateur = chmFormateur
window.chmParticipant = chmParticipant
window.chmBudget = chmBudget
window.chmEvaluation = chmEvaluation
window.chmQuestion = chmQuestion
window.chmSession = chmSession
window.chmUser = chmUser
window.chmRole = chmRole

// Standart jQuery script
import './custom'
