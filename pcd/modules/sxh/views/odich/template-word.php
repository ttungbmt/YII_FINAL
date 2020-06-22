


<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8" />
    <title></title>
    <style>
        body { line-height:108%; font-family:"Times New Roman"; font-size:0.92em }
        p { margin:0pt 0pt 8pt }
        li, table { margin-top:0pt; margin-bottom:8pt }
        .BalloonText { margin-bottom:0pt; line-height:normal; font-family:'Segoe UI'; font-size:0.75em }
        .CommentSubject { margin-bottom:8pt; line-height:normal; font-size:0.83em; font-weight:bold }
        .CommentText { margin-bottom:8pt; line-height:normal; font-size:0.83em }
        .ListParagraph, .ListParagraph1, .normalnumber { margin-left:36pt; margin-bottom:8pt; line-height:108%; font-size:0.92em }
        span.BalloonTextChar { font-family:'Segoe UI'; font-size:0.75em }
        span.CommentReference { font-size:0.67em }
        span.CommentSubjectChar { font-size:0.83em; font-weight:bold }
        span.CommentTextChar { font-size:0.83em }
    </style>
</head>
<body>
<p style="margin-top:6pt; margin-bottom:6pt; line-height:normal; font-size:1.18em">
    <span>............................................</span>
    <span style="width:68.7pt; display:inline-block">&#xa0;</span>
    <strong>
        <span>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</span>
    </strong>
</p>
<p style="margin-top:6pt; margin-bottom:6pt; line-height:normal; font-size:1.18em">
    <span>&#xa0;&#xa0;&#xa0; </span>
    <span>....................................</span>
    <span style="width:121.41pt; display:inline-block">&#xa0;</span>
    <strong>
        <span>Độc lập – Tự do – Hạnh phúc</span>
    </strong>
</p>
<p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
    <strong>
        <span>&#xa0;</span>
    </strong>
</p>
<p style="margin-bottom:0pt; line-height:normal; font-size:1.18em">
    <strong>
        <span>&#xa0;</span>
    </strong>
</p>
<p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
    <strong>
        <span>&#xa0;</span>
    </strong>
</p>
<p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
    <strong>
        <span>BIÊN BẢN XỬ LÝ Ổ DỊCH</span>
    </strong>
</p>
<p style="margin-bottom:0pt; text-align:center; line-height:150%; font-size:1.18em">
			<span>Tại Kp/Ấp:..................PX:
				<?=$if($m->tenphuong, '.................................')?> QH:
				<?=$if($m->tenquan, '........................')?>
			</span>
</p>
<p style="margin-bottom:0pt; text-align:center; line-height:150%; font-size:1.09em">
    <em>
        <span>(Theo kế hoạch số .................. ngày...../...../.....)</span>
    </em>
</p>
<p style="margin-top: 30px"></p>
<ol style="margin:0pt; padding-left:0pt; list-style-type:upper-roman">
    <li style="margin-left:33.35pt; margin-bottom:0pt; line-height:150%; padding-left:2.65pt; font-family:'Times New Roman'; font-size:1.18em; font-weight:bold">
        Tổng quan về ổ dịch
    </li>
</ol>
<p style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <strong>
				<span>
					<span style="font-weight:normal">-</span>
    </strong>
    </span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Danh sách ca bệnh trong ổ dịch: </span>
</p>

<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>Họ tên</th>
        <th>Tuổi</th>
        <th>Tổ</th>
        <th>Khu phố</th>
        <th>Phường xã</th>
        <th>Quận huyện</th>
        <th>Ngày mắc bệnh</th>
        <th>Ngày báo cáo</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($m->cabenhs as $k => $c):?>
        <tr>
            <td><?=$k+1?></td>
            <td><?=$c['hoten']?></td>
            <td><?=$c['tuoi']?></td>
            <td><?=$c['khupho']?></td>
            <td><?=$c['to_dp']?></td>
            <td><?=$c['tenquan']?></td>
            <td><?=$c['tenphuong']?></td>
            <td><?=$c['ngaymacbenh']?></td>
            <td><?=$c['ngaybaocao']?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<p style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>
				Loại ổ dịch: <?=$if($m->loai_od, '…………………..')?>
			</span>
