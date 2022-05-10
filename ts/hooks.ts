export interface Appuihooks{
    hook (hook: string, callback: CallableFunction): void,
    dispatchHook (hook: string): void
}
