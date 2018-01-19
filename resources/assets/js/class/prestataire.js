import $ from 'jquery'

export default class chmPrestataire {

  static create () {
    window.chmModal.show({type: 'GET', url: window.chmSite.url('presataires/create')}, {
      form: {
        class: '',
        callback: 'chmPrestataire.store'
      },
      footer: {
        label: 'Créer'
      }
    })
  }

  static edit (id) {
    window.chmModal.show({type: 'GET', url: window.chmSite.url('presataires/' + id + '/edit')}, {
      form: {
        class: '',
        callback: 'chmPrestataire.store'
      },
      footer: {
        label: 'Mettre à jour'
      }
    })
  }

  static store (event) {
    event.preventDefault()
    var form = $(event.target)[0]
    var data = new window.FormData(form)
    var btn = $(event.target).find('[type="submit"]')
    var btnHtml = btn.html()
    btn.html('<i class="fa fa-circle-o-notch"></i>&nbsp;Traitement en cours...')
    btn.prop('disabled', true)
    var ajaxParams = {
      type: 'POST',
      url: window.chmSite.url('presataires/store'),
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000
    }
    if ($(event.target).find('[type="file"]')) ajaxParams.enctype = 'multipart/form-data'
    $.ajax(ajaxParams).done(function (response, textStatus, jqXHR) {
      if (response.status !== 'success') {
        window.chmModal.showAlertMessage(response.status, response.message)
      } else {
        window.chmModal.alert('<i class="fa fa-check-circle"></i>&nbsp;Opération effectué', response.message, {width: 315, callback: 'window.location.reload'})
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      var message = jqXHR.status + ' - ' + jqXHR.statusText
      window.chmModal.showAlertMessage('danger', message)
    }).always(function () {
      btn.html(btnHtml)
      btn.prop('disabled', false)
    })
  }

  static delete (params) {
    var object = window.chmModal.show({type: 'GET', url: window.chmSite.url('presataires/' + params.id + '/delete')}, {
      message: '<i class="fa fa-trash"></i>&nbsp;Suppression en cours...'
    })
    object.modal.attr('chm-modal-action', 'reload')
  }

}
