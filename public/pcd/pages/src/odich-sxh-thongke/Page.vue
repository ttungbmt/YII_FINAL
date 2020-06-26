<template>
    <div>
        <b-card header-class="p-0">
            <b-form @submit.prevent="onSubmit">
                <v-field type="select" :items="dm_loai_tk" label="Loại thống kê" v-model="form.loai_tk"></v-field>
                <div class="grid grid-cols-2 gap-4">
                    <v-field type="date" label="Từ ngày Ngày xử lý" v-model="form.date_from" placeholder="DD/MM/YYYY"></v-field>
                    <v-field type="date" label="Đến ngày" v-model="form.date_to" placeholder="DD/MM/YYYY"></v-field>
                </div>


                <m-btn type="submit" color="primary" :loading="$wait.any">Thống kê</m-btn>
            </b-form>
        </b-card>


        <v-wait for="thongke">
            <template slot="waiting">
                <b-progress :value="100" :max="100" animated></b-progress>
            </template>


            <div v-if="!_.isEmpty(data)" >
                <m-btn class="mb-2 mr-3" type="export" :exportOptions="exportOptions" size="sm">Xuất Excel</m-btn>
                <div class="bg-white">
                    <v-table id="tb-thongke" :fields="fields" :items="data" :options="tbOptions"></v-table>
                </div>

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
                    bordered: true,
                    'sticky-header': true,
                },
                form: {
                    loai_tk: 1,
                    date_from: '',
                    date_to: '',
                },
                data: {

                },
                fields: [
                ],
                exportOptions: {
                    selector: '#tb-thongke',
                    filename: 'BienbanXLOD.xlsx',
                }
            }
        },
        mounted() {

        },
        methods: {
            onSubmit(e){
                this.$wait.start('thongke');

                let data = this.form

                this.$http.post(window.location.href, data).then(({data}) => {
                    this.fields = data.fields.map(v => {
                        v.thAttr = function (value, key, item, type) {
                            return {
                                'data-f-bold': true
                            }
                        }

                        return v
                    })
                    this.data = data.data

                    this.$wait.end('thongke');
                }).catch(() => {
                    this.$wait.end('thongke');
                })
            },
            resetData(){
                this.fields = []
                this.data = []
            },
        },
        watch: {
            'form.loai_tk': function (val) {
                this.resetData()
            }
        }
    }
</script>








