<template>
    <div class="text-primary font-bold uppercase mt-2 mb-2">
        <span class="badge border-primary text-primary" v-bind:class="{ 'badge-flat': flat, 'badge-pill': pill}">{{serial}}</span> {{title}}
    </div>
</template>
<script>
    export default {
        name: 'm-heading',
        props: {
            serial: String,
            title: String,
            pill: Boolean,
            flat: {
                type: Boolean,
                default: true
            },
        },
    }
</script>
