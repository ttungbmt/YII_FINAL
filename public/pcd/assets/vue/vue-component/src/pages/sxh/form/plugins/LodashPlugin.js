import lodash from 'lodash-es'

const genericInstall = (Vue) => {
    Vue._ = lodash
    Object.defineProperties(Vue.prototype, {
        _: { get() { return lodash } }
    })
}

export default {
    install(Vue, options) {
        if (options && options.name) {
            Vue[options.name] = lodash
            Object.defineProperties(Vue.prototype, {
                [options.name]: { get() { return lodash } }
            })
        }
        genericInstall(Vue)
    }
}