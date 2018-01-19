import $ from 'jquery'

export default class chmPermission {

  static permissions (id) {
    window.chmModal.show({type: 'GET', url: window.chmSite.url('role/' + id + '/permissions')}, {
      form: {
        class: '',
        callback: 'chmPermission.store'
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
      url: window.chmSite.url('role/permissions/store'),
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000
    }
    $.ajax(ajaxParams).done(function (response, textStatus, jqXHR) {
      window.chmModal.alert('<i class="fa fa-check-circle"></i>&nbsp;Opération effectué', response.message, {width: 315, callback: 'window.chmModal.destroy'})
    }).fail(function (jqXHR, textStatus, errorThrown) {
      var message = jqXHR.status + ' - ' + jqXHR.statusText
      window.chmModal.showAlertMessage('danger', message)
    }).always(function () {
      btn.html(btnHtml)
      btn.prop('disabled', false)
    })
  }

}
