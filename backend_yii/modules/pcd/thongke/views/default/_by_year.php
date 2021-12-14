<div v-if="_.isEmpty(nams)" class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th>STT</th>
            <th>Quận huyện</th>
            <th>Điều trị ngoại trú</th>
            <th>Điều trị nội trú</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(v, k) in resp">
            <td>{{k+1}}</td>
            <td>{{v.tenquan}}</td>
            <td>{{v.dt_noi}}</td>
            <td>{{v.dt_ngoai}}</td>
            <td>{{parseInt(v.dt_noi) + parseInt(v.dt_ngoai)}}</td>
        </tr>
        <tr>
            <td colspan="2" class="font-weight-semibold">Tổng</td>
            <td class="font-weight-semibold">{{_.sumBy(resp, 'dt_noi')}}</td>
            <td class="font-weight-semibold">{{_.sumBy(resp, 'dt_ngoai')}}</td>
            <td class="font-weight-semibold">{{parseInt(_.sumBy(resp, 'dt_noi')) + parseInt(_.sumBy(resp, 'dt_ngoai'))}}</td>
        </tr>
        </tbody>
    </table>
</div>
<div v-else>
    <table class="table table-sm table-bordered">
        <thead>
        <tr>
            <th rowspan="2">STT</th>
            <th rowspan="2">Quận huyện</th>
            <th colspan="2" class="text-center" v-for="n in nams">{{n}}</th>
            <th colspan="2" class="text-center">Tổng</th>
        </tr>
        <tr>
            <th v-for="n in namArr">{{n.key === 'dt_noi' ? 'Điều trị nội trú' : 'Điều trị ngoại trú'}}</th>
            <th>Điều trị nội trú</th>
            <th>Điều trị ngoại trú</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(v, k) in resp">
            <td>{{k+1}}</td>
            <td>{{v.tenquan}}</td>
            <td v-for="i in namArr">
                {{_.get(v.nam.find(j => j.nam == i.nam), i.key, 0)}}
            </td>
            <td v-for="j in namArr">
                {{sumBy({f1: 'maquan', v1: v.maquan, route: 'nam', field: j.key})}}
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2">Tổng</td>
            <td v-for="v in namArr">
                {{sumByYear(v.key, v.nam)}}
            </td>
            <td v-for="v in namArr">
                {{sumByYear(v.key)}}
            </td>
        </tr>
        </tfoot>
    </table>
</div>