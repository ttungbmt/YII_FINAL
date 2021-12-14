<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title></title>
    <style type="text/css">
        body {
            line-height: 108%;
            font-family: Calibri;
            font-size: 11pt
        }

        p {
            margin: 0pt 0pt 8pt
        }

        li,
        table {
            margin-top: 0pt;
            margin-bottom: 8pt
        }

        .ListParagraph,
        .ListParagraph1,
        .normalnumber {
            margin-left: 36pt;
            margin-bottom: 8pt;
            line-height: 108%;
            font-family: Calibri;
            font-size: 11pt
        }

        span.ListParagraphChar,
        span.ListParagraph1Char,
        span.normalnumberChar {
            font-family: Calibri;
            font-size: 11pt
        }
    </style>
</head>

<body>
    <div id="vueApp">
        <p style="margin-bottom:0pt; line-height:normal; font-size:12pt">
            <strong>
                <span style="font-family:'Times New Roman'; ">&#xa0;</span>
            </strong>
        </p>
        <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:12pt">
            <strong>
                <span style="font-family:'Times New Roman'; ">KẾ HOẠCH XỬ LÝ Ổ DỊCH</span>
            </strong>
        </p>
        <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:12pt">
            <span style="font-family:'Times New Roman'">Tại Kp/Ấp: <?= $m['diachi'] ? $m['diachi'] : '……………………' ?></span>
        </p>
        <ol type="I" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:33.35pt; margin-bottom:0pt; line-height:normal; padding-left:2.65pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Tình hình ổ dịch
            </li>
        </ol>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Số ca trong ổ dịch: <?= $m['soca'] ? $m['soca'] : '……………………' ?>
            </span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Các ca bệnh nhận từ ngày nào: <?= $m['benh_ngaynhan'] ? $m['benh_ngaynhan'] : '……………………' ?></span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Tại các tổ, khu phố/ấp nào: <?= $kh['kp_ap'] ? $kh['kp_ap'] : '……………………' ?></span>
        </p>
        <ol start="2" type="I" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:33.35pt; margin-bottom:0pt; line-height:normal; padding-left:2.65pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Kế hoạch xử lý
            </li>
        </ol>
        <ol type="1" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Phạm vi khoanh vùng xử lý
            </li>
        </ol>
        <p style="margin-bottom:0pt; text-indent:24.55pt; text-align:justify; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">Sau khi xác định mối liên quan giữa các ca bệnh và nhận thấy có sự hình thành của ổ dịch sốt xuất huyết tại khu phố,ấp <?= $kh['kp_ap'] ? $kh['kp_ap'] : '……………………' ?>, xác định phạm vi ổ dịch cần xử lý bao gồm các tổ dân phố:<?= $kh['to_dp'] ? $kh['to_dp'] : '……………………' ?> </span>
        </p>
        <ol start="2" type="1" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Diệt lăng quăng
            </li>
        </ol>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Phạm vi diệt lăng quăng gồm các tổ:<?= $kh['dietlq_phamvi'] ? $kh['dietlq_phamvi'] : '……………………' ?></span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Thực hiện diệt lăng quăng hàng tuần:</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ đợt 1: ngày <?= $kh['dietlq_dot1'] ? $kh['dietlq_dot1'] : '………/………/…………' ?>.</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ đợt 2: ngày <?= $kh['dietlq_dot2'] ? $kh['dietlq_dot2'] : '………/………/…………' ?>.</span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Nhân sự tham gia gồm: <?= $kh['dietlq_nhansu'] ? $kh['dietlq_nhansu'] : '……………………' ?> người </span>
            <em>
                <span style="font-family:'Times New Roman'; ">(chi tiết phụ lục đính kèm)</span>
            </em>
        </p>
        <ol start="3" type="1" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:39.4pt; margin-bottom:0pt; line-height:normal; padding-left:3.1pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Kiểm soát điểm nguy cơ
            </li>
        </ol>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Các điểm nguy cơ trong phạm vi ổ dịch gồm:</span>
        </p>
        <?php foreach($dnc as $d) : ?>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ <?= $d['ten_cs'] ? $d['ten_cs'] : '……………………' ?>, tại <?= $d['diachi'] ? $d['diachi'] : '……………………' ?></span>
        </p>
        <?php endforeach; ?>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <strong>
                <span style="font-family:'Times New Roman'; ">
                    <span style="font-weight:normal">-</span>
            </strong>
            </span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Nội dung thực hiện: </span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ Giám sát hàng tuần kể từ ngày <?= $kh['dnc_ngaybatdau'] ? $kh['dnc_ngaybatdau'] : '……………………' ?>. tất cả các điểm nguy cơ trên cho đến khi ổ dịch kết thúc</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ Hướng dẫn chủ điểm nguy cơ xử lý các vật dụng có lăng quăng và ghi nhận kết quả giám sát vào phiếu giám sát.</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ Sau 2 lần giám sát nếu chủ điểm nguy cơ không hợp tác, vẫn để phát sinh lăng quăng thì đề nghị xử phạt với UBND phường, xã <?= $kh['dnc_dvxuphat'] ? $kh['dnc_dvxuphat'] : '……………………' ?></span>
        </p>
        <ol start="4" type="1" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Hoạt động truyền thông

            </li>
        </ol>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Treo băng rôn, bảng thông báo người dân chủ động diệt lăng quăng, diệt muỗi tại các điểm tập trung đông người như <?= $kh['tt_diadiem'] ? $kh['tt_diadiem'] : '……………………' ?>.</span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Các hình thức khác, nêu cụ thể lịch thực hiện: <?= $kh['tt_hinhthuckhac'] ? $kh['tt_hinhthuckhac'] : '……………………' ?>.</span>
        </p>
        <ol start="5" type="1" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Hoạt động phun hóa chất
            </li>
        </ol>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Số tổ được phun hóa chất: <?= $kh['phc_soto'] ? $kh['phc_soto'] : '……………………………' ?>.; số nhà (số nóc gia): <?= $kh['phc_sonha'] ? $kh['phc_sonha'] : '……………………………' ?>.</span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Số máy nhỏ sử dụng: <?= $kh['phc_smn'] ? $kh['phc_smn'] : '……………………………' ?></span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Số máy lớn sử dụng: <?= $kh['phc_sml'] ? $kh['phc_sml'] : '……………………………' ?>, đi các tuyến đường: <?= $kh['phc_sml_tuyenduong'] ? $kh['phc_sml_tuyenduong'] : '……………………' ?></span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Số lít hóa chất dự trù: <?= $kh['phc_lit'] ? $kh['phc_lit'] : '……………………………' ?> lít; Loại hóa chất: <?= $kh['phc_loaihc'] ? $kh['phc_loaihc'] : '……………………' ?></span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Nhân sự tham gia, gồm: <?= $kh['phc_nhansu'] ? $kh['phc_nhansu'] : '……………………' ?> người </span>
            <em>
                <span style="font-family:'Times New Roman'; ">(chi tiết phụ lục đính kèm)</span>
            </em>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ Nhân sự mang máy: <?= $kh['phc_nhansu_mangmay'] ? $kh['phc_nhansu_mangmay'] : '……………………' ?> người/tổ</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ Nhân sự dẫn đường: <?= $kh['phc_nhansu_danduong'] ? $kh['phc_nhansu_danduong'] : '……………………' ?> người/tổ</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ Nhân sự giám sát: <?= $kh['phc_nhansu_giamsat'] ? $kh['phc_nhansu_giamsat'] : '……………………' ?> người/máy; </span>
        </p>
        <p class="ListParagraph" style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Thời gian phun hóa chất</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ Lần 1: ngày <?= $kh['phc_lan1'] ? $kh['phc_lan1'] : '………/………/…………' ?>. Lúc <?= $kh['phc_lan1_ghichu'] ? $kh['phc_lan1_ghichu'] : '……………………' ?>.</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">+ Lần 2: ngày <?= $kh['phc_lan2'] ? $kh['phc_lan2'] : '………/………/…………' ?>. Lúc <?= $kh['phc_lan2_ghichu'] ? $kh['phc_lan2_ghichu'] : '……………………' ?>.</span>
        </p>
        <ol start="6" type="1" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Khảo sát côn trùng
            </li>
        </ol>
        <p style="margin-bottom:0pt; text-indent:24.55pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">Trạm Y tế phụ trách khảo sát côn trùng ngẫu nhiên 30 hộ trong phạm vi ổ dịch, thực hiện 3 lần/ổ dịch theo hướng dẫn của Trung tâm Y tế dự phòng thành phố để đánh giá hiệu quả của hoạt động diệt lăng quăng và phun hóa chất.</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; text-indent:-18pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Lần 1 dự kiến vào ngày: <?= $kh['ct_lan1'] ? $kh['ct_lan1'] : '………/………/…………' ?>.</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; text-indent:-18pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Lần 2 dự kiến vào ngày: <?= $kh['ct_lan2'] ? $kh['ct_lan2'] : '………/………/…………' ?>.</span>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; text-indent:-18pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">-</span>
            <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
            <span style="font-family:'Times New Roman'">Lần 3 dự kiến vào ngày: <?= $kh['ct_lan3'] ? $kh['ct_lan3'] : '………/………/…………' ?>.</span>
        </p>
        <ol start="7" type="1" style="margin:0pt; padding-left:0pt">
            <li class="ListParagraph" style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:13pt; font-weight:bold">
                Kinh phí
            </li>
        </ol>
        <p style="margin-bottom:0pt; text-indent:24.55pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'"><?= $kh['kinhphi'] ? $kh['kinhphi'] : '……………………' ?> VND</span>
        </p>
        <p class="ListParagraph" style="margin-left:360pt; margin-bottom:0pt; text-indent:22.75pt; line-height:normal; font-size:13pt">
            <span style="font-family:'Times New Roman'">&#xa0;</span>
        </p>
        <p style="margin-bottom:0pt; text-align:justify; line-height:130%; widows:0; orphans:0; font-size:13pt">
            <strong>
                <span style="font-family:'Times New Roman'; ">&#xa0;</span>
            </strong>
        </p>
        <p style="margin-bottom:0pt; text-align:justify; line-height:130%; widows:0; orphans:0; font-size:13pt">
            <strong>
                <span style="font-family:'Times New Roman'; ">Phụ lục nhân sự tham gia xử lý ổ dịch</span>
            </strong>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <em>
                <span style="font-family:'Times New Roman'; ">Bảng phân công nhân sự tham gia diệt lăng quăng</span>
            </em>
        </p>
        <table cellspacing="0" cellpadding="0" style="width:276.35pt; margin-left:36pt; margin-bottom:0pt; border:0.75pt solid #000000; border-collapse:collapse">
            <tr>
                <td style="width:80pt; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'">Tổ dân phố</span>
                    </p>
                </td>
                <td style="width:174pt; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'">Tên nhân sự tham gia</span>
                    </p>
                </td>
            </tr>
            <?php foreach(json_decode($kh['dietlq_phuluc'], true) as $ns) :?>
            <tr>
                <td style="width:80pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'"><?= $ns['todp'] ? $ns['todp'] : '……………………' ?></span>
                    </p>
                </td>
                <td style="width:174pt; border-top:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'"><?= $ns['nhansu'] ? $ns['nhansu'] : '……………………' ?></span>
                    </p>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p style="margin-bottom:0pt; text-align:justify; line-height:130%; widows:0; orphans:0; font-size:13pt">
            <strong>
                <span style="font-family:'Times New Roman'; ">&#xa0;</span>
            </strong>
        </p>
        <p class="ListParagraph" style="margin-bottom:0pt; line-height:normal; font-size:13pt">
            <em>
                <span style="font-family:'Times New Roman'; ">Bảng phân công tham gia buổi phun hóa chất</span>
            </em>
        </p>
        <table cellspacing="0" cellpadding="0" style="width:452.1pt; margin-left:36pt; margin-bottom:0pt; border:0.75pt solid #000000; border-collapse:collapse">
            <tr>
                <td style="width:55.65pt; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'">Thứ tự máy phun</span>
                    </p>
                </td>
                <td style="width:80pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'">Địa điểm phun</span>
                    </p>
                </td>
                <td style="width:85.6pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'">Tên nhân sự phun</span>
                    </p>
                </td>
                <td style="width:85.6pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'">Tên người dẫn đường</span>
                    </p>
                </td>
                <td style="width:90.5pt; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'">Tên nhân sự giám sát kỹ thuật</span>
                    </p>
                </td>
            </tr>
            <?php foreach(json_decode($kh['phc_phuluc'], true) as $ns) :?>
            <tr>
                <td style="width:55.65pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'"><?= $ns['stt'] ? $ns['stt'] : '……………………' ?></span>
                    </p>
                </td>
                <td style="width:80pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'"><?= $ns['diadiem'] ? $ns['diadiem'] : '……………………' ?></span>
                    </p>
                </td>
                <td style="width:85.6pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'"><?= $ns['nhansu'] ? $ns['nhansu'] : '……………………' ?></span>
                    </p>
                </td>
                <td style="width:85.6pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'"><?= $ns['danduong'] ? $ns['danduong'] : '……………………' ?></span>
                    </p>
                </td>
                <td style="width:90.5pt; border-top:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
                    <p class="ListParagraph" style="margin-left:0pt; margin-bottom:0pt; line-height:normal; font-size:13pt">
                        <span style="font-family:'Times New Roman'"><?= $ns['giamsat'] ? $ns['giamsat'] : '……………………' ?></span>
                    </p>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p>
            &#xa0;
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        Vue.config.devtools = true
        let app = new Vue({
            el: '#vueApp',
            data: {
                diachi: '………………'
            },
            mounted() {

            }
        })
    </script>
</body>

</html>