<template>
    <div class="grid grid-cols-2 gap-4">
        <m-field label="Quận huyện" type="select" items="cat.qh" placeholder="Chọn quận huyện..." model="maquan"></m-field>
        <m-field label="Phường xã" type="select" items="cat.px" placeholder="Chọn phường xã..." model="maphuong" :filterBy="{path: 'extra.maquan', value: maquan}"></m-field>
    </div>
</template>

<script>
    import {get as pGet} from 'vuex-pathify'

    export default {
        name: 'p-hanhchinh',
        computed: {
            maquan: pGet('form/values.maquan'),
            maphuong: pGet('form/values.maphuong'),
        }
    }
</script>
