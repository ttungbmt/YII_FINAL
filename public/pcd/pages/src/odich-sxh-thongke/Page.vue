<template>
    <div>
        <b-card header-class="p-0">
            <b-form @submit.prevent="onSubmit">
                <v-field type="select" :items="dm_loai_tk" label="Loại thống kê" v-model="form.loai_tk"></v-field>

                <v-field type="date" label="Ngày xử lý" v-model="form.ngayxuly" placeholder="DD/MM/YYYY"></v-field>

                <div class="text-right">
                    <b-button variant="primary" type="submit"><i v-if="$wait.any" class="icon-spinner2 spinner mr-2"></i>Thống kê</b-button>
                </div>
            </b-form>
        </b-card>


        <v-wait for="thongke">
            <template slot="waiting">
                <b-progress :value="100" :max="100" animated></b-progress>
            </template>

            <div v-if="!_.isEmpty(data)" class="bg-white">
                <v-table :fields="fields" :items="data" :options="tbOptions"></v-table>
            </div>

        </v-wait>
    </div>

</template>
<script>
    export default {
        name: 'page-thongke-odich',
        components: {

        },
        data() {
            return {
                dm_loai_tk: {
                    1: 'Hoạt động phun hóa chất',
                    2: 'Diệt lăng quăng',
                    3: 'Tổng hợp',
                },
                tbOptions: {
                    bordered: true
                },
                form: {
                    loai_tk: 1,
                    ngayxuly: ''
                },
                data: {

                },
                fields: [
                ]
            }
        },
        mounted() {

        },
        methods: {
            onSubmit(e){
                this.$wait.start('thongke');

                let data = this.form

                this.$http.post(window.location.href, data).then(({data}) => {
                    this.fields = data.fields
                    this.data = data.data

                    this.$wait.end('thongke');
                }).catch(() => {
                    this.$wait.end('thongke');
                })
            },
            resetData(){
                this.fields = []
                this.data = []
            }
        },
        watch: {
            'form.loai_tk': function (val) {
                this.resetData()
            }
        }
    }
</script>








