import $ from 'jquery'

export default class chmModal {

  static show (params, args = {}, options = {}) {
    params = $.extend({}, {
      type: 'POST'
    }, params)
    // Fire off the request
    var classInstance = this
    var modalTemplate = this.loading(args.message)
    if (options.width !== '') {
      modalTemplate.find('.modal-dialog').css('width', options.width)
    }
    modalTemplate.attr('chm-modal-id', null)
    $.ajax(params).done(function (response, textStatus, jqXHR) {
      try {
        if (response === undefined) {
          classInstance.destroy(modalTemplate)
        } else {
          // add title
          if (response['title'] !== undefined) {
            modalTemplate.find('.modal-title').html(response.title)
          } else {
            modalTemplate.find('.modal-title').hide()
          }
          // add content
          if (response['content'] !== undefined) {
            modalTemplate.find('.modal-body').html(response.content).show()
          } else {
            modalTemplate.find('.modal-body').hide()
          }
          modalTemplate.find('button.close').show()
          modalTemplate.find('.panel-footer').remove()
          modalTemplate.removeClass('chm-loading-modal')
          modalTemplate.removeClass('chm-confirm-modal')

          if (!$(modalTemplate).find('.modal-title').is(':visible') && !$(modalTemplate).find('.modal-body').is(':visible')) {
            classInstance.destroy(modalTemplate)
          }
        }
      } catch (e) {
        classInstance.setError(modalTemplate, e.message)
      }
    }).fail(function (jqXHR, textStatus, errorThrown) {
      classInstance.setError(modalTemplate, jqXHR.statusText)
    })
    return modalTemplate
  }

  static confirm (target, title = '', message = '', callable = '', args = {}, params = {}) {
    // prepare action
    var action = ''
    if (callable !== '') {
      action = callable + '(' + this.htmlEntities(JSON.stringify(args)) + ')'
    } else if ($(target).is('a')) {
      action = 'window.location.href=&apos;' + $(target).attr('href') + '&apos;'
    } else if ($(target).is('input[type="submit"]')) {
      action = '$("' + $(target).closest('form').attr('id') + '").submit()'
    }

    if (title === '') title = '<i class="fa fa-warning"></i>&nbsp;Confirmation de l\'action'
    if (message === '') message = 'Êtes-vous sûr ?'
    var modal = ($('.chm-modal').length > 0) ? $('.chm-modal') : $(this.template())
    modal.find('button.close').hide()
    modal.find('.modal-title').html(title)
    modal.find('.modal-body').html(message)

    // add footer actions
    var footer = '<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Fermer</button><button onclick="return ' + action + '" class="btn btn-danger btn-sm pull-right">Appliquer</button>'

    if (modal.find('.panel-footer').length === 0) {
      modal.find('.modal-content').append('<div class="panel-footer">' + footer + '</div>')
    } else {
      modal.find('.panel-footer').empty().append(footer)
    }

    // applay css
    if (params.width !== '') {
      modal.find('.modal-dialog').css('width', params.width)
    }
    modal.attr('chm-modal-id', 'confirm')
    modal.modal({ backdrop: 'static', keyboard: false })
  }

  static alert (title = '', message = '', params = {}) {
    var modal = ($('.chm-modal').length > 0) ? $('.chm-modal') : $(this.template())
    modal.find('button.close').hide()
    if (title === '') title = 'Alert !'
    modal.find('.modal-title').html(title)
    if (message !== '') {
      modal.find('.modal-body').html(message)
    } else {
      modal.find('.modal-body').hide()
    }

    // add footer actions
    var footer = '<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Fermer</button><button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal" aria-hidden="true">OK</button></div>'

    if (modal.find('.panel-footer').length === 0) {
      modal.find('.modal-content').append('<div class="panel-footer">' + footer + '</div>')
    } else {
      modal.find('.panel-footer').empty().append(footer)
    }

    // applay css
    if (params.width !== '') {
      modal.find('.modal-dialog').css('width', params.width)
    }
    modal.attr('chm-modal-id', 'alert')
    modal.modal({ backdrop: 'static', keyboard: false })

    return modal
  }

  static loading (message = '') {
    var content = (message !== '') ? message : '<i class="fa fa-spinner fa-spin fast-spin"></i>&nbsp;Chargement en cours...'
    var tpl = ($('.chm-modal').length > 0) ? $('.chm-modal') : $(this.template())
    tpl.find('.panel-footer').remove()
    tpl.removeClass('chm-confirm-modal')
    tpl.addClass('chm-loading-modal')
    tpl.find('.modal-title').html(content)
    tpl.find('.modal-body').hide()
    tpl.modal({ backdrop: 'static', keyboard: false })
    return tpl
  }

  static destroy (instance) {
    $(instance).find('button.close').trigger('click')
  }

  static template () {
    return '<div class="modal chm-modal fade" role="dialog" data-keyboard="false"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style="border-bottom: none;"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title"></h4></div><div class="modal-body" style="border-top: 1px solid #e5e5e5;"><div class="modal-notif-block"></div></div></div></div></div>'
  }

  static showAlertMessage (type, message, dismissible = true) {
    if (type === 'error') type = 'danger'
    var alert = '<div class="chm-alerts alert alert-' + type + ' alert-white rounded mb-10">'
    if (dismissible === true) {
      alert += '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">x</button>'
    }
    alert += '<div class="icon"><i class="fa fa-check"></i></div>'
    alert += '<strong>' + message + '</strong>'
    alert += '</div>'
    if ($('.chm-modal').find('.modal-notif-block').length === 0) {
      $('.chm-modal').find('.modal-body').prepend('<div class="modal-notif-block"></div>')
    }
    $('.chm-modal').find('.modal-notif-block').empty().html(alert)
  }

  static setError (modal, message) {
    modal.find('.modal-title').html('<i class="fa fa-warning"></i>&nbsp;' + message)
    modal.find('.modal-body').hide()
  }

  static htmlEntities (str) {
    return String(str).replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
  }

}
