<div v-if="_.isEmpty(nams)" class="table-responsive">
    <table class="table table-sm table-bordered" id="tb-export">
        <thead>
        <tr>
            <th>STT</th>
            <th>Quận huyện</th>
            <th v-if="_.sumBy(resp, 'dt_noi')">Điều trị ngoại trú</th>
            <th v-if="_.sumBy(resp, 'dt_ngoai')">Điều trị nội trú</th>
            <th v-if="_.sumBy(resp, 'ravien')">Ra viện</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(v, k) in resp">
            <td>{{k+1}}</td>
            <td>{{v.tenquan}}</td>
            <td v-if="_.sumBy(resp, 'dt_noi')">{{v.dt_noi}}</td>
            <td v-if="_.sumBy(resp, 'dt_ngoai')">{{v.dt_ngoai}}</td>
            <td v-if="_.sumBy(resp, 'ravien')">{{v.ravien}}</td>
            <td>{{sumFields(v, ['dt_noi', 'dt_ngoai', 'ravien'])}}</td>
        </tr>
        <tr>
            <td colspan="2" class="font-weight-semibold">Tổng</td>
            <td class="font-weight-semibold" v-if="_.sumBy(resp, 'dt_noi')">{{_.sumBy(resp, 'dt_noi')}}</td>
            <td class="font-weight-semibold" v-if="_.sumBy(resp, 'dt_ngoai')">{{_.sumBy(resp, 'dt_ngoai')}}</td>
            <td class="font-weight-semibold" v-if="_.sumBy(resp, 'ravien')">{{_.sumBy(resp, 'ravien')}}</td>
            <td class="font-weight-semibold">{{sumByFields(resp, ['dt_noi', 'dt_ngoai', 'ravien'])}}</td>
        </tr>
        </tbody>
    </table>
</div>
<div v-else>
    <table class="table table-sm table-bordered" id="tb-export">
        <thead>
        <tr>
            <th rowspan="2">STT</th>
            <th rowspan="2">Quận huyện</th>
            <th :colspan="(sumByYear('dt_noi', i.nam)?1:0)+(sumByYear('dt_ngoai', i.nam)?1:0)+(sumByYear('ravien', i.nam)?1:0)" class="text-center" v-for="i in nams">{{i}}</th>
            <th :colspan="(sumByYear('dt_noi')?1:0)+(sumByYear('dt_ngoai')?1:0)+(sumByYear('ravien')?1:0)" class="text-center">Tổng</th>
        </tr>
        <tr>
            <th v-for="i in namArr" v-if="sumByYear(i.key, i.nam)">{{labels[i.key]}}</th>
            <th v-for="i in namArr" v-if="sumByYear(i.key)">{{labels[i.key]}}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(v, k) in resp">
            <td>{{k+1}}</td>
            <td>{{v.tenquan}}</td>
            <td v-for="i in namArr" v-if="sumByYear(i.key, i.nam)">
                {{_.get(v.nam.find(j => j.nam == i.nam), i.key, 0)}}
            </td>
            <td v-else-if="!sumByYear(i.key, i.nam) && nams.length>1">
                0
            </td>
            <td v-if="sumByYear('dt_noi')">
                {{sumBy({f1: 'maquan', v1: v.maquan, route: 'nam', field: 'dt_noi'})}}
            </td>
            <td v-if="sumByYear('dt_ngoai')">
                {{sumBy({f1: 'maquan', v1: v.maquan, route: 'nam', field: 'dt_ngoai'})}}
            </td>
            <td v-if="sumByYear('ravien')">
                {{sumBy({f1: 'maquan', v1: v.maquan, route: 'nam', field: 'ravien'})}}
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2">Tổng</td>
            <td v-for="i in namArr" v-if="sumByYear(i.key, i.nam)">
                {{sumByYear(i.key, i.nam)}}
            </td>
            <td v-else-if="!sumByYear(i.key, i.nam) && nams.length>1">
                0
            </td>
            <td v-if="sumByYear('dt_noi')">
                {{sumByYear('dt_noi')}}
            </td>
            <td v-if="sumByYear('dt_ngoai')">
                {{sumByYear('dt_ngoai')}}
            </td>
            <td v-if="sumByYear('ravien')">
                {{sumByYear('ravien')}}
            </td>
        </tr>
        </tfoot>
    </table>
</div>

