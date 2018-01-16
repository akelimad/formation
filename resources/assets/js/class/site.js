export default class chmSite {

  static url (path = '') {
    return document.querySelector('link[rel="website"]').getAttribute('href') + path
  }

}
