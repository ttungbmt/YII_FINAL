<?php
namespace pcd\notifications;

use common\supports\DatabaseChannel;
use pcd\models\Chuyenca;
use tuyakhov\notifications\messages\DatabaseMessage;
use tuyakhov\notifications\NotificationInterface;
use tuyakhov\notifications\NotificationTrait;
use Yii;

class ChuyencaNoty implements NotificationInterface
{
    use NotificationTrait;

    private $cabenh_id;
    private $chuyenca_id;
    private $is_trave;

    public function __construct($cabenh_id, $chuyenca_id, $is_trave)
    {
        $this->cabenh_id = $cabenh_id;
        $this->chuyenca_id = $chuyenca_id;
        $this->is_trave = $is_trave;
    }

    public function exportForDatabase()
    {
        $actMessage = $this->is_trave ? ' trả ca về ' : ' chuyển ca cho ';
        $chCa = Chuyenca::findOne($this->chuyenca_id);
        $chuyen = $chCa->chuyen->tenphuong.' - '.$chCa->chuyen->tenquan;
        $nhan = $chCa->nhan->tenphuong.' - '.$chCa->nhan->tenquan;

        return \Yii::createObject([
            'class' => DatabaseMessage::className(),
            'subject' => "<b>".$chuyen."</b>".$actMessage."<b>".$nhan."</b>",
            'body' => '',
            'url' => url(['/admin/cabenh-sxh/update', 'id' => $this->cabenh_id]),
        ]);
    }

    public function exportForMail() {
        return Yii::createObject([
            'class' => '\tuyakhov\notifications\messages\MailMessage',
            'view' => ['html' => 'invoice-paid'],
            'viewData' => [
                'invoiceNumber' => $this->invoice->id,
                'amount' => $this->invoice->amount
            ]
        ]);
    }
}