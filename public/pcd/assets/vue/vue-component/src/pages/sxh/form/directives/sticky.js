import 'jquery-sticky'

export default {
    name: 'sticky',
    inserted(el, binding) {
        $(el).sticky({topSpacing: 0, zIndex: 1000})
    },
}