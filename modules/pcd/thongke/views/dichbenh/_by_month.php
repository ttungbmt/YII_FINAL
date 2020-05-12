<table class="table table-sm table-bordered" id="tb-export">
    <thead>
    <tr>
        <th rowspan="2">STT</th>
        <th rowspan="2">Quận huyện</th>
        <th :colspan="thangs.length" class="text-center">Năm {{nam}}</th>
        <th rowspan="2">Tổng</th>
    </tr>
    <tr>
        <th v-for="n in thangs">T{{n}}</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(v, k) in resp">
        <td>{{k+1}}</td>
        <td>{{v.tenquan}}</td>
        <td v-for="i in v.thangs">
            {{i.count}}
            {{dulieu === 'cabenh' ? '' : `(${i.total})`}}
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
            {{dulieu === 'cabenh' ? sumByMonth(v, 'count') : (_.round((sumByMonth(v, 'total')/_.sumBy(resp, 'ds_q'))*100000))}}
        </td>
        <td>{{dulieu === 'cabenh' ? sumByMonth(null, 'count') : _.round((sumByMonth(null, 'total')/_.sumBy(resp, 'ds_q'))*100000)}}</td>
    </tr>
    </tfoot>
</table>