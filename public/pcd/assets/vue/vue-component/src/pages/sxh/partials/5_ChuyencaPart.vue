<template>
    <div class="row mt-2">
        <div class="col-md-12">
            <h6 class="text-info font-weight-semibold">Thông tin chuyển ca</h6>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th rowspan="2">STT</th>
                    <th colspan="4">Chuyển ca</th>
                    <th colspan="4">Nhận ca</th>
                    <th rowspan="2">Thời gian</th>
                </tr>
                <tr>
                    <th>Quận</th>
                    <th>Phường</th>
                    <th>Người điều tra</th>
                    <th>Số điện thoại</th>
                    <th>Quận</th>
                    <th>Phường</th>
                    <th>Người điều tra</th>
                    <th>Số điện thoại</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(v, k) in list_chuyenca" :key="k">
                    <td>{{k+1}}</td>
                    <td>{{v.chuyen.tenquan}}</td>
                    <td>{{v.chuyen.tenphuong}}</td>
                    <td>{{v.chuyen.hoten}}</td>
                    <td>{{v.chuyen.sdt}}</td>
                    <td>{{v.nhan.tenquan}}</td>
                    <td>{{v.nhan.tenphuong}}</td>
                    <td>{{v.nhan.hoten}}</td>
                    <td>{{v.nhan.sdt}}</td>
                    <td v-html="v.datetime"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import { mapState } from 'vuex'
    import { get } from 'lodash-es'

    export default {
        name: 'chuyenca-part',
        computed: {
            ...mapState({
                list_chuyenca: state => get(state, 'form.list_chuyenca', [])
            })
        },
    }
</script>
