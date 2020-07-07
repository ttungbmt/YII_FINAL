<table id="tb-export" class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>Năm {{form.year}}</th>
        <th colspan="12" class="text-center">Thời gian</th>
        <th rowspan="2" class="text-center">Tổng</th>
    </tr>
    <tr>
        <th>{{field.label}}</th>
        <th class="text-center">T1</th>
        <th class="text-center">T2</th>
        <th class="text-center">T3</th>
        <th class="text-center">T4</th>
        <th class="text-center">T5</th>
        <th class="text-center">T6</th>
        <th class="text-center">T7</th>
        <th class="text-center">T8</th>
        <th class="text-center">T9</th>
        <th class="text-center">T10</th>
        <th class="text-center">T11</th>
        <th class="text-center">T12</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="v in resp">
        <td>{{v.ten}}</td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '01')">{{v.thang1 ? v.thang1 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '02')">{{v.thang2 ? v.thang2 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '03')">{{v.thang3 ? v.thang3 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '04')">{{v.thang4 ? v.thang4 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '05')">{{v.thang5 ? v.thang5 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '06')">{{v.thang6 ? v.thang6 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '07')">{{v.thang7 ? v.thang7 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '08')">{{v.thang8 ? v.thang8 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, '09')">{{v.thang9 ? v.thang9 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, 10)">{{v.thang10 ? v.thang10 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, 11)">{{v.thang11 ? v.thang11 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(v.code, null, 12)">{{v.thang12 ? v.thang12 : 0}}</button></td>
        <td class="font-weight-semibold text-center">
            <button class="btn btn-link" @click="getLoaihinhUri(v.code, null, null)">{{v.thang1+ v.thang2+ v.thang3+ v.thang4+ v.thang5+ v.thang6+ v.thang7+ v.thang8+ v.thang9+ v.thang10+ v.thang11+ v.thang12}}
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td>Tổng</td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '01')">{{_.sumBy(resp, 'thang1')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '02')">{{_.sumBy(resp, 'thang2')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '03')">{{_.sumBy(resp, 'thang3')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '04')">{{_.sumBy(resp, 'thang4')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '05')">{{_.sumBy(resp, 'thang5')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '06')">{{_.sumBy(resp, 'thang6')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '07')">{{_.sumBy(resp, 'thang7')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '08')">{{_.sumBy(resp, 'thang8')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, '09')">{{_.sumBy(resp, 'thang9')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, 10)">{{_.sumBy(resp, 'thang10')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, 11)">{{_.sumBy(resp, 'thang11')}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(null, null, 12)">{{_.sumBy(resp, 'thang12')}}</button></td>
        <td class="text-center">
            {{_.sumBy(resp, 'thang1')+ _.sumBy(resp, 'thang2')+ _.sumBy(resp, 'thang3')+ _.sumBy(resp,
            'thang4')+ _.sumBy(resp, 'thang5')+ _.sumBy(resp, 'thang6')+ _.sumBy(resp, 'thang7')+
            _.sumBy(resp, 'thang8')+ _.sumBy(resp, 'thang9')+ _.sumBy(resp, 'thang10')+ _.sumBy(resp,
            'thang11')+ _.sumBy(resp, 'thang12')}}
        </td>
    </tr>
    </tfoot>
</table>