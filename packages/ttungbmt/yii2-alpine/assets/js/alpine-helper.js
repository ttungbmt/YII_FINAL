class AlpineInstance {
    constructor({data, methods}) {
        _.map(data, (v, k) => this[k] = v)
        _.map(methods, (v, k) => this[k] = v.bind(this))
    }
}

function alpine(data) {
    return new AlpineInstance(data)

}

