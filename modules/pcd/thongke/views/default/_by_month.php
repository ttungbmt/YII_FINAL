<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th rowspan="2">STT</th>
        <th rowspan="2">Quận huyện</th>
        <th :colspan="thangs.length" class="text-center">Năm {{nam}}</th>
        <th rowspan="2">Tổng</th>
    </tr>
    <tr>
        <th v-for="n in thangs">Tháng {{n}}</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(v, k) in resp">
        <td>{{k+1}}</td>
        <td>{{v.tenquan}}</td>
        <td v-for="i in v.thangs">
            {{i.count}}
        </td>
        <td>
            {{_.sumBy(v.thangs, 'count')}}
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2">Tổng</td>
        <td v-for="v in thangs">
            {{sumByMonth(v, 'count')}}
        </td>
        <td>{{sumByMonth()}}</td>

    </tr>
    </tfoot>
</table>