</p>
<p style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Ngày xác định ổ </span>
    <span>dịch</span>
    <span>:&#xa0;<?=$if($m->ngayxacdinh, '…………………..')?> </span>
</p>
<p style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Ngày phát hiện ổ </span>
    <span>dịch</span>
    <span>: &#xa0;<?=$if($m->ngayphathien, '…………………')?></span>
</p>
<p style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Ngày dự kiến kết </span>
    <span>thúc</span>
    <span>: &#xa0;<?=$if($m->ngaydukien_kt, '…………………')?></span>
</p>
<p style="margin-left:42.55pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <strong>
				<span>
					<span style="font-weight:normal">-</span>
    </strong>
    </span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Ngày kết </span>
    <span>thúc</span>
    <span>: &#xa0;<?=$if($m->ngayketthuc, '…………………')?></span>
</p>
<ol start="2" style="margin:0pt; padding-left:0pt; list-style-type:upper-roman">
    <li style="margin-left:33.35pt; margin-bottom:0pt; line-height:150%; padding-left:2.65pt; font-family:'Times New Roman'; font-size:1.18em; font-weight:bold">
        Kế hoạch xử lý
    </li>
</ol>
<ol style="margin:0pt; padding-left:0pt">
    <li style="margin-left:39.3pt; margin-bottom:0pt; line-height:150%; padding-left:3.25pt; font-family:'Times New Roman'; font-size:1.18em; font-weight:bold">
        Phạm vi khoanh vùng xử lý
    </li>
</ol>
<p style="margin-left:21.3pt; margin-bottom:0pt; text-indent:24.55pt; text-align:justify; line-height:150%; font-size:1.18em">
    <span>Sau khi xác định mối liên quan giữa các ca bệnh và nhận thấy có sự hình thành của ổ dịch sốt xuất huyết tại các khu phố/ấp và các tổ trên hệ thống GIS</span>
    <span>:………………………………………………………………………………………</span>
    <span>&#xa0; </span>
</p>
<p style="margin-left:21.3pt; margin-bottom:0pt; text-indent:24.55pt; text-align:justify; line-height:150%; font-size:1.18em">
    <span>Xác định phạm vi ổ dịch cần xử lý bao gồm các khu phố/ấp và các </span>
    <span>tổ</span>
    <span>:………………………………….</span>
