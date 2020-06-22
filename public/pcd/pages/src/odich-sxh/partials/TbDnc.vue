<template>
    <div class="ml-1">
        <div class="font-bold">
            b. Hoạt động giám sát, xử lý điểm nguy cơ tại OD
        </div>
        <div :class="['grid', schemaClass]">
            <div v-for="i in schema" v-bind="i" >
                {{i.label}}
            </div>
        </div>
        <div class="font-bold">
            Danh sách ĐNC  trong ổ dịch
        </div>

    </div>
</template>
<script>
    export default {
        name: 'tb-dnc',
        props: {
            schema: Array,
            schemaClass: String
        }
    }
</script>