<?php
use yii\helpers\ArrayHelper;
$diachi = opt(last($m->xacminh));
//dd($diachi);
$find_phuong = function ($v){
     $phuong = \pcd\models\HcPhuong::find()->andWhere(['maphuong' => $v])->one();
    return opt($phuong)->tenphuong;
};
$find_quan = function ($v){
    $quan = \pcd\models\HcPhuong::find()->andWhere(['maquan' => $v])->one();
    return opt($quan)->tenquan;
};

$yn = function($v){
    $v1 = $v == 1 ? '' : '';
    $v2 = $v == 0 ? '' : '';
    return "<span style=\"font-family:'Wingdings 2'\">{$v1}</span>
    <span> Có</span>
    <span>&#xa0;&#xa0; </span>
    <span style=\"font-family:'Wingdings 2'\">{$v2}</span>
    <span> Không</span>";
};


$data = (object)head(ArrayHelper::toArray([$m], [
    \pcd\modules\sxh\forms\SxhForm::className() => [
        'id',
        'hoten',
        'phai' => function($model){
            $phai = api('dm_phai');
            return data_get($phai, $model->phai);
        },
        'tuoi',
        'px' => function($model) use($find_phuong){
            return $find_phuong($model->px);
        },
        'qh' => function($model) use($find_quan){
            return $find_quan($model->qh);
        },
        'benhnoikhac' => function($model) use($yn){
            return $yn($model->benhnoikhac);
        },
        'tinhkhac',
        'tinhnoikhac',
        'pxkhac' => function($model) use($find_phuong){
            return $find_phuong($model->pxkhac);
        },
        'qhkhac' => function($model) use($find_quan){
            return $find_quan($model->qhkhac);
        },
        'ngaynhanthongbao',
        'ngaydieutra',
        'songuoicutru',
        'cutruduoi15',
        'ngaymacbenh',
        'ngaynhapvien',
        'ngayxuatvien',
        'tpbv_bv',
        'nghenghiep',
        'dclamviec',
        'dclamviecqh' => function($model) use($find_phuong){
            return $find_phuong($model->dclamviecqh);
        },
        'dclamviecpx' => function($model) use($find_quan){
            return $find_quan($model->dclamviecpx);
        },
        'noilamviec_sxh',
        'nhacobnsxh',
        'nhaconguoibenh',
        'bvpk',
        'nhatho',
        'dinh',
        'congvien',
        'noihoihop',
        'noixd',
        'cafe',
        'noichannuoi',
        'noibancay',
        'vuaphelieu',
        'noikhac',
        'noikhac_ghichu',
        'diemden_px',
        'diemden_pxkhac',
        'diemden_qhkhac',
        'gdcosxh',
        'gdsonguoisxh',
        'gdso15t',
        'gdthuocsxh',
        'gdthuocsxhsonguoi',
        'gdthuocsxh15t',
        'bi',
        'ci',
        'cachidiem',
        'dietlangquang',
        'giamsattheodoi',
        'xulyonho',
        'xulyorong',
        'cathuphat',
        'odichmoi',
        'odichcu',
        'odichcu_xuly',
        'xuly',
        'xuly_ngay',
        'xuatvien',
        'ngayxuatvien',
        'chuandoan',
        'chuandoan_khac',
        'nguoidieutra',
    ],
]));
$data->sonha = $diachi->sonha;
$data->duong = $diachi->duong;
$data->to_dp = $diachi->to_dp;
$data->khupho = $diachi->khupho;
$data->is_diachi = $yn($diachi->is_diachi);
$data->is_benhnhan = $yn($diachi->is_benhnhan);
$data->benhnoikhac = $yn($diachi->is_benhnhan);

$f = function ($name, $d = '') use($data){
    return !is_null($data->{$name}) ? $data->{$name} : $d;
};

$y = function ($name) use($data){
    return "<span style=\"font-family:'Wingdings 2'\">".($data->{$name} ? '' : '')."</span>";
};
//dd($data);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html
    xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Style-Type" content="text/css"/>
    <title>PHIẾU ĐIỀU TRA Mẫu S</title>
    <style>
        body { line-height: 115%; font-family: Times New Roman; font-size: 12pt }
        p { margin: 0 0 10pt }
        li { margin-top: 0; margin-bottom: 10pt }
    </style>
</head>
<body>
<p style="margin-bottom:6pt; text-align:center; line-height:normal; widows:0; orphans:0;">
    <strong>
        <span>PHIẾU ĐIỀU TRA</span>
    </strong>
</p>
<p style="margin-bottom:6pt; text-align:center; line-height:normal; widows:0; orphans:0;">
    <strong>
        <span>CA BỆNH SỐT XUẤT HUYẾT DENGUE</span>
    </strong>
