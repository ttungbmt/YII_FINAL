export default {
    namespaced: true,
    state: () => ({
        layers: {}
    }),
    getters: {
        getAll(){
            return {
                layers: {
                    component: 'l-control-layers'
                }
            }
        }
    }
}
