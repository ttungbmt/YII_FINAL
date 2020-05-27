<table id="tb-export" class="table table-sm table-bordered">
    <thead>
    <tr>
        <th>Năm {{year}}</th>
        <th colspan="12">Thời gian</th>
        <th rowspan="2">Tổng</th>
    </tr>
    <tr>
        <th>Quận, huyện</th>
        <th>T1</th>
        <th>T2</th>
        <th>T3</th>
        <th>T4</th>
        <th>T5</th>
        <th>T6</th>
        <th>T7</th>
        <th>T8</th>
        <th>T9</th>
        <th>T10</th>
        <th>T11</th>
        <th>T12</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="v in resp">
        <td>{{v.tenquan}}</td>
        <td>{{v.thang1 ? v.thang1 : 0}}</td>
        <td>{{v.thang2 ? v.thang2 : 0}}</td>
        <td>{{v.thang3 ? v.thang3 : 0}}</td>
        <td>{{v.thang4 ? v.thang4 : 0}}</td>
        <td>{{v.thang5 ? v.thang5 : 0}}</td>
        <td>{{v.thang6 ? v.thang6 : 0}}</td>
        <td>{{v.thang7 ? v.thang7 : 0}}</td>
        <td>{{v.thang8 ? v.thang8 : 0}}</td>
        <td>{{v.thang9 ? v.thang9 : 0}}</td>
        <td>{{v.thang10 ? v.thang10 : 0}}</td>
        <td>{{v.thang11 ? v.thang11 : 0}}</td>
        <td>{{v.thang12 ? v.thang12 : 0}}</td>
        <td class="font-weight-semibold">
            {{v.thang1+ v.thang2+ v.thang3+ v.thang4+ v.thang5+ v.thang6+ v.thang7+ v.thang8+ v.thang9+
            v.thang10+ v.thang11+ v.thang12}}
        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td>Tổng</td>
        <td>{{_.sumBy(resp, 'thang1')}}</td>
        <td>{{_.sumBy(resp, 'thang2')}}</td>
        <td>{{_.sumBy(resp, 'thang3')}}</td>
        <td>{{_.sumBy(resp, 'thang4')}}</td>
        <td>{{_.sumBy(resp, 'thang5')}}</td>
        <td>{{_.sumBy(resp, 'thang6')}}</td>
        <td>{{_.sumBy(resp, 'thang7')}}</td>
        <td>{{_.sumBy(resp, 'thang8')}}</td>
        <td>{{_.sumBy(resp, 'thang9')}}</td>
        <td>{{_.sumBy(resp, 'thang10')}}</td>
        <td>{{_.sumBy(resp, 'thang11')}}</td>
        <td>{{_.sumBy(resp, 'thang12')}}</td>
        <td>{{_.sumBy(resp, 'thang1')+ _.sumBy(resp, 'thang2')+ _.sumBy(resp, 'thang3')+ _.sumBy(resp,
            'thang4')+ _.sumBy(resp, 'thang5')+ _.sumBy(resp, 'thang6')+ _.sumBy(resp, 'thang7')+
            _.sumBy(resp, 'thang8')+ _.sumBy(resp, 'thang9')+ _.sumBy(resp, 'thang10')+ _.sumBy(resp,
            'thang11')+ _.sumBy(resp, 'thang12')}}
        </td>
    </tr>
    </tfoot>
</table>