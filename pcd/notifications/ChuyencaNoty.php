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

    private $chuyenca;
    private $cabenh;

    public function __construct($chuyenca, $cabenh)
    {
        $this->chuyenca = $chuyenca;
        $this->cabenh = $cabenh;
    }

    public function exportForDatabase()
    {
        $ten_px_chuyen = data_get($this->chuyenca->chuyen, 'tenphuong', '');
        $ten_qh_chuyen = data_get($this->chuyenca->chuyen, 'tenquan', '');

        $ten_px_nhan = data_get($this->chuyenca->nhan, 'tenphuong', '');
        $ten_qh_nhan = data_get($this->chuyenca->nhan, 'tenquan', '');

        $actMessage = $this->chuyenca->is_chuyentiep ? "chuyển ca cho" : "trả ca về";

        return \Yii::createObject([
            'class' => DatabaseMessage::className(),
            'subject' => "<b>{$ten_qh_chuyen} - {$ten_px_chuyen}</b> ".$actMessage." <b>{$ten_qh_nhan} - {$ten_px_nhan}</b>",
            'data' => [
                'actionUrl' => url(['/sxh/default/update', 'id' => $this->cabenh->gid])
            ],
        ]);
    }
}