</p>
<p style="margin-left:21.3pt; margin-bottom:0pt; text-indent:24.55pt; text-align:justify; line-height:150%; font-size:1.18em">
    <span>Số nhà (nóc gia trong phạm vi ổ dịch đã xác </span>
    <span>định</span>
    <span>:…………….</span>
</p>
<ol start="2" style="margin:0pt; padding-left:0pt">
    <li style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:1.18em; font-weight:bold">
        Khảo sát côn trùng
    </li>
</ol>
<p style="margin-bottom:0pt; line-height:normal; font-size:1.18em">
    <strong>
        <span>&#xa0;</span>
    </strong>
</p>
<table style="width:476.7pt; margin-right:auto; margin-left:auto; margin-bottom:0pt; border:0.75pt solid #000000; border-collapse:collapse">
    <tr>
        <td style="width:45.9pt; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Lần khảo </span>
                <span>sát</span>
            </p>
        </td>
        <td style="width:57.15pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Ngày khảo sát</span>
            </p>
        </td>
        <td style="width:65.45pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Loại khảo sát</span>
            </p>
        </td>
        <td style="width:92.85pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Nơi khảo sát</span>
            </p>
        </td>
        <td style="width:44.25pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số nhà khảo sát</span>
            </p>
        </td>
        <td style="width:105.55pt; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Kết </span>
                <span>quả</span>
            </p>
        </td>
    </tr>
    <tr>
        <td style="width:45.9pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Lần 1</span>
            </p>
        </td>
        <td style="width:57.15pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:65.45pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
            <p style="margin-bottom:0pt; line-height:normal; font-size:1.18em">
                <span>1.Lăng quăng</span>
            </p>
            <p style="margin-bottom:0pt; line-height:normal; font-size:1.18em">
                <span>2.</span>
                <span>Lăng</span>
                <span> quăng và muỗi </span>
            </p>
        </td>
        <td style="width:92.85pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Tổ:……………..</span>
            </p>
        </td>
        <td style="width:44.25pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>……..</span>
            </p>
        </td>
        <td style="width:105.55pt; border-top:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
            <p style="margin-bottom:0pt; line-height:normal; font-size:1.18em">
                <span>BI=.............; CI%=............%; HILQ%=..............%</span>
            </p>
            <p style="margin-bottom:0pt; line-height:normal; font-size:1.18em">
                <span>DI:...............</span>
            </p>
            <p style="margin-bottom:0pt; line-height:normal; font-size:1.18em">
                <span>HI muỗi=............</span>
            </p>
        </td>
    </tr>
</table>
<p style="margin-bottom:0pt; line-height:normal; font-size:1.18em">
    <strong>
        <span>&#xa0;</span>
    </strong>
</p>
<ol start="3" style="margin:0pt; padding-left:0pt">
    <li style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:1.18em; font-weight:bold">
        Diệt lăng quăng và kiểm soát điểm nguy cơ
    </li>
</ol>
<ol style="margin:0pt; padding-left:0pt; list-style-type:lower-latin">
    <li class="ListParagraph" style="margin-left:57.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:1.18em; font-style:italic">
        Hoạt động diệt lăng quăng tại ổ dịch
    </li>
</ol>
<table style="width:374.9pt; margin-right:auto; margin-left:auto; margin-bottom:0pt; border:0.75pt solid #000000; border-collapse:collapse">
    <tr>
        <td style="width:37.35pt; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Lần DLQ</span>
            </p>
        </td>
        <td style="width:54.4pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Ngày DLQ</span>
            </p>
        </td>
        <td style="width:54.4pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Khu phố DLQ</span>
            </p>
        </td>
        <td style="width:54.4pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Tổ DLQ</span>
            </p>
        </td>
        <td style="width:54.4pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số nhà DLQ (vãng gia)</span>
            </p>
        </td>
        <td style="width:54.4pt; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số người tham gia</span>
            </p>
        </td>
    </tr>
    <tr>
        <td style="width:37.35pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Lần 1</span>
            </p>
        </td>
        <td style="width:54.4pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:54.4pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:54.4pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:54.4pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:54.4pt; border-top:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
    </tr>
</table>
<ol start="2" style="margin:0pt; padding-left:0pt; list-style-type:lower-latin">
    <li class="ListParagraph" style="margin-top:6pt; margin-left:57.3pt; margin-bottom:0pt; line-height:150%; padding-left:3.25pt; font-family:'Times New Roman'; font-size:1.18em; font-style:italic">
        Hoạt động giám sát, xử lý điểm nguy cơ tại OD
    </li>
</ol>
<p style="margin-top:6pt; margin-left:49.65pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Số điểm nguy cơ trong ổ dịch:………………….</span>
</p>
<p style="margin-left:49.65pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Danh sách </span>
    <span>ĐNC</span>
    <span> trong ổ dịch:…………..</span>
</p>
<p style="margin-left:49.65pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Ngày bắt đầu giám sát: <?=$if($m->ngaybatdau_gs, '……………………..')?></span>
</p>
<p style="margin-left:49.65pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Đơn vị xử phạt (nếu có): <?=$if($m->donvi_xp, '………………………..')?> </span>
</p>
<ol start="4" style="margin:0pt; padding-left:0pt">
    <li style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:1.18em; font-weight:bold">
        Hoạt động phun hóa chất
    </li>
</ol>
<table style="width:490.35pt; margin-right:auto; margin-left:auto; margin-bottom:0pt; border:0.75pt solid #000000; border-collapse:collapse">
    <tr>
        <td style="width:32.1pt; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Lần PHC</span>
            </p>
        </td>
        <td style="width:46.1pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Khu phố/ấp</span>
            </p>
        </td>
        <td style="width:39.1pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Tổ dân phố</span>
            </p>
        </td>
        <td style="width:36.7pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số nóc gia thực tế</span>
            </p>
        </td>
        <td style="width:35.2pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số nóc gia xử lý</span>
            </p>
        </td>
        <td style="width:40.35pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số máy nhỏ</span>
            </p>
        </td>
        <td style="width:40.35pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số máy lớn</span>
            </p>
        </td>
        <td style="width:41pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Loại hóa chất</span>
            </p>
        </td>
        <td style="width:40pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số lít hóa chất (lít)</span>
            </p>
        </td>
        <td style="width:30.7pt; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Số người tham gia</span>
            </p>
        </td>
    </tr>
    <tr>
        <td style="width:32.1pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle">
            <p style="margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.18em">
                <span>Lần 1</span>
            </p>
        </td>
        <td style="width:46.1pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:39.1pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:36.7pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:35.2pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:40.35pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:40.35pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:41pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:40pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
        <td style="width:30.7pt; border-top:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top"></td>
    </tr>
</table>
<ol start="5" style="margin:0pt; padding-left:0pt">
    <li style="margin-left:39.3pt; margin-bottom:0pt; line-height:normal; padding-left:3.25pt; font-family:'Times New Roman'; font-size:1.18em; font-weight:bold">
        Hoạt động truyền thông

    </li>
</ol>
<p style="margin-left:49.65pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Hình thức truyền thông: <?=$if($m->hdtt_hinhthuc, '…………………………')?></span>
</p>
<p style="margin-left:49.65pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Địa điểm: <?=$if($m->hdtt_diadiem, '………………………………………..')?></span>
</p>
<p style="margin-left:49.65pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Thời gian: <?=$if($m->hdtt_thoigian, '……………………………………….')?></span>
</p>
<ol start="6" style="margin:0pt; padding-left:0pt">
    <li style="margin-left:37.8pt; margin-bottom:0pt; line-height:normal; padding-left:4.75pt; font-family:'Times New Roman'; font-weight:bold">
        <span style="font-size:1.18em">ĐÁNH</span> GIÁ, ĐỀ XUẤT, KẾT LUẬN
    </li>
</ol>
<p style="margin-left:49.65pt; margin-bottom:0pt; text-indent:-14.2pt; line-height:150%; font-size:1.18em">
    <span>-</span>
    <span style="font:7pt 'Times New Roman'">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    <span>Ổ dịch kết thúc theo dõi ngày: <?=$if($m->ngayketthuc_td, '………………')?></span>
</p>
<p style="margin-left:7.1pt; margin-bottom:6pt; text-align:center; line-height:150%; widows:0; orphans:0">
    <span><?=$if($m->danhgia, '……………………………………………………………...........................................................................')?></span>
</p>
<p style="margin-left:7.1pt; margin-bottom:6pt; text-align:center; line-height:150%; widows:0; orphans:0">
    <span>……………………………………………………………...........................................................................</span>
</p>
<p style="margin-left:7.1pt; margin-bottom:6pt; text-align:center; line-height:150%; widows:0; orphans:0">
    <span>……………………………………………………………...........................................................................</span>
</p>
<p style="margin-left:28.35pt; margin-bottom:0pt; text-align:center; line-height:normal; font-size:1.09em">
    <strong>
        <span>PHỤ TRÁCH</span>
    </strong>
    <strong>
        <span>&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0; </span>
    </strong>
    <strong>
        <span>TRẠM Y TẾ</span>
    </strong>
</p>
</body>
</html>