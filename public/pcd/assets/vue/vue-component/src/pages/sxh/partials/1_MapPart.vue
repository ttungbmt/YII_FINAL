<template>
    <div>
        <b-row>
            <b-col :key="k" v-for="(i, k) in only(schema, ['lat', 'lng', 'chuandoan_bd'])" :md="i.md">
                <field-sxh :name="i.name"/>
            </b-col>
            <b-col v-if="form.chuandoan_bd === 'KHAC'">
                <field-sxh name="chuandoan_bd_khac"/>
            </b-col>
        </b-row>
        <b-row>
            <b-col :key="k" v-for="(i, k) in only(schema, ['me', 'ngaybaocao', 'ma_icd', 'shs'])">
                <field-sxh :name="i.name"/>
            </b-col>
        </b-row>
        <b-row>
            <b-col md="6">
                <field-sxh name="ht_dieutri"/>
            </b-col>
            <b-col md="3" offset-md="3" class="text-right pt-4">
                <button type="button" class="btn btn-outline bg-primary-400 text-primary-400 border-primary-400 btn-sm">Hiển thị ca cùng nhà</button>
            </b-col>
        </b-row>
    </div>
</template>
<script>
    import { mapState } from 'vuex'

    export default {
        name: 'map-part',
        computed: {
            ...mapState(['form', 'schema'])
        },
    }
</script>