</p>
<p style="margin-bottom:6pt; text-align:center; line-height:normal; widows:0; orphans:0;">
    <strong>
        <span>PX: </span>
    </strong>
    <span><?=$f('px', '……………….')?></span>
    <strong>
        <span> QH: </span>
    </strong>
    <span><?=$f('qh', '……………….')?></span>
    <strong>
        <span> TP HCM</span>
    </strong>
</p>
<br>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span> Ngày nhận thông báo ca bệnh: <?=$f('ngaynhanthongbao', '/…/…/……/')?></span>
    <span>&#xa0;&#xa0;</span>
    <span style="font-family:Symbol"></span>
    <span></span>
    <span>Ngày điều tra: <?=$f('ngaydieutra', '/…/…/……/')?></span>
    <strong>
        <span>&#xa0;&#xa0; </span>
    </strong>
    <span style="font-family:Symbol"></span>
    <em>
        <span>Mã số:</span>
    </em>
    <span>&#xa0; </span>
    <span><?=$f('id', '……')?></span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <strong>
        <span>1- </span>
    </strong>
    <strong>
        <u><span>Xác minh ca bệnh</span></u>
    </strong>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span>
        Họ và tên: <?=$f('hoten', '………………………………')?>
        <span style="font-family:Symbol"></span>
        Giới: <?=$f('phai', '………')?>
        <span style="font-family:Symbol"></span>
        Tuổi: <?=$f('tuoi', '…………')?>
    </span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span> Địa chỉ: số nhà <?=$f('sonha', '…………')?> đường <?=$f('duong', '…………')?>
    </span>
    <span>&#xa0; </span>
    <span>. Tổ <?=$f('to_dp', '………')?> KP/ấp <?=$f('khupho', '………')?> </span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span>Nhà ca bệnh : </span>
    <?=$f('is_diachi')?>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <span style="font-family:Symbol"></span>
    <span> Bệnh nhân: </span>
    <?=$f('is_benhnhan')?>
    <span>&#xa0;&#xa0;&#xa0;&#xa0; </span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span> BN cư trú tại nhà : </span>
    <?=$f('benhnoikhac')?>
</p>
<p style="margin-bottom:4pt; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span>Nếu không, BN cư trú tại</span>
    <span style="font-family:'Wingdings 2'"><?=$data->tinhkhac == 'TinhKhac' ? '' : ''?>  </span>
    <span> Tỉnh khác</span>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->tinhkhac == 'HCM' ? '' : ''?></span>
    <span> TPHCM,</span>
    <span>&#xa0; </span>
    <span>PX: <?=$f('pxkhac', '………')?></span>
    <span>&#xa0; </span>
    <span>QH: <?=$f('qhkhac', '………')?></span>
    <span>&#xa0; </span>

    <span>Địa chỉ :<?=$f('tinhnoikhac', '……………..……………………………….')?></span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span> Số người cư trú trong gia đình (kể cả tạm trú): <?=$f('songuoicutru', '………')?></span>
    <span>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span style="font-family:Symbol"></span>
    <span> Trong đó số dưới 15 tuổi: <?=$f('cutruduoi15', '………')?></span>
</p>


<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <strong>
        <span>2- </span>
    </strong>
    <strong>
        <u>
            <span>Điều tra dịch tễ</span>
        </u>
    </strong>
</p>



<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span></span>
    <span>Ngày mắc bệnh: </span>
    <span><?=$f('ngaymacbenh', '/……/……/………/')?></span>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <span style="font-family:Symbol"></span>
    <span></span>
    <span>Ngày nhập viện: </span>
    <span><?=$f('ngaynhapvien', '/……/……/………/')?></span>
    <span>&#xa0; </span>
    <span style="font-family:Symbol"></span>
    <span></span>
    <span>Ngày xuất viện: </span>
    <span><?=$f('ngayxuatvien', '/……/……/………/')?> </span>
</p>





<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span></span>
    <span> BV: <?=$f('tpbv_bv', '….……...')?> <span style="font-family:Symbol"></span> Nghề nghiệp: <?=$f('nghenghiep', '………………….')?> </span>
    <span style="font-family:Symbol"></span>
    <span> Địa chỉ nơi làm việc/học tập: <?=$f('dclamviec', '………………………………….')?> <span style="font-family:Symbol"></span> PX: <?=$f('dclamviecqh', '…....…')?> <span style="font-family:Symbol"></span> QH: <?=$f('dclamviecpx', '….....')?></span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span> Tại nơi làm việc, trong vòng 2 tuần qua có ai bị SXH / nghi ngờ SXH / sốt không?</span>
    <span>&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->noilamviec_sxh == 1 ? '' : '' ?></span>
    <span> Có</span>
    <span>&#xa0;&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->noilamviec_sxh == 0 ? '' : '' ?></span>
    <span> Không</span>
    <span>&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->noilamviec_sxh == 9 ? '' : '' ?></span>
    <span> Không rõ</span>
    <span>&#xa0;&#xa0;&#xa0; </span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span> Trong vòng 2 tuần trước khi bị bệnh, BN có đi đến hay thường đến những nơi nào sau đây (đánh dấu nhiều ô):</span>
    <span>&#xa0;&#xa0; </span>
