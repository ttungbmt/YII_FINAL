<template>
    <div>
        <component v-bind:is="i.component" v-for="(i, k) in schema" v-bind="i" :key="k"></component>
    </div>
</template>
<script>
    export default {
        inheritAttrs: false,
        name: 'v-row',
        props: {
            schema: Array,
        },
    }
</script>
