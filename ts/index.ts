import { notify, confirmNotification, Notify, Confirm } from './notifications'
import { confirmAction, ConfirmAction } from './confirmAction'
import { showDialog, showConfirmDialog, ShowConfirmDialog, ShowDialog } from './dialog'
import { dataGet, DataGet } from './utils/dataGet'
import { Alpine } from './components/alpine'
import { Appuihooks } from './hooks'
import './directives/confirm'
import './browserSupport'
import './components'
import './global'

export interface AppUI {
    notify: Notify
    confirmNotification: Confirm
    confirmAction: ConfirmAction
    dialog: ShowDialog
    confirmDialog: ShowConfirmDialog
    dataGet: DataGet
}

declare global {
    interface Window {
        $appui: AppUI
        Appui: Appuihooks
        Alpine: Alpine
        Livewire: any
        $openModal: CallableFunction
    }
}

const appui = {
    notify,
    confirmNotification,
    confirmAction,
    dialog: showDialog,
    confirmDialog: showConfirmDialog,
    dataGet
}

window.$appui = appui
document.addEventListener('DOMContentLoaded', () => window.Appui.dispatchHook('load'))
export  default  appui