</p>













<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>- </span>
    <?=$y('nhacobnsxh')?>
    <span> Nhà có BN SXH</span>
    <span>&#xa0; </span>
    <?=$y('nhaconguoibenh')?>
    <span> Nhà có người bệnh</span>
    <span>&#xa0;&#xa0; </span>
    <?=$y('bvpk')?>
    <span> BV-PK</span>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <?=$y('nhatho')?>
    <span> Nhà thờ</span>
    <span>&#xa0;&#xa0; </span>
    <?=$y('dinh')?>
    <span> Đình chùa</span>
    <span>&#xa0; </span>
    <?=$y('congvien')?>
    <span> Công viên</span>
    <span>&#xa0;&#xa0; </span>
    <?=$y('noihoihop')?>
    <span> Nơi hội họp </span>
    <span>&#xa0;&#xa0; </span>
    <?=$y('noixd')?>
    <span> Nơi xây dựng</span>
    <span>&#xa0;&#xa0; </span>
    <?=$y('cafe')?>
    <span> Quán cà phê/internet</span>
    <span>&#xa0;&#xa0; </span>
    <?=$y('noichannuoi')?>
    <span> Nơi chăn nuôi</span>
    <span>&#xa0;&#xa0; </span>
    <?=$y('noibancay')?>
    <span> Nơi bán cây cảnh</span>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <?=$y('vuaphelieu')?>
    <span> Vựa phế liệu</span>
    <span>&#xa0;&#xa0; </span>
    <?=$y('noikhac')?>
    <span> Khác, <?=$f('noikhac_ghichu', '…………')?></span>
</p>



<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>- Các điểm đã đến ghi ở trên thuộc địa bàn (đánh dấu nhiều ô):</span>
    <span>&#xa0; </span>
    <?=$y('diemden_px')?>
    <span> PX</span>
    <span>&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <?=$y('diemden_pxkhac')?>
    <span> PX khác</span>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <?=$y('diemden_qhkhac')?>
    <span> QH khác</span>
    <span>&#xa0; </span>
</p>
<p style="margin-bottom:4pt; line-height:normal; widows:0; orphans:0;">
    <span>- </span>
    <u>
        <span>Nơi / địa điểm đã đến hay thường đi đến tại địa bàn PX
        </span>
    </u>
    <span>(tổ/khu phố-ấp): …………….………………………………………….………</span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span> Trong vòng 1 tháng qua, tại gia đình </span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
			<span>- Có người mắc bệnh SXH không?
			</span>
    <span>&#xa0; </span>
    <?=$yn('gdcosxh')?>
</p>

<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
	<span>&#xa0;&#xa0;Nếu có, số người bị SXH: <?=$f('gdso15t', '…..')?>, số ≤ 15 tuổi: <?=$f('gdthuocsxh', '…….')?></span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>- Có người mắc bệnh sốt &amp; có uống thuốc hạ sốt? </span>
    <?=$yn('gdsonguoisxh')?>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>&#xa0;&#xa0;Không rõ. Nếu có, số người: <?=$f('gdthuocsxhsonguoi', '…..')?>, số ≤ 15 tuổi: <?=$f('gdthuocsxh15t', '…..')?></span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>(nếu có người mắc bệnh SXH </span>
    <span style="font-family:Symbol"></span>
    <span> điều tra ca bệnh tiếp tục theo mẫu điều tra này)</span>
    <span>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <strong>
        <span>3- </span>
    </strong>
    <strong>
        <u>
            <span>Khảo sát lăng quăng</span>
        </u>
    </strong>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span> Khảo sát khi ca bệnh là ca chỉ điểm / ca đầu tiên. </span>
</p>
<p style="margin-bottom:4pt; text-indent:14.2pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>- Mục đích khảo sát là để có quyết định xử lý như ổ dịch nhỏ hay không. </span>
</p>
<p style="margin-bottom:4pt; text-indent:14.2pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>- Nếu là các ca thứ phát chỉ khảo sát trong quá trình xử lý ổ dịch.</span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span>
        Khảo sát nhà ca bệnh và 15 nhà chung quanh theo mẫu khảo sát lăng quăng.
    </span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>&#xa0;&#xa0; </span>
    Kết quả: BI: <?=$f('bi', '……….')?>, CI: <?=$f('ci', '………..')?>


