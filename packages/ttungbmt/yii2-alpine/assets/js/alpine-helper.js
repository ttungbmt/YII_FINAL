class AlpineInstance {
    constructor({data, methods}) {
        _.map(data, (v, k) => this[k] = v)
        _.map(methods, (v, k) => this[k] = v.bind(this))
    }
}

function alpine(options) {
    // new AlpineInstance(data)
    return {
        ...options.data,
        ...options.methods
    }

}

