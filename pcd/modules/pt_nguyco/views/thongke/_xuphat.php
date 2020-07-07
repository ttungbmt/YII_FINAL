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
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(1, null, v.thang1)">{{v.thang1 ? v.thang1 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(2, null, v.thang2)">{{v.thang2 ? v.thang2 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(3, null, v.thang3)">{{v.thang3 ? v.thang3 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(4, null, v.thang4)">{{v.thang4 ? v.thang4 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(5, null, v.thang5)">{{v.thang5 ? v.thang5 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(6, null, v.thang6)">{{v.thang6 ? v.thang6 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(7, null, v.thang7)">{{v.thang7 ? v.thang7 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(8, null, v.thang8)">{{v.thang8 ? v.thang8 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(9, null, v.thang9)">{{v.thang9 ? v.thang9 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(10, null, v.thang10)">{{v.thang10 ? v.thang10 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(11, null, v.thang11)">{{v.thang11 ? v.thang11 : 0}}</button></td>
        <td class="text-center"><button class="btn btn-link" @click="getLoaihinhUri(12, null, v.thang12)">{{v.thang12 ? v.thang12 : 0}}</button></td>
        <td class="font-weight-semibold text-center">
            <button class="btn btn-link" @click="getLoaihinhUri(null, null, v.thang1+ v.thang2+ v.thang3+ v.thang4+ v.thang5+ v.thang6+ v.thang7+ v.thang8+ v.thang9+ v.thang10+ v.thang11+ v.thang12)">{{v.thang1+ v.thang2+ v.thang3+ v.thang4+ v.thang5+ v.thang6+ v.thang7+ v.thang8+ v.thang9+ v.thang10+ v.thang11+ v.thang12}}
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td>Tổng</td>
        <td class="text-center">{{_.sumBy(resp, 'thang1')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang2')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang3')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang4')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang5')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang6')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang7')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang8')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang9')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang10')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang11')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang12')}}</td>
        <td class="text-center">{{_.sumBy(resp, 'thang1')+ _.sumBy(resp, 'thang2')+ _.sumBy(resp, 'thang3')+ _.sumBy(resp,
            'thang4')+ _.sumBy(resp, 'thang5')+ _.sumBy(resp, 'thang6')+ _.sumBy(resp, 'thang7')+
            _.sumBy(resp, 'thang8')+ _.sumBy(resp, 'thang9')+ _.sumBy(resp, 'thang10')+ _.sumBy(resp,
            'thang11')+ _.sumBy(resp, 'thang12')}}
        </td>
    </tr>
    </tfoot>
</table>