</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <strong>
        <span>4- </span>
    </strong>
    <strong>
        <u>
            <span>Kết luận</span>
        </u>
    </strong>
    <strong>
        <span>: </span>
    </strong>
</p>





<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span>Xác định:</span>
    <span>&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->chuandoan == 1 ? '' : ''?></span>
    <span></span>
    <span>SXH/theo dõi SXH/ nghi ngờ SXH</span>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->chuandoan == 2 ? '' : ''?></span>
    <span> sốt siêu vi/bệnh phát ban</span>
    <span>&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->chuandoan == 3 ? '' : ''?></span>
    <span>bệnh khác, tên ca bệnh khác: <?=$f('chuandoan_khac', '.......................')?></span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>&#xa0; </span>
    <span style="font-family:'Times New Roman';">Nếu là SXH</span>
    <span>&#xa0; </span>
    <span style="font-family:Symbol"></span>
    <span>&#xa0;&#xa0; </span>
    <span style="font-family:'Wingdings 2'"></span>
    <span> bệnh thuộc PX</span>
    <span>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span style="font-family:'Wingdings 2'"></span>
    <span> bệnh nơi khác đến</span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span style="font-family:Symbol"></span>
    <span>Ca bệnh :  </span>
</p>
<ol start="1" type="1" style="margin:0pt; padding-left:0pt">
    <li style="margin-left:27pt; margin-bottom:4pt; text-indent:-10pt; text-align:justify; line-height:normal; widows:0; orphans:0; font-family:'Times New Roman';; list-style-position:inside">
        &#xa0;Ca bệnh chỉ điểm /ca đầu tiên
        <?=$y('cachidiem')?>
    </li>
</ol>



<p style="margin-left:18pt; margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>Dự kiến xử lý: </span>
    <?=$y('dietlangquang')?>
    <span> diệt lăng quăng diệt muỗi / gia đình</span>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <?=$y('giamsattheodoi')?>
    <span> giám sát, theo dõi</span>
    <span>&#xa0;&#xa0;&#xa0; </span>
    <?=$y('xulyonho')?>
    <span> xử lý ổ dịch nhỏ</span>
    <span>&#xa0; </span>
</p>



<ol start="2" type="1" style="margin:0pt; padding-left:0pt">
    <li style="margin-left:27pt; margin-bottom:4pt; text-indent:-10pt; text-align:justify; line-height:normal; widows:0; orphans:0; font-family:'Times New Roman';; list-style-position:inside">
        &#xa0;Ca bệnh thứ phát

        <?=$y('cathuphat')?>&#xa0;&#xa0;

        <span style="font-family:Symbol"></span>&#xa0;&#xa0;

        <?=$y('odichmoi')?> ổ dịch mới&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;

        <?=$y('odichcu')?> ổ dịch củ đã xác định.&#xa0;&#xa0;

        <em>Tên ổ dịch: ......... ......</em>
        <em> .......</em>&#xa0;


    </li>
</ol>
<p style="margin-left:18pt; margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <span>Xử lý: </span>
    <span style="font-family:'Wingdings 2'"><?=$data->xuly == 1 ? '' : ''?></span>
    <span> chưa xử lý</span>
    <span>&#xa0;&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->xuly == 2 ? '' : ''?></span>
    <span>trong thời gian xử lý</span>
    <span>&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span style="font-family:'Wingdings 2'"><?=$data->xuly == 3 ? '' : ''?></span>
    <span> sau thời sau xử lý, sau xử lý: <?=$f('xuly_ngay', '........')?> ngày</span>
    <span>&#xa0;&#xa0; </span>
    <span>&#xa0;</span>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <em>
        <span>* Điều tra ghi phiếu đầy đủ và không bỏ sót bất kỳ nội dung nào.</span>
    </em>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <em>
        <span>* Mẫu phiếu được thực hiện:</span>
    </em>
    <em>
        <span>&#xa0; </span>
    </em>
    <em>
        <span>ca bệnh thông báo khi bệnh nhân có ở tại nhà, cư trú có thể ở bất cứ nơi đâu.
        </span>
    </em>
</p>
<p style="margin-bottom:4pt; text-align:justify; line-height:normal; widows:0; orphans:0;">
    <strong>
        <span>Người điều tra: <?=$f('nguoidieutra', '...................................')?></span>
    </strong>
    <strong>
        <span>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    </strong>
</p>
</body>
</html>