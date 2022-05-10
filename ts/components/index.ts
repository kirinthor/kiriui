import dropdown from './dropdown'
import modal from './modal'
import dialog from './dialog'
import notifications from './notifications'
import maskable from './inputs/maskable'
import currency from './inputs/currency'
import select from './select'
import timePicker from './timePicker'
import datetimePicker from './datetime-picker'

document.addEventListener('alpine:init', () => {
  window.Alpine.data('appui_dropdown', dropdown)
  window.Alpine.data('appui_modal', modal)
  window.Alpine.data('appui_dialog', dialog)
  window.Alpine.data('appui_notifications', notifications)
  window.Alpine.data('appui_inputs_maskable', maskable)
  window.Alpine.data('appui_inputs_currency', currency)
  window.Alpine.data('appui_select', select)
  window.Alpine.data('appui_timepicker', timePicker)
  window.Alpine.data('appui_datetime_picker', datetimePicker)
})
