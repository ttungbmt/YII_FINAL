<template>
    <div class="hot-container has-scroll">
        <div ref="handsontable"></div>
    </div>
</template>
<script>
    export default {
        props: {
            data: {
                type: Array,
//                required: true,
                default: () => ([])
            },
            settings: {
                type: Object,
                default: () => ({
                    autoWrapRow: true,
                    colHeaders: true, // ['Brand', 'Model', 'Year', 'Color', 'Price']
                    rowHeaders: true,
                    stretchH: 'all',

                    mergeCells: true,
                    contextMenu: true,
                    dropdownMenu: true,

                    manualRowResize: true,
                    manualColumnResize: true,
                    manualRowMove: true,
                    manualColumnMove: true,

//                    columnSorting: true,
//                    sortIndicator: true,
//                    autoColumnSize: {
//                        samplingRatio: 5
//                    },

//                    comments: true,
//                    cell: [
//                        {row: 1, col: 1, comment: 'The most nice looking muscle car'},
//                    ]
                    cells: function (row, col, prop, td) {
                        var cellProperties = {};

//                        cellProperties.renderer = 'blankValueRenderer';
                        return cellProperties;
                    }
                })
            }
        },
        mounted () {
            this.settings.data = this.data;

//            Handsontable.renderers.registerRenderer('blankValueRenderer', this.blankValueRenderer);
            // Initialize with options
            this.table = new Handsontable(this.$refs.handsontable, this.settings);
        },
        beforeDestroy () {
            this.table.destroy()
        },
        methods: {
            blankValueRenderer(instance, td, row, col, prop, value, cellProperties){
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                // If empty cell, add grey background
                if (!value || value === '') {
                    td.style.background = '#f7f7f7';
                }
            }
        }
    }
</script>