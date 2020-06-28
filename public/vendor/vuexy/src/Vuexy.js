import Vue from 'vue'
import VueWait from 'vue-wait'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import store from './store'

const router = new VueRouter({
    routes: []
})

export default class Vuexy {
    constructor(config) {
        this.bus = new Vue()
        this.bootingCallbacks = []
        this.config = config
        this.store = store
    }

    /**
     * Start the Nova app by calling each of the tool's callbacks and then creating
     * the underlying Vue instance.
     */
    liftOff(options) {
        let _this = this

        this.boot()

        this.app = new Vue({
            el: '#vuexy',
            wait: new VueWait(),
            store,
            router,
            ...options
        })

    }

    /**
     * Show an error message to the user.
     *
     * @param {string} message
     */
    error(message) {

    }

    /**
     * Show a success message to the user.
     *
     * @param {string} message
     */
    success(message) {

    }

    /**
     * Show a warning message to the user.
     *
     * @param {string} message
     */
    warning(message) {

    }

    /**
     * Register a listener on Nova's built-in event bus
     */
    $on(...args) {
        this.bus.$on(...args)
    }

    /**
     * Register a one-time listener on the event bus
     */
    $once(...args) {
        this.bus.$once(...args)
    }

    /**
     * Unregister an listener on the event bus
     */
    $off(...args) {
        this.bus.$off(...args)
    }

    /**
     * Emit an event on the event bus
     */
    $emit(...args) {
        this.bus.$emit(...args)
    }

    /**
     * Register a callback to be called before Nova starts. This is used to bootstrap
     * addons, tools, custom fields, or anything else Nova needs
     */
    booting(callback) {
        this.bootingCallbacks.push(callback)
    }

    /**
     * Execute all of the booting callbacks.
     */
    boot() {
        this.bootingCallbacks.forEach(callback => callback(Vue, router, store))
        this.bootingCallbacks = []
    }
}