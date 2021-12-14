import {hasIn, get, pick} from 'lodash-es'

const mixin = {
    methods: {
        only(object, paths){
            let itemsSort = []
            let items = pick(object, paths)
            paths.map(key => hasIn(items, key) && itemsSort.push({
                ...get(items, key),
                name: key
            }))
            return itemsSort
        }
    }
}

export default mixin