<?php declare(strict_types=1);

namespace App\Enums;

enum Category: int
{
    case SCENIC_DRIVES = 1;
    case ROAD_TRIP_TIPS = 2;
    case LOCAL_GOURMET = 3;
    case CAR_GADGETS = 4;
    case PARKING_SPOTS = 5;

    public function label(): string
    {
        return match($this) {
            self::SCENIC_DRIVES => '絶景ドライブコース',
            self::ROAD_TRIP_TIPS => 'ロードトリップのコツ',
            self::LOCAL_GOURMET => 'ご当地グルメ',
            self::CAR_GADGETS => '車用ガジェット紹介',
            self::PARKING_SPOTS => '駐車場・休憩スポット',
        };
    }
}