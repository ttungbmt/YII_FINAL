<template>
    <div>
        <v-wait :for="keyLoading">
            <template slot="waiting">
                <b-progress :value="100" :max="100" animated></b-progress>
            </template>
            <div v-html="html">

            </div>
        </v-wait>

        <button type="button" class="btn-small mt-2" @click="getRanhtos" >Cập nhật ranh khu phố/ tổ</button>
    </div>
</template>
<script>
    import {map} from 'lodash-es'

    const KEY_LOADING = 'ranhto'

    export default {
        name: 'p-phamvi',
        computed: {
            cabenhIds(){
                return map(this.$store.get('form.cabenhs'), 'gid')
            }
        },
        data () {
            return {
                keyLoading: KEY_LOADING,
                html: this.$store.get('form.phamvi')
            };
        },
        methods: {
            getRanhtos(){
                this.$wait.start(KEY_LOADING);
                this.$http.post(`/sxh/odich/to-ah`, {cabenhIds: this.cabenhIds}).then(({data}) => {
                    this.html = data

                    this.$store.commit('updateForm', {
                        path: 'form.phamvi',
                        value: data,
                    })

                    this.$wait.end(KEY_LOADING);
                })
            }
        }
    }
</script>